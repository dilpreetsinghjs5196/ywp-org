<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Setting;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentConfirmation;
use App\Mail\AdminPaymentNotification;

class DonationController extends Controller
{
    /**
     * Show Donation Page
     */
    public function showDonate()
    {
        return view('donate');
    }

    /**
     * Get Razorpay API Instance
     */
    private function getApi()
    {
        $keyId = trim(Setting::where('key', 'razorpay_key')->value('value') ?? '');
        $keySecret = trim(Setting::where('key', 'razorpay_secret')->value('value') ?? '');
        
        if (!$keyId || !$keySecret) return null;
        
        return new Api($keyId, $keySecret);
    }

    /**
     * Initiate Checkout (Create Order or Subscription)
     */
    public function initiateCheckout(Request $request)
    {
        $api = $this->getApi();
        if (!$api) {
            return response()->json(['error' => 'Razorpay API keys not configured.'], 500);
        }

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'type'   => 'required|in:one_time,monthly',
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'pan'    => 'required|string|max:15',
        ]);

        $amount = $request->amount;
        $type = $request->type; // one_time or monthly
        $name = $request->name;
        $email = $request->email;
        $mobile = $request->mobile;
        $referred_by = $request->referred_by ?? 'N/A';
        $address = $request->address ?? 'N/A';
        $pan = $request->pan ?? 'N/A';

        try {
            if ($type === 'monthly') {
                // 1. Logic for Monthly Subscription
                $planName = "Monthly Support - ₹" . $amount;
                
                $plan = $api->plan->create([
                    'period' => 'monthly',
                    'interval' => 1,
                    'item' => [
                        'name' => $planName,
                        'amount' => $amount * 100, // in paise
                        'currency' => 'INR',
                        'description' => 'Recurring monthly donation to YWP;'
                    ]
                ]);

                $subscription = $api->subscription->create([
                    'plan_id' => $plan->id,
                    'customer_notify' => 1,
                    'total_count' => 120, // 10 years
                    'notes' => [
                        'name' => $name,
                        'email' => $email,
                        'mobile' => $mobile,
                        'pan' => $pan,
                        'referred_by' => $referred_by,
                        'address' => $address,
                        'donation_type' => $type
                    ]
                ]);

                // Create local record
                Subscription::create([
                    'razorpay_subscription_id' => $subscription->id,
                    'razorpay_plan_id' => $plan->id,
                    'donor_name' => $name,
                    'donor_email' => $email,
                    'amount' => $amount,
                    'status' => 'created'
                ]);

                return response()->json([
                    'subscription_id' => $subscription->id,
                    'razorpay_key' => trim(Setting::where('key', 'razorpay_key')->value('value') ?? ''),
                    'amount' => $amount * 100,
                    'currency' => 'INR',
                    'description' => $planName,
                    'prefill' => [
                        'name' => $name,
                        'email' => $email,
                        'contact' => $mobile
                    ]
                ]);
            } else {
                // 2. Logic for One-time Payment (Order)
                $order = $api->order->create([
                    'receipt' => 'rcpt_' . time(),
                    'amount' => $amount * 100,
                    'currency' => 'INR',
                    'notes' => [
                        'name' => $name,
                        'email' => $email,
                        'mobile' => $mobile,
                        'pan' => $pan,
                        'referred_by' => $referred_by,
                        'address' => $address,
                        'donation_type' => $type
                    ]
                ]);

                // Create local pending record
                Donation::create([
                    'donor_name' => $name,
                    'donor_email' => $email,
                    'donor_mobile' => $mobile,
                    'donor_pan' => $pan,
                    'donor_address' => $address,
                    'referred_by' => $referred_by,
                    'amount' => $amount,
                    'order_id' => $order->id,
                    'status' => 'pending'
                ]);

                return response()->json([
                    'order_id' => $order->id,
                    'razorpay_key' => trim(Setting::where('key', 'razorpay_key')->value('value') ?? ''),
                    'amount' => $amount * 100,
                    'currency' => 'INR',
                    'description' => 'One-time donation to YWP;',
                    'prefill' => [
                        'name' => $name,
                        'email' => $email,
                        'contact' => $mobile
                    ]
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function showManageSubscription($id)
    {
        $subscription = Subscription::where('razorpay_subscription_id', $id)->firstOrFail();
        return view('donate.manage', compact('subscription'));
    }

    public function processPublicCancel(Request $request, $id)
    {
        $subscription = Subscription::where('razorpay_subscription_id', $id)->firstOrFail();
        
        // Security Check: Verify Email
        if ($request->email !== $subscription->donor_email) {
            return back()->with('error', 'The email address provided does not match our records for this subscription.');
        }

        $api = $this->getApi();
        if (!$api) {
            return back()->with('error', 'Razorpay API keys not configured.');
        }

        try {
            $rzpSub = $api->subscription->fetch($subscription->razorpay_subscription_id);
            
            if ($rzpSub->status === 'active' || $rzpSub->status === 'created') {
                $rzpSub->cancel(['cancel_at_cycle_end' => 0]); // Cancel immediately
            }

            $subscription->update(['status' => 'cancelled', 'cancelled_at' => now()]);
            
            return redirect('/?cancelled=true')->with('success', 'Your monthly donation has been cancelled successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to cancel subscription: ' . $e->getMessage());
        }
    }

    /**
     * Handle Razorpay Webhook
     */
    public function handleWebhook(Request $request)
    {
        $this->applyMailSettings();
        $payload = $request->all();
        $event = $payload['event'] ?? '';

        if ($event == 'payment.captured') {
            $this->handlePaymentCaptured($payload['payload']['payment']['entity']);
        } elseif ($event == 'subscription.charged') {
            $this->handleSubscriptionCharged($payload['payload']['subscription']['entity'], $payload['payload']['payment']['entity']);
        } elseif (in_array($event, ['subscription.cancelled', 'subscription.halted', 'subscription.completed'])) {
            $this->handleSubscriptionStatusChange($payload['payload']['subscription']['entity'], $event);
        }

        return response()->json(['status' => 'success']);
    }

    private function handlePaymentCaptured($payment)
    {
        $donation = Donation::where('order_id', $payment['order_id'])->first();
        if (!$donation) {
            // If it was a generic payment link or direct payment
            $donation = Donation::create([
                'payment_id' => $payment['id'],
                'order_id' => $payment['order_id'] ?? null,
                'donor_name' => $payment['notes']['name'] ?? 'Donor',
                'donor_email' => $payment['notes']['email'] ?? null,
                'donor_mobile' => $payment['notes']['mobile'] ?? null,
                'donor_pan' => $payment['notes']['pan'] ?? null,
                'donor_address' => $payment['notes']['address'] ?? null,
                'referred_by' => $payment['notes']['referred_by'] ?? null,
                'amount' => $payment['amount'] / 100,
                'status' => 'captured'
            ]);
        } else {
            $donation->update([
                'payment_id' => $payment['id'],
                'status' => 'captured'
            ]);
        }

        try {
            if ($donation->donor_email) {
                Mail::to($donation->donor_email)->send(new PaymentConfirmation($donation));
            }
        } catch (\Exception $e) {
            \Log::error('Error sending user email: ' . $e->getMessage());
        }
    }

    private function handleSubscriptionCharged($subscriptionData, $paymentData)
    {
        $sub = Subscription::where('razorpay_subscription_id', $subscriptionData['id'])->first();
        
        if ($sub) {
            $sub->update([
                'status' => $subscriptionData['status'],
                'next_billing_at' => isset($subscriptionData['charge_at']) ? date('Y-m-d H:i:s', $subscriptionData['charge_at']) : null
            ]);

            // Create a donation record for this installment
            $donation = Donation::create([
                'donor_name'    => $sub->donor_name,
                'donor_email'   => $sub->donor_email,
                'amount'        => $paymentData['amount'] / 100,
                'currency'      => $paymentData['currency'],
                'payment_id'    => $paymentData['id'],
                'subscription_id' => $sub->id,
                'status'        => 'captured',
                'details'       => json_encode($paymentData),
                'is_recurring'  => true
            ]);

            $donation->setRelation('subscription', $sub); // Optimization: avoid extra query in mail view

            // Send confirmation for this monthly payment
            try {
                Mail::to($sub->donor_email)->send(new PaymentConfirmation($donation));
            } catch (\Exception $e) {}
        }
    }

    private function handleSubscriptionStatusChange($subscriptionData, $event)
    {
        $status = str_replace('subscription.', '', $event);
        Subscription::where('razorpay_subscription_id', $subscriptionData['id'])->update([
            'status' => $status,
            'cancelled_at' => ($status == 'cancelled') ? now() : null
        ]);
    }

    /**
     * Apply SMTP settings from database to Laravel configuration at runtime
     */
    private function applyMailSettings()
    {
        $settings = Setting::all()->pluck('value', 'key');

        if (isset($settings['mail_host']) && !empty($settings['mail_host'])) {
            config([
                'mail.mailers.smtp.host' => $settings['mail_host'],
                'mail.mailers.smtp.port' => $settings['mail_port'] ?? '587',
                'mail.mailers.smtp.username' => $settings['mail_username'] ?? '',
                'mail.mailers.smtp.password' => $settings['mail_password'] ?? '',
                'mail.mailers.smtp.encryption' => ($settings['mail_encryption'] == 'none') ? null : ($settings['mail_encryption'] ?? 'tls'),
                'mail.from.address' => $settings['mail_from_address'] ?? config('mail.from.address'),
                'mail.from.name' => $settings['mail_from_name'] ?? config('mail.from.name'),
                'mail.default' => 'smtp',
            ]);
        }
    }
}

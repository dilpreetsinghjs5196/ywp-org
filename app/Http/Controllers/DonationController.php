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
        $keyId = Setting::where('key', 'razorpay_key')->value('value');
        $keySecret = Setting::where('key', 'razorpay_secret')->value('value');
        
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

        $amount = $request->amount;
        $type = $request->type; // one_time or monthly
        $name = $request->name;
        $email = $request->email;
        $mobile = $request->mobile;

        try {
            if ($type === 'monthly') {
                // 1. Logic for Monthly Subscription
                // We need a Plan ID. For custom amounts, we create a plan on the fly.
                
                $planName = "Monthly Support - ₹" . $amount;
                // Check if a plan with this exact amount exists in your Razorpay account
                // For simplicity in this demo, we create it every time or you can cache/store plan IDs
                
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
                        'pan' => $request->pan
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
                    'razorpay_key' => Setting::where('key', 'razorpay_key')->value('value'),
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
                        'pan' => $request->pan
                    ]
                ]);

                return response()->json([
                    'order_id' => $order->id,
                    'razorpay_key' => Setting::where('key', 'razorpay_key')->value('value'),
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
        $notes = $payment['notes'];
        $donation = Donation::where('payment_id', $payment['id'])->first();

        if (!$donation) {
            $donation = Donation::create([
                'donor_name'    => $notes['name'] ?? $notes['full_name'] ?? ($payment['email'] ? explode('@', $payment['email'])[0] : 'Donor'),
                'donor_email'   => $payment['email'],
                'donor_mobile'  => $payment['contact'],
                'donor_pan'     => $notes['pan_number'] ?? $notes['pan'] ?? 'N/A',
                'donor_address' => $notes['address'] ?? $notes['residential_address'] ?? 'N/A',
                'referred_by'   => $notes['referred_by'] ?? 'N/A',
                'amount'        => $payment['amount'] / 100,
                'currency'      => $payment['currency'],
                'payment_id'    => $payment['id'],
                'order_id'      => $payment['order_id'] ?? null,
                'status'        => 'captured',
                'details'       => json_encode($payment),
                'is_recurring'  => false
            ]);

            try {
                Mail::to($donation->donor_email)->send(new PaymentConfirmation($donation));
            } catch (\Exception $e) {
                \Log::error('Error sending user email: ' . $e->getMessage());
            }
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

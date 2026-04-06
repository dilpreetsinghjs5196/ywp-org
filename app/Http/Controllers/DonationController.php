<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Setting;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentConfirmation;
use App\Mail\AdminPaymentNotification;

class DonationController extends Controller
{
    /**
     * Handle Razorpay Webhook
     */
    public function handleWebhook(Request $request)
    {
        $this->applyMailSettings();
        
        $payload = $request->all();
        
        // Log webhook for debugging if needed
        // \Log::info('Razorpay Webhook Received', ['payload' => $payload]);

        if (isset($payload['event']) && $payload['event'] == 'payment.captured') {
            $payment = $payload['payload']['payment']['entity'];
            $notes = $payment['notes'];

            // Check if donation already exists
            $donation = Donation::where('payment_id', $payment['id'])->first();

            if (!$donation) {
                // Create New Donation
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
                    'details'       => json_encode($payment)
                ]);

                // 1. Send Confirmation Email to Donor
                try {
                    Mail::to($donation->donor_email)->send(new PaymentConfirmation($donation));
                } catch (\Exception $e) {
                    \Log::error('Error sending user email: ' . $e->getMessage());
                }
            }
        }

        return response()->json(['status' => 'success']);
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

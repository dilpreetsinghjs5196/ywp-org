<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => trim($value)]);
        }
        return back()->with('success', 'Settings updated successfully!');
    }

    public function testEmail(Request $request)
    {
        $testTarget = Setting::where('key', 'mail_from_address')->value('value');
        
        if (!$testTarget) {
            return back()->with('error', 'Please save a From Email Address first.');
        }

        try {
            // Apply current settings from database
            $settings = Setting::all()->pluck('value', 'key');
            
            if (!isset($settings['mail_host'])) {
                return back()->with('error', 'SMTP settings not found. Please save them first.');
            }

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

            \Illuminate\Support\Facades\Mail::raw('This is a test email from your YWP Admin Panel. Your SMTP settings are working perfectly!', function($message) use ($testTarget) {
                $message->to($testTarget)->subject('SMTP Test Successful');
            });

            return back()->with('success', 'Test email sent successfully to ' . $testTarget);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send test email: ' . $e->getMessage());
        }
    }

    public function testRazorpay()
    {
        $keyId = trim(Setting::where('key', 'razorpay_key')->value('value') ?? '');
        $keySecret = trim(Setting::where('key', 'razorpay_secret')->value('value') ?? '');

        if (!$keyId || !$keySecret) {
            return back()->with('error', 'Razorpay keys not configured.');
        }

        try {
            $api = new \Razorpay\Api\Api($keyId, $keySecret);
            // Try to fetch something simple to test authentication
            $api->payment->all(['count' => 1]);
            return back()->with('success', 'Razorpay Connection Successful! Your keys are valid.');
        } catch (\Exception $e) {
            return back()->with('error', 'Razorpay Connection Failed: ' . $e->getMessage());
        }
    }
}

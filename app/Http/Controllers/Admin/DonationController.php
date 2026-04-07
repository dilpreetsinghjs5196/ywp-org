<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Subscription;
use App\Models\Setting;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    public function subscriptions()
    {
        $api = $this->getRazorpayApi();
        $localSubs = Subscription::latest()->get();
        $enrichedSubs = collect();

        foreach ($localSubs as $sub) {
            $item = new \stdClass();
            $item->id = $sub->id;
            $item->donor_name = $sub->donor_name;
            $item->donor_email = $sub->donor_email;
            $item->amount = $sub->amount;
            $item->razorpay_subscription_id = $sub->razorpay_subscription_id;
            $item->status = $sub->status;
            $item->next_billing_at_display = 'N/A';
            $item->live_status = $sub->status;

            // Try to fetch live data from Razorpay
            if ($api && $sub->razorpay_subscription_id) {
                try {
                    $rzpSub = $api->subscription->fetch($sub->razorpay_subscription_id);
                    $item->live_status = $rzpSub->status;
                    if (!empty($rzpSub->charge_at)) {
                        $item->next_billing_at_display = \Carbon\Carbon::createFromTimestamp($rzpSub->charge_at, 'Asia/Kolkata')->format('d M, Y');
                    }
                    // Also update the local record so it stays in sync
                    $sub->update([
                        'status' => $rzpSub->status,
                        'next_billing_at' => !empty($rzpSub->charge_at) ? date('Y-m-d H:i:s', $rzpSub->charge_at) : null,
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error fetching Razorpay subscription: ' . $e->getMessage());
                }
            } elseif ($sub->next_billing_at) {
                $item->next_billing_at_display = \Carbon\Carbon::parse($sub->next_billing_at)->format('d M, Y');
            }

            $enrichedSubs->push($item);
        }

        return view('admin.subscriptions.index', ['subscriptions' => $enrichedSubs]);
    }

    public function cancelSubscription($id)
    {
        $sub = Subscription::findOrFail($id);
        $api = $this->getRazorpayApi();

        if (!$api) {
            return back()->with('error', 'Razorpay API keys not configured.');
        }

        try {
            $rzpSub = $api->subscription->fetch($sub->razorpay_subscription_id);
            
            if ($rzpSub->status === 'active' || $rzpSub->status === 'created') {
                $rzpSub->cancel(['cancel_at_cycle_end' => 0]); // Cancel immediately
            }

            $sub->update(['status' => 'cancelled']);
            
            return back()->with('success', 'Subscription cancelled successfully.');
        } catch (\Exception $e) {
            Log::error('Razorpay Subscription Cancel Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to cancel subscription: ' . $e->getMessage());
        }
    }
    private function getRazorpayApi()
    {
        $keyId = Setting::where('key', 'razorpay_key')->value('value');
        $keySecret = Setting::where('key', 'razorpay_secret')->value('value');

        if (!$keyId || !$keySecret) {
            return null;
        }

        return new Api($keyId, $keySecret);
    }

    public function index()
    {
        $api = $this->getRazorpayApi();
        $donations = collect();

        if ($api) {
            try {
                // Fetch latest 100 payments from Razorpay
                $payments = $api->payment->all(['count' => 100]);
                
                foreach ($payments->items as $payment) {
                    if ($payment->status === 'captured') {
                        $notes = $payment->notes;
                        $donations->push((object)[
                            'id' => $payment->id,
                            'donor_name' => $notes->name ?? $notes->full_name ?? ($payment->email ? explode('@', $payment->email)[0] : 'Donor'),
                            'donor_email' => $payment->email,
                            'donor_mobile' => $payment->contact,
                            'donor_pan' => $notes->pan_number ?? $notes->pan ?? 'N/A',
                            'donor_address' => $notes->address ?? $notes->residential_address ?? 'N/A',
                            'referred_by' => $notes->referred_by ?? 'N/A',
                            'amount' => $payment->amount / 100,
                            'currency' => $payment->currency,
                            'payment_id' => $payment->id,
                            'status' => $payment->status,
                            'created_at' => date('Y-m-d H:i:s', $payment->created_at)
                        ]);
                    }
                }
            } catch (\Exception $e) {
                Log::error('Error fetching Razorpay payments: ' . $e->getMessage());
                session()->flash('error', 'Error fetching data from Razorpay API.');
            }
        }

        return view('admin.donations.index', compact('donations'));
    }

    public function download()
    {
        $api = $this->getRazorpayApi();
        $filename = "donors_" . date('Y-m-d') . ".csv";
        
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Payment ID', 'Name', 'Email', 'Mobile', 'PAN', 'Address', 'Referred By', 'Amount', 'Currency', 'Status', 'Date');

        $callback = function() use ($api, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            if ($api) {
                try {
                    $payments = $api->payment->all(['count' => 100]);
                    foreach ($payments->items as $payment) {
                        if ($payment->status === 'captured') {
                            $notes = $payment->notes;
                            fputcsv($file, array(
                                $payment->id,
                                $notes->name ?? $notes->full_name ?? ($payment->email ? explode('@', $payment->email)[0] : 'Donor'),
                                $payment->email,
                                $payment->contact,
                                $notes->pan_number ?? $notes->pan ?? 'N/A',
                                $notes->address ?? $notes->residential_address ?? 'N/A',
                                $notes->referred_by ?? 'N/A',
                                $payment->amount / 100,
                                $payment->currency,
                                $payment->status,
                                date('Y-m-d H:i:s', $payment->created_at)
                            ));
                        }
                    }
                } catch (\Exception $e) {}
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
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

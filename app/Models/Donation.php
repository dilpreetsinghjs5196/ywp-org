<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    //
    protected $fillable = [
        'donor_name', 'donor_email', 'donor_mobile', 'donor_pan',
        'donor_address', 'referred_by', 'amount', 'currency',
        'payment_id', 'order_id', 'subscription_id', 'is_recurring', 'status', 'details',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}

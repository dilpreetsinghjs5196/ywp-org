<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'razorpay_subscription_id',
        'razorpay_plan_id',
        'donor_name',
        'donor_email',
        'amount',
        'status',
        'next_billing_at',
        'cancelled_at'
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}

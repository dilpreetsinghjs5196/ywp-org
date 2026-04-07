@extends('layouts.app')

@section('title', 'Manage Subscription | YWP')

@push('styles')
<style>
    .manage-page {
        padding: 100px 0;
        background: #f8fafc;
        min-height: 80vh;
    }

    .manage-card {
        background: #fff;
        border-radius: 30px;
        box-shadow: 0 40px 80px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid #f1f5f9;
        max-width: 600px;
        margin: 0 auto;
    }

    .manage-header {
        background: #0f172a;
        color: #fff;
        padding: 40px;
        text-align: center;
    }

    .manage-body {
        padding: 50px;
    }

    .sub-info {
        background: #f1f5f9;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 40px;
        border-left: 5px solid #ff7e3b;
    }

    .sub-info h4 {
        color: #0f172a;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .sub-info p {
        color: #64748b;
        margin-bottom: 0;
        font-weight: 500;
    }

    .form-group label {
        font-weight: 700;
        color: #475569;
        margin-bottom: 15px;
        display: block;
    }

    .form-control {
        padding: 18px;
        border-radius: 15px;
        border: 2px solid #f1f5f9;
        font-weight: 600;
        font-size: 16px;
    }

    .form-control:focus {
        border-color: #ff7e3b;
        box-shadow: 0 0 0 4px rgba(255, 126, 59, 0.1);
    }

    .btn-cancel-subscription {
        width: 100%;
        background: #ef4444;
        color: #fff;
        padding: 20px;
        border-radius: 15px;
        font-size: 18px;
        font-weight: 800;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-cancel-subscription:hover {
        background: #dc2626;
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(239, 68, 68, 0.2);
    }

    .btn-return {
        display: block;
        text-align: center;
        margin-top: 25px;
        color: #64748b;
        font-weight: 600;
        text-decoration: none;
        font-size: 15px;
    }

    .btn-return:hover {
        color: #0f172a;
    }
</style>
@endpush

@section('content')
<section class="manage-page">
    <div class="container">
        <div class="manage-card">
            <div class="manage-header">
                <h2>Manage Donation</h2>
                <p class="mb-0">Securely manage or stop your monthly support</p>
            </div>

            <div class="manage-body">
                @if(session('error'))
                    <div class="alert alert-danger mb-4 rounded-3 border-0 shadow-sm">
                        <i class="fa fa-exclamation-circle me-2"></i> {{ session('error') }}
                    </div>
                @endif

                <div class="sub-info">
                    <h4>Monthly Donation</h4>
                    <p>Amount: ₹{{ number_format($subscription->amount, 2) }} / month</p>
                    <p>Donor: {{ $subscription->donor_name }}</p>
                    <p>Status: <span class="badge {{ $subscription->status == 'active' ? 'bg-success' : 'bg-info' }}">{{ ucfirst($subscription->status) }}</span></p>
                </div>

                @if($subscription->status === 'active' || $subscription->status === 'created')
                    <form action="{{ route('subscription.cancel', $subscription->razorpay_subscription_id) }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label>To confirm, please enter your registered email address:</label>
                            <input type="email" name="email" class="form-control" placeholder="your@email.com" required>
                        </div>

                        <button type="submit" class="btn-cancel-subscription" onclick="return confirm('Are you sure you want to stop your monthly donation? This action cannot be undone.')">
                            Stop Monthly Donation
                        </button>
                    </form>
                @else
                    <div class="text-center py-4">
                        <i class="fa fa-info-circle fa-4x text-muted mb-3 opacity-25"></i>
                        <h5>Subscription {{ ucfirst($subscription->status) }}</h5>
                        <p class="text-muted">This recurring donation is no longer active.</p>
                    </div>
                @endif

                <a href="{{ url('/') }}" class="btn-return">
                    <i class="fa fa-arrow-left me-1"></i> Return to Website
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

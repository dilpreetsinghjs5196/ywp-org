@extends('admin.layouts.app')

@section('content')
    <div class="mb-4">
        <h1>General Settings</h1>
        <p class="text-muted">Configure Razorpay and email notifications here.</p>
    </div>

    <div class="glass-card">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h4 class="mb-3">Razorpay Integration</h4>
                    <div class="mb-3">
                        <label class="form-label">Razorpay Key ID</label>
                        <input type="text" name="razorpay_key" class="form-control"
                            value="{{ $settings['razorpay_key'] ?? '' }}" placeholder="rzp_test_...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Razorpay Secret Key</label>
                        <input type="password" name="razorpay_secret" class="form-control"
                            value="{{ $settings['razorpay_secret'] ?? '' }}" placeholder="••••••••••••••">
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('admin.settings.test-razorpay') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-plug"></i> Test Connection
                        </a>
                    </div>
                    <small class="text-muted d-block mt-2">
                        <i class="fa fa-info-circle"></i> These keys are used to fetch donor information from Razorpay.
                    </small>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-grid d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-premium">Save Settings</button>
            </div>
        </form>
    </div>
@endsection
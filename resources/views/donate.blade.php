@extends('layouts.app')

@section('title', 'Donate | YWP')

@push('styles')
<style>
    :root {
        --primary-orange: #ff7e3b;
        --secondary-orange: #ff9d6c;
        --accent-dark: #0f172a;
    }

    .donate-page {
        padding: 80px 0;
        background: #f8fafc;
    }

    .donate-card {
        background: #fff;
        border-radius: 30px;
        box-shadow: 0 40px 80px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid #f1f5f9;
    }

    .donate-header {
        background: var(--accent-dark);
        color: #fff;
        padding: 40px;
        text-align: center;
    }

    .donate-header h2 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .donate-body {
        padding: 50px;
    }

    /* Toggle Switch */
    .toggle-container {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
    }

    .toggle-switch {
        background: #f1f5f9;
        padding: 6px;
        border-radius: 100px;
        display: flex;
        gap: 5px;
        position: relative;
    }

    .toggle-option {
        padding: 12px 30px;
        border-radius: 100px;
        cursor: pointer;
        font-weight: 700;
        font-size: 15px;
        transition: all 0.3s ease;
        z-index: 2;
        color: #64748b;
    }

    .toggle-option.active {
        background: var(--primary-orange);
        color: #fff;
        box-shadow: 0 10px 20px rgba(255, 126, 59, 0.2);
    }

    /* Amount Grid */
    .amount-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 30px;
    }

    .amount-item {
        border: 2px solid #f1f5f9;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 800;
        font-size: 18px;
        color: #1e293b;
    }

    .amount-item:hover {
        border-color: var(--secondary-orange);
        background: rgba(255, 126, 59, 0.02);
    }

    .amount-item.active {
        border-color: var(--primary-orange);
        background: rgba(255, 126, 59, 0.05);
        color: var(--primary-orange);
    }

    .custom-amount-wrapper {
        position: relative;
        margin-bottom: 40px;
    }

    .custom-amount-input {
        width: 100%;
        padding: 20px 20px 20px 50px;
        border: 2px solid #f1f5f9;
        border-radius: 15px;
        font-size: 20px;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .custom-amount-input:focus {
        border-color: var(--primary-orange);
        outline: none;
        box-shadow: 0 0 0 4px rgba(255, 126, 59, 0.1);
    }

    .currency-symbol {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        font-weight: 800;
        color: #94a3b8;
    }

    /* Form Fields */
    .form-group label {
        font-weight: 700;
        color: #475569;
        margin-bottom: 10px;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .required-star {
        color: #ff4c1e;
        margin-left: 2px;
    }

    .form-control {
        padding: 15px;
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        font-weight: 500;
    }

    .form-control:focus {
        border-color: var(--primary-orange);
        box-shadow: none;
    }

    .btn-donate-submit {
        width: 100%;
        background: var(--primary-orange);
        color: #fff;
        padding: 20px;
        border-radius: 15px;
        font-size: 18px;
        font-weight: 800;
        border: none;
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .btn-donate-submit:hover {
        background: var(--accent-dark);
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .cancel-anytime-msg {
        text-align: center;
        margin-top: 30px;
        color: #94a3b8;
        font-size: 14px;
        font-weight: 500;
    }

    .cancel-anytime-msg a {
        color: var(--primary-orange);
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .amount-grid { grid-template-columns: repeat(2, 1fr); }
        .donate-body { padding: 30px; }
    }
</style>
@endpush

@section('content')
<section class="donate-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="donate-card">
                    <div class="donate-header" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); position: relative; overflow: hidden;">
                        <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(255, 126, 59, 0.1); border-radius: 50%;"></div>
                        <h2 style="position: relative; z-index: 1; color: #ffffff !important;">Support Our Mission</h2>
                        <p style="position: relative; z-index: 1; opacity: 0.9; color: #ffffff !important;">Your contribution directly impacts mental health awareness.</p>
                    </div>

                    <div class="donate-body">
                        <!-- Toggle Switch -->
                        <div class="toggle-container">
                            <div class="toggle-switch">
                                <div class="toggle-option {{ request('type') != 'monthly' ? 'active' : '' }}" data-type="one_time">One-time</div>
                                <div class="toggle-option {{ request('type') == 'monthly' ? 'active' : '' }}" data-type="monthly">Monthly</div>
                            </div>
                        </div>

                        <form id="donateForm">
                            @csrf
                            <input type="hidden" name="type" id="donationType" value="{{ request('type') == 'monthly' ? 'monthly' : 'one_time' }}">
                            <input type="hidden" name="amount" id="selectedAmount" value="1000">

                            <!-- Dynamic Heading -->
                            <div class="text-center mb-4">
                                <h3 id="donationTitle" style="font-weight: 800; color: #0f172a; margin-bottom: 5px;">
                                    {{ request('type') == 'monthly' ? 'Monthly Subscription' : 'One-time Donation' }}
                                </h3>
                                <p id="donationDesc" class="text-muted small">
                                    {{ request('type') == 'monthly' ? 'Choose an amount to contribute every month' : 'Choose an amount to contribute once' }}
                                </p>
                            </div>

                            <!-- Amount Selection -->
                            <label class="form-label d-block text-center mb-3 text-uppercase fw-bold" style="font-size: 12px; letter-spacing: 1px; color: #94a3b8;">Select Amount (INR)</label>
                            <div class="amount-grid">
                                <div class="amount-item" data-amount="500">₹500</div>
                                <div class="amount-item active" data-amount="1000">₹1000</div>
                                <div class="amount-item" data-amount="2000">₹2000</div>
                                <div class="amount-item" data-amount="5000">₹5000</div>
                                <div class="amount-item" data-amount="10000">₹10000</div>
                                <div class="amount-item" data-amount="custom">Custom</div>
                            </div>

                            <div class="custom-amount-wrapper" id="customAmountGroup" style="display: none;">
                                <span class="currency-symbol">₹</span>
                                <input type="number" class="custom-amount-input" id="customAmount" placeholder="Enter custom amount">
                            </div>

                            <!-- Donor Details -->
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label>Full Name <span class="required-star">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label>Email Address <span class="required-star">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label>Contact Number <span class="required-star">*</span></label>
                                    <input type="text" name="mobile" class="form-control" placeholder="98XXXXXXXX" required>
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label>Referred By</label>
                                    <input type="text" name="referred_by" class="form-control" placeholder="Friend, Social Media, etc.">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label>PAN Number <span class="required-star">*</span></label>
                                    <input type="text" name="pan" class="form-control" placeholder="ABCDE1234F" required>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>Residential Address</label>
                                    <textarea name="address" class="form-control" rows="2" placeholder="Your full address for 80G receipt"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn-donate-submit" id="submitBtn">
                                Donate <span id="btnAmount">₹1000</span> Now
                            </button>

                            <div class="cancel-anytime-msg" id="monthlyMsg" style="{{ request('type') == 'monthly' ? '' : 'display:none;' }}">
                                <i class="fa fa-info-circle"></i> You can cancel your monthly donation anytime by emailing us at 
                                <a href="mailto:info@yourewonderfulproject.org">info@yourewonderfulproject.org</a>.
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).ready(function() {
        // Toggle Logic
        $('.toggle-option').click(function() {
            $('.toggle-option').removeClass('active');
            $(this).addClass('active');
            
            const type = $(this).data('type');
            $('#donationType').val(type);
            
            if(type === 'monthly') {
                $('#donationTitle').text('Monthly Subscription');
                $('#donationDesc').text('Choose an amount to contribute every month');
                $('#monthlyMsg').slideDown();
            } else {
                $('#donationTitle').text('One-time Donation');
                $('#donationDesc').text('Choose an amount to contribute once');
                $('#monthlyMsg').slideUp();
            }
        });

        // Amount Selection
        $('.amount-item').click(function() {
            $('.amount-item').removeClass('active');
            $(this).addClass('active');
            
            const amt = $(this).data('amount');
            if(amt === 'custom') {
                $('#customAmountGroup').slideDown();
                $('#selectedAmount').val($('#customAmount').val() || 0);
            } else {
                $('#customAmountGroup').slideUp();
                $('#selectedAmount').val(amt);
                $('#btnAmount').text('₹' + amt);
            }
        });

        $('#customAmount').on('input', function() {
            const val = $(this).val();
            $('#selectedAmount').val(val);
            $('#btnAmount').text('₹' + (val || 0));
        });

        // Form Submission
        $('#donateForm').submit(function(e) {
            e.preventDefault();
            const btn = $('#submitBtn');
            btn.prop('disabled', true).text('Processing...');

            $.post("{{ route('donate.initiate') }}", $(this).serialize(), function(response) {
                if(response.error) {
                    alert(response.error);
                    btn.prop('disabled', false).html('Donate <span id="btnAmount">₹' + $('#selectedAmount').val() + '</span> Now');
                    return;
                }

                const options = {
                    "key": response.razorpay_key,
                    "amount": response.amount,
                    "currency": response.currency,
                    "name": "You’re Wonderful Project;",
                    "description": response.description,
                    "image": "{{ asset('images/ymp-logo.png') }}",
                    "prefill": {
                        "name": response.prefill.name,
                        "email": response.prefill.email,
                        "contact": response.prefill.contact
                    },
                    "theme": {
                        "color": "#ff7e3b"
                    },
                    "handler": function (res) {
                        // After payment, redirect to the thanks page
                        window.location.href = "{{ route('thanks') }}";
                    }
                };

                if(response.order_id) {
                    options.order_id = response.order_id;
                } else if(response.subscription_id) {
                    options.subscription_id = response.subscription_id;
                }

                const rzp = new Razorpay(options);
                rzp.open();
                
                rzp.on('payment.failed', function (res) {
                    alert("Payment Failed: " + res.error.description);
                    btn.prop('disabled', false).html('Donate <span id="btnAmount">₹' + $('#selectedAmount').val() + '</span> Now');
                });

            }).fail(function(xhr) {
                const errorMsg = (xhr.responseJSON && xhr.responseJSON.error) ? xhr.responseJSON.error : "Something went wrong. Please try again.";
                alert(errorMsg);
                btn.prop('disabled', false).html('Donate <span id="btnAmount">₹' + $('#selectedAmount').val() + '</span> Now');
            });
        });
    });
</script>
@endpush
@endsection

@extends('layouts.app')

@section('title', 'Thank You | YWP')

@push('styles')
<style>
    .thanks-page {
        padding: 100px 0;
        text-align: center;
        background: #f8fafc;
        min-height: 70vh;
        display: flex;
        align-items: center;
    }
    .thanks-card {
        background: #fff;
        padding: 60px;
        border-radius: 30px;
        box-shadow: 0 40px 80px rgba(0,0,0,0.05);
        max-width: 600px;
        margin: 0 auto;
    }
    .thanks-icon {
        width: 100px;
        height: 100px;
        background: #ff7e3b;
        color: #fff;
        font-size: 50px;
        line-height: 100px;
        border-radius: 50%;
        margin: 0 auto 30px;
        animation: scaleIn 0.5s ease-out;
    }
    .thanks-card h1 {
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 20px;
    }
    .thanks-card p {
        color: #64748b;
        font-size: 18px;
        margin-bottom: 30px;
    }
    .redirect-msg {
        font-size: 14px;
        color: #94a3b8;
    }
    .redirect-msg span {
        color: #ff7e3b;
        font-weight: 700;
    }
    @keyframes scaleIn {
        0% { transform: scale(0); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
</style>
@endpush

@section('content')
<section class="thanks-page">
    <div class="container">
        <div class="thanks-card">
            <div class="thanks-icon">
                <i class="fa fa-heart"></i>
            </div>
            <h1>Thanks a lot!</h1>
            <p>Your generous contribution will directly impact our mental health initiatives. You are making a real difference.</p>
            <div class="redirect-msg">
                You will be redirected to the home page in <span id="countdown">5</span> seconds...
            </div>
            <a href="{{ url('/') }}" class="thm-btn mt-4" style="padding: 12px 30px; font-size: 14px;">Back to Home</a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    let seconds = 5;
    const countdownEl = document.getElementById('countdown');
    
    const timer = setInterval(() => {
        seconds--;
        countdownEl.innerText = seconds;
        if (seconds <= 0) {
            clearInterval(timer);
            window.location.href = "{{ url('/') }}";
        }
    }, 1000);
</script>
@endpush

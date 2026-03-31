@extends('layouts.app')

@section('content')
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('assets/images/backgrounds/page-header-bg.jpg') }});"></div>
    <div class="container">
        <div class="page-header__inner">
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><span>/</span></li>
                <li>Campaigns</li>
            </ul>
            <h2>Our Campaigns</h2>
        </div>
    </div>
</section>

<section class="campaigns-page pb-5">
    <div class="container">
        @foreach($campaigns as $camp)
            @php 
                $anchorId = Str::slug($camp->title);
            @endphp
            <div class="row pt-5 mt-5 align-items-center" id="{{ $anchorId }}">
                <div class="col-xl-6">
                    <div class="campaigns-page__img">
                        <img src="{{ asset($camp->image ?? 'images/campaigns-1-1.jpg') }}" alt="" style="width: 100%; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="campaigns-page__content pl-xl-5">
                        <div class="section-title text-left mb-3">
                            <span class="section-title__tagline" style="color: var(--accent-orange); font-weight: 700;">{{ $camp->category ?? 'Initiative' }}</span>
                            <h2 class="section-title__title" style="font-size: 36px;">{{ $camp->title }}</h2>
                        </div>
                        <p class="campaigns-page__text" style="font-size: 18px; line-height: 1.8; color: #555;">
                            {{ $camp->description }}
                        </p>
                        @if($camp->link)
                            <div class="mt-4">
                                <a href="{{ url($camp->link) }}" class="thm-btn">Learn More</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if(!$loop->last)
                <div class="mt-5 pt-5 border-bottom"></div>
            @endif
        @endforeach
    </div>
</section>
@endsection

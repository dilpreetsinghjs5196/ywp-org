@extends('layouts.app')

@section('content')
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header-bg" style="background-image: url({{ asset($contents['header']['bg_image'] ?? 'images/page-header-bg.jpg') }})">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>{{ $contents['header']['title'] ?? 'Our Mission' }}</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><span>/</span></li>
                    <li class="active">{{ $contents['header']['title'] ?? 'Our Mission' }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Our Mission Start-->
    <section class="donations-details">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-11">
                    <div class="donation-details__left">
                        
                        <div class="donation-details__content">
                            <h3 class="donation-details__title">{{ $contents['mission']['title'] ?? 'Our Mission' }}</h3>
                            <p class="donation-details__text-1">
                                {!! nl2br(e($contents['mission']['content'] ?? '')) !!}
                            </p>
                            
                            <div class="donation-details__content-img-boxes">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="donation-details__content-img-single">
                                            <img src="{{ asset($contents['mission']['image1'] ?? 'images/donation-details-content-img-1.jpg') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="donation-details__content-img-single">
                                            <img src="{{ asset($contents['mission']['image2'] ?? 'images/donation-details-content-img-2.jpg') }}"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Our Mission End-->
@endsection

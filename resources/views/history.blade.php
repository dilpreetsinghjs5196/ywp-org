@extends('layouts.app')

@section('content')
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header-bg" style="background-image: url({{ asset($contents['header']['bg_image'] ?? 'images/fundraishing-bg.jpg') }})">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>{{ $contents['header']['title'] ?? 'History' }}</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><span>/</span></li>
                    <li class="active">{{ $contents['header']['title'] ?? 'History' }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--History Start-->
    <section class="donations-details">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-11">
                    <div class="donation-details__left">
                        
                        <div class="donation-details__content">
                            <h3 class="donation-details__title">{{ $contents['history']['title'] ?? 'History' }}</h3>
                            <p class="donation-details__text-1">
                                {!! nl2br(e($contents['history']['content'] ?? '')) !!}
                            </p>
                            
                            <div class="donation-details__content-img-boxes">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="donation-details__content-img-single">
                                            <img src="{{ asset($contents['history']['image1'] ?? 'images/his-1.jpg') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="donation-details__content-img-single">
                                            <img src="{{ asset($contents['history']['image2'] ?? 'images/his-2.jpg') }}"
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
    <!--History End-->
@endsection

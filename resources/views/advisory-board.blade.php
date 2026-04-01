@extends('layouts.app')

@section('content')
    <style>
        .featured-campaigns__single {
            display: flex;
            align-items: flex-start;
            gap: 40px;
            margin-bottom: 60px;
            flex-wrap: nowrap;
        }

        .featured-campaigns__content {
            flex: 1;
            max-width: 60%;
        }

        .featured-campaigns__img {
            flex-shrink: 0;
            width: 35% !important;
            max-width: 450px;
        }

        .featured-campaigns__img img {
            width: 100% !important;
            height: auto !important;
            border-radius: 15px;
            object-fit: cover;
        }

        .featured-campaigns__title {
            font-size: 32px;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .featured-campaigns__text {
            font-size: 16px;
            line-height: 1.8;
            color: #64748b;
        }

        @media (max-width: 991px) {
            .featured-campaigns__single {
                flex-direction: column-reverse;
                gap: 20px;
            }
            .featured-campaigns__content, .featured-campaigns__img {
                max-width: 100%;
                width: 100% !important;
            }
        }
    </style>
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header-bg" style="background-image: url({{ asset($contents['header']['bg_image'] ?? 'images/advisery.jpg') }})">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>{{ $contents['header']['title'] ?? 'Advisory Board' }}</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><span>/</span></li>
                    <li class="active">{{ $contents['header']['title'] ?? 'Advisory Board' }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Advisory Board Start-->
    <section class="featured-campaigns">
        <div class="container">
            <br/>
            <div class="section-title text-left">
                <h2 class="section-title__title">{{ $contents['header']['title'] ?? 'Advisory Board' }}</h2>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    @php
                        // Group member data
                        $members = [];
                        if (isset($contents['members'])) {
                            foreach ($contents['members'] as $key => $value) {
                                if (preg_match('/member(\d+)_(\w+)/', $key, $matches)) {
                                    $members[$matches[1]][$matches[2]] = $value;
                                }
                            }
                            ksort($members);
                        }
                    @endphp

                    @foreach($members as $index => $member)
                        <!--Featured Campaigns Single-->
                        <div class="featured-campaigns__single">
                            <div class="featured-campaigns__content">
                                <h3 class="featured-campaigns__title">{{ $member['name'] ?? '' }}</h3>
                                <p class="featured-campaigns__text">
                                    {!! nl2br(e($member['desc'] ?? '')) !!}
                                </p>
                            </div>
                            <div class="featured-campaigns__img">
                                <img src="{{ asset($member['image'] ?? 'images/preeti.jpg') }}" alt="{{ $member['name'] ?? '' }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--Advisory Board End-->
@endsection

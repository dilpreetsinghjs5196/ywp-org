@extends('layouts.app')

@section('content')
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header-bg" style="background-image: url({{ asset('images/slider-main-3.jpg') }})">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>Policies</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><span>/</span></li>
                    <li class="active">Policies</li>
                </ul>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <style>
        /* Robust, specific design system for Policies */
        .ywp-policy-card {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            background-color: #f2f0ec;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .ywp-policy-card:hover {
            transform: translateY(-5px);
        }

        .ywp-policy-content {
            padding: 40px;
            flex: 1;
        }

        .ywp-policy-img {
            height: 300px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Desktop specific layout */
        @media (min-width: 992px) {
            .ywp-policy-card {
                flex-direction: row;
                align-items: stretch;
                min-height: 400px;
            }
            .ywp-policy-content {
                flex: 0 0 50%;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .ywp-policy-img {
                flex: 0 0 50%;
                height: auto;
            }
        }
    </style>

    <!--Policies Section-->
    <section class="featured-campaigns" id="policies-container" style="padding: 0 0 200px; display: block; position: relative;">
        <div class="container">
            <br/>
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    @forelse($policies as $index => $policy)
                        @php
                            $chunkIndex = $index % 3;
                            $topOffset = $chunkIndex * 20;
                            $isThird = ($index + 1) % 3 === 0;
                            $hasMoreAfterChunk = ($index + 1) < count($policies);
                            $extraMarginValue = ($isThird && $hasMoreAfterChunk) ? 120 : 20;
                            
                            $inlineStyle = "margin-bottom: {$extraMarginValue}px;";
                            if ($topOffset > 0) {
                                $inlineStyle .= " position: relative; top: {$topOffset}px;";
                            }
                            
                            // Background Style
                            $bgStyle = "";
                            if ($policy->image) {
                                $bgStyle = "background-image: url('" . asset($policy->image) . "');";
                            } else {
                                $bgStyle = "background-color: #ebd2d2;"; // Default color from original design
                            }
                        @endphp
                        
                        <!--Policy Single Card-->
                        <div class="ywp-policy-card" style="{{ $inlineStyle }}">
                            <div class="ywp-policy-content">
                                <h3 class="featured-campaigns__title" style="margin-top:0;">{{ $policy->title }}</h3>
                                
                                @if($policy->description)
                                    <p class="featured-campaigns__text" style="flex-grow: 1; margin-bottom: 20px;">{{ $policy->description }}</p>
                                @endif

                                @if($policy->link)
                                    <div class="events__single" style="margin-top: auto;">
                                        <h3 class="events__title" style="margin:0;">
                                            <a href="{{ $policy->link }}" target="_blank" style="color: var(--pifoxen-base); font-size: 18px; font-weight: 700;">View & Download >></a>
                                        </h3>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Image Panel -->
                            <div class="ywp-policy-img" style="{{ $bgStyle }}">
                                @if(!$policy->image)
                                    <div style="height: 100%; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.02); width: 100%;">
                                        <img src="{{ asset('images/gallery/paper/logo docs.png') }}" alt="Default Logo" style="max-height: 150px; opacity: 0.8;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="container text-center py-5">
                            <p>No policies found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <!--Policies Section End-->

@endsection

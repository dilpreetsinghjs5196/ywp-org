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
        /* Document Tabs */
        .document-tabs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .doc-tab {
            padding: 12px 25px;
            border-radius: 50px;
            background: #fff;
            color: #777;
            font-weight: 600;
            border: 2px solid #eee;
            transition: all 0.3s ease;
            text-decoration: none !important;
        }

        .doc-tab:hover, .doc-tab.active {
            background: var(--pifoxen-base);
            color: #fff;
            border-color: var(--pifoxen-base);
        }

        /* Pagination Styling */
        .pagination-wrapper {
            margin-top: 50px;
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper .pagination {
            display: flex;
            gap: 10px;
        }

        .pagination-wrapper .page-item .page-link {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50% !important;
            border: 2px solid #f2f0ec;
            color: #777;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .pagination-wrapper .page-item.active .page-link,
        .pagination-wrapper .page-item .page-link:hover {
            background-color: var(--pifoxen-base);
            border-color: var(--pifoxen-base);
            color: #fff;
        }

        /* Search Bar Styles */
        .research-search-form {
            position: relative;
            z-index: 10;
        }

        .search-input-wrapper {
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border-radius: 50px;
            overflow: hidden;
        }

        .search-input {
            height: 70px;
            border-radius: 50px !important;
            padding-left: 35px;
            padding-right: 150px;
            border: 2px solid #f2f0ec;
            font-size: 18px;
            transition: all 0.3s ease;
            background: #fff;
        }

        .search-input:focus {
            border-color: var(--pifoxen-base);
            box-shadow: 0 10px 30px rgba(255, 76, 30, 0.1);
        }

        .search-btn {
            position: absolute;
            right: 5px;
            top: 5px;
            bottom: 5px;
            background-color: var(--pifoxen-base);
            color: white;
            border-radius: 50px !important;
            padding: 0 35px;
            font-size: 18px;
            font-weight: 700;
            transition: all 0.3s ease;
            border: none;
        }

        .search-btn:hover {
            background-color: #1a1a1a;
            color: white;
        }

        .search-info {
            font-size: 15px;
            color: #777;
            background: #f9f9f9;
            padding: 10px 20px;
            border-radius: 30px;
            display: inline-block;
        }

        .clear-search {
            color: var(--pifoxen-base);
            text-decoration: none;
            font-weight: 700;
            margin-left: 15px;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .clear-search:hover {
            border-bottom-color: var(--pifoxen-base);
            color: var(--pifoxen-base);
        }
    </style>

    <!--Policies Section-->
    <section class="featured-campaigns" id="policies-container" style="padding: 60px 0 200px; display: block; position: relative;">
        <div class="container">
            
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <div class="document-tabs">
                        <a href="{{ route('research-papers') }}" class="doc-tab">Research Papers</a>
                        <a href="{{ route('policies') }}" class="doc-tab active">Policies</a>
                        <a href="{{ route('reports') }}" class="doc-tab">Reports</a>
                        <a href="{{ route('newsletters') }}" class="doc-tab">Newsletters</a>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-lg-8 mx-auto">
                    <form action="{{ route('policies') }}" method="GET" class="research-search-form">
                        <div class="search-input-wrapper">
                            <input type="text" name="search" id="policy-search-input" class="form-control search-input" placeholder="Search policies..." value="{{ request('search') }}">
                            <button class="btn search-btn" type="submit">
                                <i class="fa fa-search"></i> Search
                            </button>
                        </div>
                        @if(request('search'))
                            <div class="mt-4 text-center">
                                <div class="search-info">
                                    <span>Found {{ $policies->total() }} results for: <strong>"{{ request('search') }}"</strong></span>
                                    <a href="{{ route('policies') }}" class="clear-search">Clear Search <i class="fa fa-times-circle"></i></a>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

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

            @if($policies->hasPages())
                <div class="pagination-wrapper">
                    {{ $policies->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </section>
    <!--Policies Section End-->

@push('scripts')
<script>
    $(document).ready(function() {
        $('#policy-search-input').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $(".ywp-policy-card").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endpush
@endsection

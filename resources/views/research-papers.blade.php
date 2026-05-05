@extends('layouts.app')

@section('content')
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header-bg" style="background-image: url({{ asset('images/slider-main-3.jpg') }})">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>Research Papers</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><span>/</span></li>
                    <li class="active">Research Papers</li>
                </ul>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <style>
        /* Robust, specific design system for Research Papers */
        .ywp-research-card {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            background-color: #f2f0ec;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .ywp-research-card:hover {
            transform: translateY(-5px);
        }

        .ywp-research-content {
            padding: 40px;
            flex: 1;
        }

        .ywp-research-img {
            height: 300px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Desktop specific layout */
        @media (min-width: 992px) {
            .ywp-research-card {
                flex-direction: row;
                align-items: stretch;
                min-height: 400px;
            }
            .ywp-research-content {
                flex: 0 0 50%;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .ywp-research-img {
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

    <!--Research Papers Section-->
    <section class="featured-campaigns" id="research-papers-container" style="padding: 60px 0 200px; display: block; position: relative;">
        <div class="container">
            
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <div class="document-tabs">
                        <a href="{{ route('research-papers') }}" class="doc-tab active">Research Papers</a>
                        <a href="{{ route('policies') }}" class="doc-tab">Policies</a>
                        <a href="{{ route('reports') }}" class="doc-tab">Reports</a>
                        <a href="{{ route('newsletters') }}" class="doc-tab">Newsletters</a>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-lg-8 mx-auto">
                    <form action="{{ route('research-papers') }}" method="GET" class="research-search-form">
                        <div class="search-input-wrapper">
                            <input type="text" name="search" id="research-search-input" class="form-control search-input" placeholder="Search research papers by title or keywords..." value="{{ request('search') }}">
                            <button class="btn search-btn" type="submit">
                                <i class="fa fa-search"></i> Search
                            </button>
                        </div>
                        @if(request('search'))
                            <div class="mt-4 text-center">
                                <div class="search-info">
                                    <span>Found {{ $reports->total() }} results for: <strong>"{{ request('search') }}"</strong></span>
                                    <a href="{{ route('research-papers') }}" class="clear-search">Clear Search <i class="fa fa-times-circle"></i></a>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <div class="row" id="research-papers-list">
                <div class="col-xl-12 col-xxl-12">
                    @forelse($reports as $index => $report)
                        @php
                            $chunkIndex = $index % 3;
                            $topOffset = $chunkIndex * 20;
                            $isThird = ($index + 1) % 3 === 0;
                            $hasMoreAfterChunk = ($index + 1) < count($reports);
                            $extraMarginValue = ($isThird && $hasMoreAfterChunk) ? 120 : 20;
                            
                            $inlineStyle = "margin-bottom: {$extraMarginValue}px;";
                            if ($topOffset > 0) {
                                $inlineStyle .= " position: relative; top: {$topOffset}px;";
                            }
                            
                            // Only set image background if it actually exists in DB
                            $bgStyle = "";
                            if ($report->image) {
                                $bgStyle = "background-image: url('" . asset($report->image) . "');";
                            }
                        @endphp
                        
                        <!--Research Paper Single Card-->
                        <div class="ywp-research-card" style="{{ $inlineStyle }}">
                            <div class="ywp-research-content">
                                <h3 class="featured-campaigns__title" style="margin-top:0;">{{ $report->title }}</h3>
                                
                                @if($report->description)
                                    <p class="featured-campaigns__text" style="flex-grow: 1; margin-bottom: 20px;">{{ $report->description }}</p>
                                @endif

                                @if($report->link)
                                    <div class="events__single" style="margin-top: auto;">
                                        <h3 class="events__title" style="margin:0;">
                                            <a href="{{ $report->link }}" target="_blank" style="color: var(--pifoxen-base); font-size: 18px; font-weight: 700;">Read more >></a>
                                        </h3>
                                    </div>
                                @elseif($report->id <= 20)
                                    <p class="featured-campaigns__text">.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                @endif
                            </div>
                            
                            <!-- Image Panel (only shows BG if image exists) -->
                            <div class="ywp-research-img" style="{{ $bgStyle }}">
                                @if(!$report->image)
                                    <div style="height: 100%; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.05); width: 100%;">
                                        <i class="fa fa-file-pdf fa-5x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="container text-center py-5">
                            <p>No research papers found.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            @if($reports->hasPages())
                <div class="pagination-wrapper">
                    {{ $reports->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </section>
    <!--Research Papers Section End-->



@push('scripts')
<script>
    $(document).ready(function() {
        // Live filtering for better UX
        $('#research-search-input').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            var visibleCount = 0;
            
            $(".ywp-research-card").filter(function() {
                var isVisible = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(isVisible);
                if(isVisible) visibleCount++;
            });
            
            // If we have no results locally, and it's not a server-side search result page
            // we could show a "No local results" message, but for now just toggling cards is enough.
        });
    });
</script>
@endpush
@endsection

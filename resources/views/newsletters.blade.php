@extends('layouts.app')

@section('content')
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header-bg" style="background-image: url({{ asset('images/slider-main-3.jpg') }})">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>Newsletters</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><span>/</span></li>
                    <li class="active">Newsletters</li>
                </ul>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <style>
        .newsletter-year-heading {
            font-size: 34px;
            font-weight: 700;
            color: var(--pifoxen-black, #1a1a2e);
            margin-bottom: 30px;
            padding-bottom: 12px;
            border-bottom: 3px solid var(--pifoxen-base, #e7452e);
            display: inline-block;
        }

        .newsletter-card {
            display: flex;
            flex-direction: row;
            min-height: 220px;
            margin-bottom: 20px;
            border-radius: 0;
            overflow: hidden;
            background: transparent;
        }

        .newsletter-card__content {
            flex: 0 0 50%;
            background-color: #f2f0ec;
            padding: 40px 40px 30px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .newsletter-card__image {
            flex: 0 0 50%;
            background-color: #ebd2d2;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 220px;
            position: relative;
            overflow: hidden;
        }

        .newsletter-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .newsletter-card__image .doc-icon {
            font-size: 90px;
            opacity: 0.6;
        }

        /* Google Docs-style document icon */
        .doc-placeholder {
            width: 100px;
            height: 120px;
            background: #4285f4;
            border-radius: 4px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .doc-placeholder::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 28px;
            height: 28px;
            background: #1a56c4;
            border-bottom-left-radius: 4px;
        }

        .doc-placeholder::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-left: 28px solid #aac4f8;
            border-bottom: 28px solid transparent;
        }

        .doc-lines {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding: 35px 15px 15px;
            width: 100%;
        }

        .doc-line {
            height: 8px;
            background: rgba(255,255,255,0.85);
            border-radius: 2px;
        }

        .doc-line.short { width: 55%; }

        .newsletter-card__title {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .newsletter-card__link {
            color: var(--pifoxen-base, #e7452e);
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: auto;
        }

        .newsletter-card__link:hover {
            text-decoration: underline;
            color: var(--pifoxen-base, #e7452e);
        }

        .year-group {
            margin-bottom: 70px;
        }

        /* Responsive */
        @media (max-width: 767px) {
            .newsletter-card {
                flex-direction: column;
            }
            .newsletter-card__content,
            .newsletter-card__image {
                flex: none;
                width: 100%;
            }
            .newsletter-card__image {
                min-height: 200px;
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

    <section class="newsletters-page" style="padding: 60px 0 120px;">
        <div class="container">
            
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <div class="document-tabs">
                        <a href="{{ route('research-papers') }}" class="doc-tab">Research Papers</a>
                        <a href="{{ route('policies') }}" class="doc-tab">Policies</a>
                        <a href="{{ route('reports') }}" class="doc-tab">Reports</a>
                        <a href="{{ route('newsletters') }}" class="doc-tab active">Newsletters</a>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-lg-8 mx-auto">
                    <form action="{{ route('newsletters') }}" method="GET" class="research-search-form">
                        <div class="search-input-wrapper">
                            <input type="text" name="search" id="newsletter-search-input" class="form-control search-input" placeholder="Search newsletters..." value="{{ request('search') }}">
                            <button class="btn search-btn" type="submit">
                                <i class="fa fa-search"></i> Search
                            </button>
                        </div>
                        @if(request('search'))
                            <div class="mt-4 text-center">
                                <div class="search-info">
                                    <span>Found {{ $newsletters->total() }} results for: <strong>"{{ request('search') }}"</strong></span>
                                    <a href="{{ route('newsletters') }}" class="clear-search">Clear Search <i class="fa fa-times-circle"></i></a>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            @php
                $grouped = $newsletters->groupBy('year');
            @endphp

            @forelse($grouped as $year => $items)
                <div class="year-group">
                    <h2 class="newsletter-year-heading">{{ $year }} Newsletters</h2>

                    @foreach($items as $newsletter)
                        <div class="newsletter-card">
                            <!-- Left: Text Content -->
                            <div class="newsletter-card__content">
                                <h3 class="newsletter-card__title">{{ $newsletter->title }}</h3>
                                @if($newsletter->file)
                                    <a href="{{ asset($newsletter->file) }}" target="_blank" rel="noopener noreferrer" class="newsletter-card__link">
                                        View &amp; Download &gt;&gt;
                                    </a>
                                @endif
                            </div>

                            <!-- Right: Image / Doc Placeholder -->
                            <div class="newsletter-card__image">
                                @if($newsletter->image)
                                    <img src="{{ asset($newsletter->image) }}" alt="{{ $newsletter->title }}">
                                @else
                                    <div class="doc-placeholder">
                                        <div class="doc-lines">
                                            <div class="doc-line"></div>
                                            <div class="doc-line"></div>
                                            <div class="doc-line"></div>
                                            <div class="doc-line short"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="text-center py-5">
                    <p class="text-muted">No newsletters found.</p>
                </div>
            @endforelse

            @if($newsletters->hasPages())
                <div class="pagination-wrapper">
                    {{ $newsletters->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </section>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#newsletter-search-input').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $(".newsletter-card").filter(function() {
                var isVisible = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(isVisible);
            });
            
            // Handle year headings - hide if no newsletters are visible in that year group
            $('.year-group').each(function() {
                var hasVisible = $(this).find('.newsletter-card:visible').length > 0;
                $(this).toggle(hasVisible);
            });
        });
    });
</script>
@endpush
@endsection

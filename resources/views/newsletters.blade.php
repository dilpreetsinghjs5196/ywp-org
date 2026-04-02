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
    </style>

    <section class="newsletters-page" style="padding: 80px 0 120px;">
        <div class="container">
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
        </div>
    </section>

@endsection

@extends('layouts.app')

@push('styles')
<style>
    :root {
        --primary-orange: #ff7e3b;
        --secondary-orange: #ff9d6c;
        --accent-dark: #0f172a;
    }

    /* Swiper custom styles */
    .campaign-swiper {
        width: 100%;
        padding-bottom: 50px !important;
        margin-bottom: 40px;
    }

    .campaign-swiper .swiper-slide {
        height: 350px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }

    .campaign-swiper .swiper-slide:hover {
        transform: translateY(-10px);
    }

    .campaign-swiper .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .swiper-button-next, .swiper-button-prev {
        color: var(--primary-orange) !important;
        background: #fff;
        width: 45px !important;
        height: 45px !important;
        border-radius: 50%;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 18px !important;
    }

    .page-header {
        position: relative;
        padding: 120px 0 100px;
        background-color: var(--accent-dark);
        overflow: hidden;
    }

    .page-header-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.3;
        background-size: cover;
        background-position: center;
        filter: grayscale(100%);
    }

    .page-header__inner h2 {
        font-size: 64px;
        font-weight: 800;
        color: #fff;
        margin-top: 10px;
        letter-spacing: -2px;
    }

    .thm-breadcrumb li, .thm-breadcrumb li a, .thm-breadcrumb li span {
        color: rgba(255, 255, 255, 0.7);
        font-weight: 500;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 1px;
    }

    .campaign-card {
        padding: 40px 0;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.5s ease;
    }

    .campaign-card:last-child {
        border-bottom: none;
    }

    .campaign-image-wrapper {
        position: relative;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 40px 80px rgba(0, 0, 0, 0.1);
        transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .campaign-card:hover .campaign-image-wrapper {
        transform: scale(1.02);
        box-shadow: 0 50px 100px rgba(0, 0, 0, 0.15);
    }

    .campaign-content {
        padding: 0;
    }

    .category-tag {
        display: inline-block;
        padding: 6px 18px;
        background: rgba(255, 126, 59, 0.1);
        color: var(--primary-orange);
        border-radius: 100px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .campaign-title {
        font-size: 48px;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 25px;
        color: var(--accent-dark);
        letter-spacing: -1px;
    }

    .campaign-description {
        font-size: 19px;
        line-height: 1.8;
        color: #64748b;
        margin-bottom: 35px;
    }

    .btn-explore {
        background: var(--accent-dark);
        color: #fff;
        padding: 18px 40px;
        border-radius: 15px;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 12px;
    }

    .btn-explore:hover {
        background: var(--primary-orange);
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(255, 126, 59, 0.3);
    }

    @media (max-width: 1200px) {
        .campaign-content { padding-left: 0; margin-top: 50px; }
        .campaign-title { font-size: 36px; }
        .page-header__inner h2 { font-size: 48px; }
    }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('assets/images/backgrounds/page-header-bg.jpg') }});"></div>
    <div class="container">
        <div class="page-header__inner">
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><span>/</span></li>
                <li>Initiatives</li>
            </ul>
            <h2>Transforming Lives <br><span style="color: var(--primary-orange)">One Campaign</span> at a Time</h2>
        </div>
    </div>
</section>

<!-- Include Swiper CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendors/swiper/swiper.min.css') }}">

<section class="campaigns-page">
    <div class="container">
        @foreach($campaigns as $camp)
            <div class="campaign-card" id="{{ Str::slug($camp->title) }}">
                <div class="mb-5">
                    <span class="category-tag">{{ $camp->category ?? 'Global Initiative' }}</span>
                    <h2 class="campaign-title">{{ $camp->title }}</h2>
                </div>

                <!-- Images Gallery / Slider -->
                <div class="swiper-container campaign-swiper">
                    <div class="swiper-wrapper">
                        @php 
                            $galleryImages = collect();
                            // First, add the thumbnail if it exists
                            if($camp->image) {
                                $galleryImages->push((object)['image_path' => $camp->image]);
                            }
                            // Then add all gallery photos
                            foreach($camp->images as $img) {
                                $galleryImages->push($img);
                            }
                            // Fallback to placeholder if nothing exists
                            if($galleryImages->isEmpty()) {
                                $galleryImages->push((object)['image_path' => 'images/campaigns-placeholder.jpg']);
                            }
                        @endphp
                        
                        @foreach($galleryImages as $img)
                            <div class="swiper-slide">
                                <img src="{{ asset($img->image_path) }}" alt="{{ $camp->title }}">
                            </div>
                        @endforeach
                    </div>
                    
                    @if($galleryImages->count() > 3)
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    @endif
                </div>

                <div class="campaign-content p-0">
                    <div class="campaign-description">
                        {!! nl2br(e($camp->description)) !!}
                    </div>
                </div>
            </div>
        @endforeach

        @if($campaigns->isEmpty())
            <div class="py-5 text-center">
                <i class="fa fa-bullhorn fa-4x mb-4 text-muted"></i>
                <h3>Our campaigns are launching soon!</h3>
                <p>Stay tuned for impactful work in mental health awareness.</p>
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script src="{{ asset('assets/vendors/swiper/swiper.min.js') }}"></script>
<script>
    // Initialize Swiper for each campaign
    document.querySelectorAll('.campaign-swiper').forEach(el => {
        const slidesCount = el.querySelectorAll('.swiper-slide').length;
        
        new Swiper(el, {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: slidesCount > 3,
            pagination: {
                el: el.querySelector('.swiper-pagination'),
                clickable: true,
            },
            navigation: {
                nextEl: el.querySelector('.swiper-button-next'),
                prevEl: el.querySelector('.swiper-button-prev'),
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: Math.min(3, slidesCount),
                },
            }
        });
    });

    // Intersection Observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.campaign-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all-duration: 0.8s; transition-timing-function: cubic-bezier(0.23, 1, 0.32, 1)';
        card.style.transition = 'opacity 0.8s, transform 0.8s cubic-bezier(0.23, 1, 0.32, 1)';
        observer.observe(card);
    });
</script>
@endpush
@endsection

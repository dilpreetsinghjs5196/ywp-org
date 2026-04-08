@extends('layouts.app')

@section('title', $post->title . ' | Blog | You’re Wonderful Project')

@push('styles')
<style>
    .blog-single-title { font-weight: 800; font-size: 2.5rem; margin-bottom: 20px; line-height: 1.2; }
    .blog-single-meta ul { padding: 0; list-style: none; display: flex; gap: 20px; color: #777; font-size: 14px; margin-bottom: 30px; }
    .blog-single-meta ul li i { color: #ff4c1e; margin-right: 5px; }
    .blog-single-content { font-size: 1.1rem; line-height: 1.8; color: #444; }
    .blog-single-content h2, .blog-single-content h3 { font-weight: 700; margin-top: 30px; margin-bottom: 15px; }
    .blog-single-content img { border-radius: 15px; margin: 20px 0; max-width: 100%; height: auto; }
</style>
@endpush

@section('content')
<!--Header-->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/header-img100.jpg') }})"></div>
    <div class="container">
        <div class="page-header__inner text-center">
            <span class="badge bg-primary px-3 py-2 mb-3" style="border-radius: 20px;">{{ $post->category->name }}</span>
            <h1 class="text-white" style="font-weight: 700;">{{ $post->title }}</h1>
            <ul class="thm-breadcrumb list-unstyled justify-content-center">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><span>/</span></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li><span>/</span></li>
                <li class="active">Post Details</li>
            </ul>
        </div>
    </div>
</section>

<section class="blog-details py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-single-post">
                    @if($post->photo)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $post->photo) }}" class="img-fluid" alt="{{ $post->title }}" style="width:100%; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                        </div>
                    @endif
                    
                    <div class="blog-single-meta">
                        <ul>
                            <li><i class="far fa-user"></i> {{ $post->author }}</li>
                            <li><i class="far fa-calendar"></i> {{ $post->published_at->format('M d, Y') }}</li>
                            <li><i class="far fa-eye"></i> {{ $post->views }} Views</li>
                            @if($post->tags)
                                <li><i class="fas fa-tags"></i> {{ $post->tags }}</li>
                            @endif
                        </ul>
                    </div>

                    <div class="blog-single-content mb-5">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    @if($post->images->count() > 0)
                        <div class="blog-gallery mt-5 pt-4 border-top">
                            <h4 class="mb-4" style="font-weight: 700;">Post Gallery</h4>
                            <div class="row g-4">
                                @foreach($post->images as $image)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="gallery-item-box">
                                            <a href="{{ asset('storage/' . $image->image) }}" class="img-popup">
                                                <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid rounded" style="width:100%; height:200px; object-fit: cover;" alt="Gallery Image">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="py-4 border-top border-bottom mb-5 d-flex justify-content-between align-items-center">
                        <div class="share-links">
                            <span class="fw-bold me-3 text-uppercase small">Share This:</span>
                            <a href="#" class="me-3 text-primary"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="me-3 text-info"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="me-3 text-danger"><i class="fab fa-pinterest"></i></a>
                            <a href="#" class="text-primary"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="col-lg-4 ps-lg-5">
                <div class="side-bar-widget mb-5">
                    <h4 style="font-weight: 700; margin-bottom: 25px; position: relative;">Categories</h4>
                    <ul class="list-group list-group-flush">
                        @foreach($categories as $category)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-bottom">
                                <a href="{{ route('blog.category', $category->slug) }}" class="text-dark text-decoration-none hover-primary">{{ $category->name }}</a>
                                <span class="badge bg-light text-dark rounded-pill">{{ $category->posts_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="side-bar-widget">
                    <h4 style="font-weight: 700; margin-bottom: 25px; position: relative;">Editor's Choice</h4>
                    @foreach($editorsChoice as $choice)
                        <div class="d-flex mb-4 gap-3 align-items-center">
                            <a href="{{ route('blog.show', $choice->slug) }}" class="flex-shrink-0">
                                <img src="{{ $choice->photo ? asset('storage/' . $choice->photo) : asset('assets/images/resources/events-img-1.jpg') }}" class="rounded" style="width: 80px; height: 60px; object-fit: cover;" alt="">
                            </a>
                            <div>
                                <h6 style="font-size: 0.9rem; font-weight: 600; line-height: 1.4; margin: 0;">
                                    <a href="{{ route('blog.show', $choice->slug) }}" class="text-dark text-decoration-none">{{ $choice->title }}</a>
                                </h6>
                                <span class="small text-muted">{{ $choice->published_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', 'Category: ' . $category->name . ' | Blog | You’re Wonderful Project')

@section('content')
<!--Page Header Start-->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/header-img100.jpg') }})"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Category: {{ $category->name }}</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><span>/</span></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li><span>/</span></li>
                <li class="active">{{ $category->name }}</li>
            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->

<section class="main-content-w3layouts-agileits py-5">
    <div class="container">
        <div class="row">
            <!--left col-->
            <div class="col-lg-8 left-blog-info-w3layouts-agileits text-left">
                <div class="row">
                    @forelse($posts as $post)
                        <div class="col-md-6 mb-5">
                            <div class="blog-grid-top">
                                <div class="b-grid-top">
                                    <div class="blog_info_left_grid mb-3">
                                        <a href="{{ route('blog.show', $post->slug) }}">
                                            <img src="{{ $post->photo ? asset('storage/' . $post->photo) : asset('assets/images/resources/blog-1-1.jpg') }}" class="img-fluid" alt="" style="width:100%; height:250px; object-fit: cover; border-radius: 12px;">
                                        </a>
                                    </div>
                                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 15px;">
                                        <a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none">{{ $post->title }}</a>
                                    </h3>
                                </div>
                                <ul class="list-unstyled d-flex gap-3 text-muted small mb-3">
                                    <li><i class="far fa-clock text-primary"></i> {{ $post->published_at->format('M d, Y') }}</li>
                                    <li><i class="far fa-user text-primary"></i> {{ $post->author }}</li>
                                </ul>
                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary read-m text-white" style="background: #ff4c1e; border: none; border-radius: 25px; padding: 8px 25px; font-weight: 600;">Read More</a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 py-5 text-center">
                            <i class="fa fa-info-circle fa-3x text-muted mb-3"></i>
                            <h4>No blog posts found in this category.</h4>
                            <p class="text-muted">Check back later for new content!</p>
                            <a href="{{ route('blog.index') }}" class="btn btn-primary px-5 mt-3" style="border-radius: 25px;">Back to Blog</a>
                        </div>
                    @endforelse
                </div>
                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>

            <!--right sidebar-->
            <aside class="col-lg-4 agileits-w3ls-right-blog-con text-right px-lg-4">
                <div class="side-bar-widget mb-5 text-start">
                    <h4 style="font-weight: 700; margin-bottom: 25px; position: relative;">Categories</h4>
                    <ul class="list-group category-list">
                        @foreach($categories as $cat)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-bottom border-0">
                                <a href="{{ route('blog.category', $cat->slug) }}" class="text-dark text-decoration-none {{ $cat->id == $category->id ? 'fw-bold text-primary' : '' }}">{{ $cat->name }}</a>
                                <span class="badge bg-primary rounded-pill">{{ $cat->posts_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', 'Blog | You’re Wonderful Project')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/jquery.desoslide.css') }}">
<style>
    .blog-item img { border-radius: 12px; }
    .blog-info-middle ul li { display: inline-block; margin-right: 15px; font-size: 13px; color: #777; }
    .blog-info-middle ul li i { color: #ff4c1e; margin-right: 5px; }
    .read-m { background: #ff4c1e; border: none; border-radius: 25px; padding: 8px 25px; font-weight: 600; }
    .read-m:hover { background: #333; color: #fff; }
    .side-bar-widget h4 { font-weight: 700; margin-bottom: 20px; position: relative; padding-bottom: 10px; }
    .side-bar-widget h4::after { content: ''; position: absolute; left: 0; bottom: 0; width: 40px; height: 3px; background: #ff4c1e; }
    .category-list li { border: none; padding: 10px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; }
    .category-list li a { color: #333; text-decoration: none; }
    .category-list li a:hover { color: #ff4c1e; }
</style>
@endpush

@section('content')
<!--Page Header Start-->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset('images/header-img100.jpg') }})"></div>
    <div class="container">
        <div class="page-header__inner">
            <h2>Blog</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><span>/</span></li>
                <li class="active">Blog</li>
            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->

<!-- Latest Posts Slider -->
<section class="py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row">
            @foreach($latestPosts as $post)
            <div class="col-md-4 mb-4">
                <div class="blog-item card border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
                    <a href="{{ route('blog.show', $post->slug) }}">
                        <img src="{{ $post->photo ? asset('storage/' . $post->photo) : asset('assets/images/resources/events-img-1.jpg') }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                    </a>
                    <div class="card-body p-4">
                        <span class="text-uppercase small text-muted" style="letter-spacing: 1px; color: #ff4c1e !important; font-weight: 700;">{{ $post->category->name }}</span>
                        <h4 class="mt-2" style="font-weight: 700; font-size: 1.2rem;">
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none">{{ $post->title }}</a>
                        </h4>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="small text-muted"><i class="far fa-user me-1 text-primary"></i> {{ $post->author }}</span>
                            <span class="small text-muted"><i class="far fa-calendar me-1 text-primary"></i> {{ $post->published_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="main-content-w3layouts-agileits py-5">
    <div class="container">
        <div class="row">
            <!--left-->
            <div class="col-lg-8 left-blog-info-w3layouts-agileits text-left">
                <div class="row">
                    @forelse($gridPosts as $post)
                        <div class="col-md-6 mb-5">
                            <div class="blog-grid-top">
                                <div class="b-grid-top">
                                    <div class="blog_info_left_grid mb-3">
                                        <a href="{{ route('blog.show', $post->slug) }}">
                                            <img src="{{ $post->photo ? asset('storage/' . $post->photo) : asset('assets/images/resources/events-img-1.jpg') }}" class="img-fluid" alt="" style="width:100%; height:250px; object-fit: cover; border-radius: 12px;">
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
                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary read-m text-white">Read More</a>
                            </div>
                        </div>
                    @empty
                        <p>No blog posts found.</p>
                    @endforelse
                </div>
                <div class="mt-4">
                    {{ $gridPosts->links() }}
                </div>
            </div>

            <!--right sidebar-->
            <aside class="col-lg-4 agileits-w3ls-right-blog-con text-right">
                <div class="right-blog-info text-left px-lg-4">
                    <div class="side-bar-widget mb-5">
                        <h4>Categories</h4>
                        <ul class="list-group category-list">
                            @foreach($categories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('blog.category', $category->slug) }}">{{ $category->name }}</a>
                                    <span class="badge bg-primary rounded-pill">{{ $category->posts_count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="side-bar-widget mb-5">
                        <h4>Editor's Choice</h4>
                        @foreach($editorsChoice as $choice)
                        <div class="blog-grids row mb-4 align-items-center">
                            <div class="col-4">
                                <a href="{{ route('blog.show', $choice->slug) }}">
                                    <img src="{{ $choice->photo ? asset('storage/' . $choice->photo) : asset('assets/images/resources/events-img-1.jpg') }}" class="img-fluid rounded" alt="">
                                </a>
                            </div>
                            <div class="col-8">
                                <h5 style="font-size: 0.95rem; font-weight: 600; line-height: 1.4;">
                                    <a href="{{ route('blog.show', $choice->slug) }}" class="text-dark text-decoration-none">{{ $choice->title }}</a>
                                </h5>
                                <div class="small text-muted mt-1">
                                    <i class="far fa-clock"></i> {{ $choice->published_at->format('M d, Y') }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="side-bar-widget mb-5">
                        <h4>Older Posts</h4>
                        @foreach($olderPosts as $op)
                        <div class="blog-grids row mb-4 align-items-center">
                            <div class="col-4">
                                <a href="{{ route('blog.show', $op->slug) }}">
                                    <img src="{{ $op->photo ? asset('storage/' . $op->photo) : asset('assets/images/resources/events-img-1.jpg') }}" class="img-fluid rounded" alt="">
                                </a>
                            </div>
                            <div class="col-8">
                                <h5 style="font-size: 0.95rem; font-weight: 600;">
                                    <a href="{{ route('blog.show', $op->slug) }}" class="text-dark text-decoration-none">{{ $op->title }}</a>
                                </h5>
                                <div class="small text-muted mt-1">
                                    <i class="far fa-clock"></i> {{ $op->published_at->format('M d, Y') }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.flexisel.js') }}"></script>
@endpush

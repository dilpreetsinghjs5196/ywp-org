@extends('layouts.app')

@section('content')
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<!--Page Header Start-->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset($contents['header']['bg_image'] ?? 'images/gallery/gal-head.jpg') }})">
    </div>
    <div class="container">
        <div class="page-header__inner">
            <h2>{{ $contents['header']['title'] ?? 'Gallery' }}</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><span>/</span></li>
                <li class="active">{{ $contents['header']['title'] ?? 'Gallery' }}</li>
            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--Gallery Page Start-->
<section class="gallery-page mb-5">
    <div class="container">
        <div class="row align-items-stretch">
            @foreach($images as $img)
            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                @php
                    $imgPath = $img->image;
                    // Handle legacy paths
                    if ($imgPath && !str_starts_with($imgPath, 'uploads/')) {
                        $imgPath = 'images/gallery/' . $imgPath;
                    }
                @endphp
                <a href="{{ asset($imgPath) }}" class="gallery-link" data-lightbox="gallery">
                    <div class="two-section__gallery-single h-100">
                        <div class="two-section__gallery-img-inner shadow-sm" style="border-radius: 15px; overflow: hidden; border: 1px solid rgba(0,0,0,0.05);">
                            <img src="{{ asset($imgPath) }}" alt="{{ $img->title }}" style="width: 100%; height: 300px; object-fit: cover;">
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--Gallery Page End-->

@push('scripts')
<!-- Magnific Popup JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script>
$(document).ready(function() {
    $('.gallery-link').magnificPopup({
        type: 'image',
        gallery:{
            enabled: true
        }
    });
});
</script>
@endpush
@endsection

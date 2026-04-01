@extends('layouts.app')

@section('content')
<style>
    .volunteers-one__single {
        position: relative;
        display: block;
        margin-bottom: 30px;
        border: 2px solid black;
        border-radius: 13px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 5px;
        background-color: #fedd59;
        transition: all 0.3s ease;
    }
    .volunteers-one__single:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    #imgtag {
        padding: 5px 10px;
        width: 100%;
        border-radius: 20px;
        height: 400px;
        object-fit: cover;
    }
    .volunteers-one__content {
        padding: 20px;
        text-align: center;
    }
    .volunteers-one__name {
        font-weight: 700;
        margin-bottom: 2px;
        color: #000;
        font-size: 22px;
    }
    .volunteers-one__title {
        font-size: 14px;
        color: #555;
        margin-bottom: 8px;
        font-weight: 500;
    }
    .volunteers-one__desc {
        font-size: 14px;
        line-height: 1.5;
        color: #666;
    }
</style>

<!--Page Header Start-->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{ asset($contents['header']['bg_image'] ?? 'images/advisery.jpg') }})">
    </div>
    <div class="container">
        <div class="page-header__inner">
            <h2>{{ $contents['header']['title'] ?? 'On-Board Professionals' }}</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><span>/</span></li>
                <li class="active">{{ $contents['header']['title'] ?? 'On-Board Professionals' }}</li>
            </ul>
        </div>
    </div>
</section>

<!--Volunteers Page Start-->
<section class="volunteers-page pb-5">
    <div class="container pb-5">
        <br/><br/>
        <div class="row">
            @foreach($professionals as $pro)
            <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                <div class="volunteers-one__single" style="pointer-events: none;">
                    <div class="volunteers-one__img">
                        @php
                            $photoPath = $pro->photo;
                            // Handle legacy paths if photo doesn't look like a Laravel upload path
                            if ($photoPath && !str_starts_with($photoPath, 'uploads/')) {
                                $photoPath = 'blogadmin/professionnals/images/' . $photoPath;
                            }
                        @endphp
                        <img src="{{ asset($photoPath ?? 'images/loader.png') }}" alt="{{ $pro->user_name }}" id="imgtag">
                    </div>
                    <div class="volunteers-one__content">
                        <h4 class="volunteers-one__name">{{ $pro->user_name }}</h4>
                        <h5 class="volunteers-one__title fw-bold" style="font-size: 16px;">{{ $pro->qualification }}</h5>
                        <p class="volunteers-one__desc">{{ $pro->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('content')
    <!--Header Start-->
    <section class="page-header">
        <div class="page-header-bg"
            style="background-image: url({{ asset($contents['header']['bg_image'] ?? 'images/fundraishing-bg.jpg') }})">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>{{ $contents['header']['title'] ?? 'FAQs' }}</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><span>/</span></li>
                    <li class="active">{{ $contents['header']['title'] ?? 'FAQs' }}</li>
                </ul>
            </div>
        </div>
    </section>

    <!--FAQs Page Start (General)-->
    <section class="paq-page">
        <div class="container">
            @php
                $getFaqs = function ($section, $prefix) use ($contents) {
                    $faqs = [];
                    if (isset($contents[$section])) {
                        foreach ($contents[$section] as $key => $value) {
                            if (str_starts_with($key, $prefix) && str_ends_with($key, '_question')) {
                                $index = (int) str_replace([$prefix, '_question'], '', $key);
                                $faqs[$index] = [
                                    'question' => $value,
                                    'answer' => $contents[$section]["{$prefix}{$index}_answer"] ?? ''
                                ];
                            }
                        }
                    }
                    ksort($faqs);
                    return array_values($faqs);
                };

                $alternatingSplit = function ($faqs) {
                    $col1 = [];
                    $col2 = [];
                    foreach ($faqs as $i => $faq) {
                        if ($i % 2 == 0)
                            $col1[] = $faq;
                        else
                            $col2[] = $faq;
                    }
                    return [$col1, $col2];
                };

                $allGeneralFaqs = $getFaqs('faq', 'faq');
                [$genCol1, $genCol2] = $alternatingSplit($allGeneralFaqs);
            @endphp

            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="faq-page__single">
                        <div class="accrodion-grp faq-one-accrodion" data-grp-name="faq-one-accrodion-1">
                            @foreach($genCol1 as $i => $faq)
                                <div class="accrodion @if($loop->first) active @endif">
                                    <div class="accrodion-title">
                                        <h4>{{ $faq['question'] }}</h4>
                                    </div>
                                    <div class="accrodion-content">
                                        <div class="inner">
                                            <p>{!! nl2br(e($faq['answer'])) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="faq-page__single">
                        <div class="accrodion-grp faq-one-accrodion" data-grp-name="faq-one-accrodion-2">
                            @foreach($genCol2 as $i => $faq)
                                <div class="accrodion @if($loop->first) active @endif">
                                    <div class="accrodion-title">
                                        <h4>{{ $faq['question'] }}</h4>
                                    </div>
                                    <div class="accrodion-content">
                                        <div class="inner">
                                            <p>{!! nl2br(e($faq['answer'])) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--References Section (2nd Section)-->
    <section class="message-one" style="background-color: #f7f7f7; padding: 90px 0 100px;">
        <div class="container">
            <div class="section-title">
                <div class="section-title text-center">
                    <h2 class="section-title__title">{{ $contents['references']['title'] ?? 'References' }}</h2>
                </div>
                @php
                    $references = [];
                    if (isset($contents['references'])) {
                        foreach ($contents['references'] as $key => $val) {
                            if (str_starts_with($key, 'ref')) {
                                $index = (int) str_replace('ref', '', $key);
                                $references[$index] = $val;
                            }
                        }
                    }
                    ksort($references);
                @endphp
                <ol>
                    @foreach($references as $ref)
                        <li>{!! preg_replace('!(https?://[a-zA-Z0-9./?=&_-]+)!', '<a href="$1" style="color:blue;">$1</a>', e($ref)) !!}
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </section>

    <!--Help Team Section-->
    <section class="paq-page">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="section-title__title">{{ $contents['help_team']['title'] ?? 'FAQs about the Help Team' }}</h2>
            </div>
            <p class="text-center">{!! nl2br(e($contents['help_team']['description'] ?? '')) !!}</p>
            <br />

            @php
                $helpTeamFaqs = $getFaqs('help_team', 'faq');
                [$htCol1, $htCol2] = $alternatingSplit($helpTeamFaqs);
            @endphp

            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="faq-page__single">
                        <div class="accrodion-grp faq-one-accrodion" data-grp-name="help-team-1">
                            @foreach($htCol1 as $i => $faq)
                                <div class="accrodion @if($loop->iteration == 2) active @endif">
                                    <div class="accrodion-title">
                                        <h4>{{ $faq['question'] }}</h4>
                                    </div>
                                    <div class="accrodion-content">
                                        <div class="inner">
                                            <p>{!! nl2br(e($faq['answer'])) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="faq-page__single">
                        <div class="accrodion-grp faq-one-accrodion" data-grp-name="help-team-2">
                            @foreach($htCol2 as $i => $faq)
                                <div class="accrodion @if($loop->iteration == 2) active @endif">
                                    <div class="accrodion-title">
                                        <h4>{{ $faq['question'] }}</h4>
                                    </div>
                                    <div class="accrodion-content">
                                        <div class="inner">
                                            <p>{!! nl2br(e($faq['answer'])) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br />

    <!--Additional Questions-->
    <div class="section-title text-center">
        <h2 class="section-title__title">{{ $contents['additional']['title'] ?? 'ADDITIONAL QUESTIONS' }}</h2>
    </div>

    <section class="paq-page">
        <div class="container">
            <br />
            @php
                $additionalFaqs = $getFaqs('additional', 'faq');
                [$addCol1, $addCol2] = $alternatingSplit($additionalFaqs);
            @endphp

            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="faq-page__single">
                        <div class="accrodion-grp faq-one-accrodion" data-grp-name="additional-1">
                            @foreach($addCol1 as $i => $faq)
                                <div class="accrodion @if($loop->iteration == 2) active @endif">
                                    <div class="accrodion-title">
                                        <h4>{{ $faq['question'] }}</h4>
                                    </div>
                                    <div class="accrodion-content">
                                        <div class="inner">
                                            <p>{!! nl2br(e($faq['answer'])) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="faq-page__single">
                        <div class="accrodion-grp faq-one-accrodion" data-grp-name="additional-2">
                            @foreach($addCol2 as $i => $faq)
                                <div class="accrodion @if($loop->first) active @endif">
                                    <div class="accrodion-title">
                                        <h4>{{ $faq['question'] }}</h4>
                                    </div>
                                    <div class="accrodion-content">
                                        <div class="inner">
                                            <p>{!! nl2br(e($faq['answer'])) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Blog Ideas Section (White BG)-->
    <section class="donations-details" style="padding: 120px 0 60px;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="donation-details__left">
                        <div class="donation-details__content">
                            <h3 class="donation-details__title">
                                {{ $contents['rd_blogs']['title'] ?? 'R&D Exploration Blog Ideas' }}</h3>
                            <ul class="list-unstyled donation-details__points">
                                @php
                                    $blogIdeas = [];
                                    if (isset($contents['rd_blogs'])) {
                                        foreach ($contents['rd_blogs'] as $key => $val) {
                                            if (str_starts_with($key, 'idea')) {
                                                $index = (int) str_replace('idea', '', $key);
                                                $blogIdeas[$index] = $val;
                                            }
                                        }
                                    }
                                    ksort($blogIdeas);
                                @endphp
                                @foreach($blogIdeas as $idea)
                                    <li>
                                        <div class="icon">
                                            <span class="icon-confirmation"></span>
                                        </div>
                                        <div class="text">
                                            <p>{{ $idea }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Further Topics Section (Grey BG)-->
    <section class="donations-details paq-page" style="padding: 60px 0 120px;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="donation-details__left">
                        <div class="donation-details__content">
                            <h3 class="donation-details__title">
                                {{ $contents['further_topics']['title'] ?? 'Further topics for exploration (Pitch in ideas)' }}
                            </h3>
                            <ul class="list-unstyled donation-details__points">
                                @php
                                    $topics = [];
                                    if (isset($contents['further_topics'])) {
                                        foreach ($contents['further_topics'] as $key => $val) {
                                            if (str_starts_with($key, 'topic')) {
                                                $index = (int) str_replace('topic', '', $key);
                                                $topics[$index] = $val;
                                            }
                                        }
                                    }
                                    ksort($topics);
                                @endphp
                                @foreach($topics as $topic)
                                    <li>
                                        <div class="icon">
                                            <span class="icon-confirmation"></span>
                                        </div>
                                        <div class="text">
                                            <p>{{ $topic }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Contact Form-->
    <section class="message-one mb-5">
        <div class="container">
            <div class="section-title text-center">
                <span class="section-title__tagline">Contact with us</span>
                <h2 class="section-title__title">Still Have Question?</h2>
            </div>
            <div class="message-one__inner">
                <form action="#" class="comment-one__form contact-form-validated" novalidate="novalidate">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="comment-form__input-box">
                                <input type="text" placeholder="Your Name" name="name">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="comment-form__input-box">
                                <input type="email" placeholder="Email Address" name="email">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="comment-form__input-box">
                                <input type="text" placeholder="Phone Number" name="phone">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="comment-form__input-box">
                                <input type="text" placeholder="Subject" name="Subject">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="comment-form__input-box text-message-box">
                                <textarea name="message" placeholder="Write a Comment"></textarea>
                            </div>
                            <div class="message-one__btn-box">
                                <button type="submit" class="thm-btn comment-form__btn">Send us a message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
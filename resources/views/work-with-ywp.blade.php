@extends('layouts.app')

@section('title', $contents['header']['title'] ?? 'Work with YWP')

@section('content')
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header-bg" style="background-image: url({{ asset($contents['header']['bg_image'] ?? 'images/campaigns-1-5.jpg') }})">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>{{ $contents['header']['title'] ?? 'Work with YWP' }}</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><span>/</span></li>
                    <li class="active">{{ $contents['header']['title'] ?? 'Work with YWP' }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Become Volunteer Start-->
    <section class="become-volunteer">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="become-volunteer__Left">
                        <div class="become-volunteer__images">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="become-volunteer__img-single">
                                        <img src="{{ asset('images/slider-main-3.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="become-volunteer__img-single">
                                        <img src="{{ asset('images/welcome-one-small-img.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="become-volunteer__content">
                            <p class="contact-page__text">{{ $contents['recruitment_process']['intro'] ?? '' }}</p><br />
                            <p class="contact-page__text">{{ $contents['recruitment_process']['round_1'] ?? '' }}</p>
                            <p class="contact-page__text">{{ $contents['recruitment_process']['round_2'] ?? '' }}</p>
                            <p class="contact-page__text">{{ $contents['recruitment_process']['round_3'] ?? '' }}</p>
                            <p class="contact-page__text">{{ $contents['recruitment_process']['round_4'] ?? '' }}</p><br />
                            <p class="contact-page__text">{{ $contents['recruitment_process']['footer_note'] ?? '' }}</p>
                            <div class="contact-page__social">
                                @php
                                    $settings = \App\Models\Setting::first();
                                @endphp
                                @if($settings)
                                    <a href="{{ $settings->twitter_link }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                    <a href="{{ $settings->facebook_link }}" target="_blank"><i class="fab fa-facebook"></i></a>
                                    <a href="{{ $settings->instagram_link }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ $settings->linkedin_link }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                @endif
                            </div>
                            <div class="become-volunteer__contact">
                                <p>
                                    @if($settings)
                                        <a href="tel:{{ $settings->contact_phone }}" class="become-volunteer__phone">{{ $settings->contact_phone }}</a>
                                        <a href="mailto:{{ $settings->contact_email }}" class="become-volunteer__email">{{ $settings->contact_email }}</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="become-volunteer__right">
                        <div class="contact-page__left">
                            <div class="section-title text-left">
                                <span class="section-title__tagline">{{ $contents['form_content']['tagline'] ?? 'Work with us' }}</span>
                                <h2 class="section-title__title">{{ $contents['form_content']['title'] ?? 'Recruitment Form' }}</h2>
                            </div>
                            <p class="contact-page__text">{{ $contents['form_content']['description_1'] ?? '' }}</p>
                            <br />
                            <p class="contact-page__text">{{ $contents['form_content']['description_2'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Become Volunteer End-->

    <!--Contact Page Start-->
    <section class="">
        <div class="container">
            <div class="row" style="margin:auto !important;">
                <div class="col-xl-8 col-lg-7">
                    <div class="contact-page__right">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('work-with-ywp.store') }}" name="form" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="comment-form__input-box">
                                        <input type="text" placeholder="Your Name" name="name" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="comment-form__input-box">
                                        <input type="email" placeholder="Email Address" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="comment-form__input-box">
                                        <input type="text" placeholder="Age" name="age" value="{{ old('age') }}" required>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="comment-form__input-box">
                                        <input type="text" placeholder="Phone Number" name="phone" value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="comment-form__input-box">
                                        <h4>How did you hear about us? </h4>
                                        <input type="radio" name="hear" value="Instagram" {{ old('hear') == 'Instagram' ? 'checked' : '' }}> Instagram<br />
                                        <input type="radio" name="hear" value="Facebook" {{ old('hear') == 'Facebook' ? 'checked' : '' }}> Facebook<br />
                                        <input type="radio" name="hear" value="Twitter" {{ old('hear') == 'Twitter' ? 'checked' : '' }}> Twitter<br />
                                        <input type="radio" name="hear" value="Whatsapp" {{ old('hear') == 'Whatsapp' ? 'checked' : '' }}> Whatsapp<br />
                                        <input type="radio" name="hear" value="Word of Mouth" {{ old('hear') == 'Word of Mouth' ? 'checked' : '' }}> Word of Mouth<br />
                                        <input type="radio" name="hear" value="LinkedIn" {{ old('hear') == 'LinkedIn' ? 'checked' : '' }}> LinkedIn<br />
                                        <input type="radio" name="hear" value="Placement Cell" {{ old('hear') == 'Placement Cell' ? 'checked' : '' }}> Placement Cell<br />
                                        <input type="radio" name="hear" value="Internshala" {{ old('hear') == 'Internshala' ? 'checked' : '' }}> Internshala<br />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="comment-form__input-box">
                                        <h4>Departmental Preference 1</h4>
                                        <select name="Preference1" class="form-control" style="border: none; background: #f4f4f4; height: 60px; padding: 0 30px; border-radius: 10px; width: 100%;">
                                            <option value="">-choose-</option>
                                            <option value="Creative" {{ old('Preference1') == 'Creative' ? 'selected' : '' }}>Creative</option>
                                            <option value="Design" {{ old('Preference1') == 'Design' ? 'selected' : '' }}>Design</option>
                                            <option value="Events" {{ old('Preference1') == 'Events' ? 'selected' : '' }}>Events</option>
                                            <option value="Wonder Store (Merchandise team)" {{ old('Preference1') == 'Wonder Store (Merchandise team)' ? 'selected' : '' }}>Wonder Store (Merchandise team)</option>
                                            <option value="Photography/Videography" {{ old('Preference1') == 'Photography/Videography' ? 'selected' : '' }}>Photography/Videography</option>
                                            <option value="CSR and Grants" {{ old('Preference1') == 'CSR and Grants' ? 'selected' : '' }}>CSR and Grants</option>
                                            <option value="Research and Development" {{ old('Preference1') == 'Research and Development' ? 'selected' : '' }}>Research and Development</option>
                                            <option value="Peer Support Team" {{ old('Preference1') == 'Peer Support Team' ? 'selected' : '' }}>Peer Support Team</option>
                                            <option value="Human Resources" {{ old('Preference1') == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="comment-form__input-box">
                                        <h4>Departmental Preference 2</h4>
                                        <select name="Preference2" class="form-control" style="border: none; background: #f4f4f4; height: 60px; padding: 0 30px; border-radius: 10px; width: 100%;">
                                            <option value="">-choose-</option>
                                            <option value="Creative" {{ old('Preference2') == 'Creative' ? 'selected' : '' }}>Creative</option>
                                            <option value="Design" {{ old('Preference2') == 'Design' ? 'selected' : '' }}>Design</option>
                                            <option value="Events" {{ old('Preference2') == 'Events' ? 'selected' : '' }}>Events</option>
                                            <option value="Wonder Store (Merchandise team)" {{ old('Preference2') == 'Wonder Store (Merchandise team)' ? 'selected' : '' }}>Wonder Store (Merchandise team)</option>
                                            <option value="Photography/Videography" {{ old('Preference2') == 'Photography/Videography' ? 'selected' : '' }}>Photography/Videography</option>
                                            <option value="CSR and Grants" {{ old('Preference2') == 'CSR and Grants' ? 'selected' : '' }}>CSR and Grants</option>
                                            <option value="Research and Development" {{ old('Preference2') == 'Research and Development' ? 'selected' : '' }}>Research and Development</option>
                                            <option value="Peer Support Team" {{ old('Preference2') == 'Peer Support Team' ? 'selected' : '' }}>Peer Support Team</option>
                                            <option value="Human Resources" {{ old('Preference2') == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="comment-form__input-box">
                                        <h4>Departmental Preference 3</h4>
                                        <select name="Preference3" class="form-control" style="border: none; background: #f4f4f4; height: 60px; padding: 0 30px; border-radius: 10px; width: 100%;">
                                            <option value="">-choose-</option>
                                            <option value="Creative" {{ old('Preference3') == 'Creative' ? 'selected' : '' }}>Creative</option>
                                            <option value="Design" {{ old('Preference3') == 'Design' ? 'selected' : '' }}>Design</option>
                                            <option value="Events" {{ old('Preference3') == 'Events' ? 'selected' : '' }}>Events</option>
                                            <option value="Wonder Store (Merchandise team)" {{ old('Preference3') == 'Wonder Store (Merchandise team)' ? 'selected' : '' }}>Wonder Store (Merchandise team)</option>
                                            <option value="Photography/Videography" {{ old('Preference3') == 'Photography/Videography' ? 'selected' : '' }}>Photography/Videography</option>
                                            <option value="CSR and Grants" {{ old('Preference3') == 'CSR and Grants' ? 'selected' : '' }}>CSR and Grants</option>
                                            <option value="Research and Development" {{ old('Preference3') == 'Research and Development' ? 'selected' : '' }}>Research and Development</option>
                                            <option value="Peer Support Team" {{ old('Preference3') == 'Peer Support Team' ? 'selected' : '' }}>Peer Support Team</option>
                                            <option value="Human Resources" {{ old('Preference3') == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <p> In case none of the aforementioned departments interest you, please let us know what you wish to do as a part of YWP; *</p>
                                    <div class="comment-form__input-box text-message-box">
                                        <textarea name="ans1" placeholder="Your answer">{{ old('ans1') }}</textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <p> What motivates you to be a part of YWP;? * *</p>
                                    <div class="comment-form__input-box text-message-box">
                                        <textarea name="ans2" placeholder="Your answer">{{ old('ans2') }}</textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <p> What are your views on mental health awareness and accessibility in India? *</p>
                                    <div class="comment-form__input-box text-message-box">
                                        <textarea name="ans3" placeholder="Your answer">{{ old('ans3') }}</textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <p> Any other information that you'd like to provide</p>
                                    <p style="font-size:13px;">Feel free to drop in the links for your social media profile, your work etc. We'd love to know you better. In case you are applying for design/creative/photography & videography team, please treat this as a mandatory question and attach your work sample(s) here.</p>
                                    <div class="comment-form__input-box text-message-box">
                                        <textarea name="ans4" placeholder="Your answer">{{ old('ans4') }}</textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12">
                                    <p> Please tick the relevant box if you have been part of the Discover Bootcamp, Helping Hands, FAD, or the Connect Internship *</p>
                                    <input type="radio" name="checkbox1" value="I have" {{ old('checkbox1') == 'I have' ? 'checked' : '' }}> I have<br />
                                    <input type="radio" name="checkbox1" value="I haven't" {{ old('checkbox1') == "I haven't" ? 'checked' : '' }}> I haven't<br />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-xl-12">
                                    <p>Please tick the relevant box if you are a person with disability or a dalit, bahujan, adivasi, north-eastern or Kashmiri applicant or a person from a religious minority</p>
                                    <input type="radio" name="checkbox2" value="I am" {{ old('checkbox2') == 'I am' ? 'checked' : '' }}> I am<br />
                                    <input type="radio" name="checkbox2" value="I am not" {{ old('checkbox2') == 'I am not' ? 'checked' : '' }}> I am not<br /><br />

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <p> Please attach your updated CV *</p>
                                    <p style="font-size:13px;">PDF or Doc files only (Max 2MB)</p>
                                    <div>
                                        <input type="file" name="myfile" required>
                                    </div>
                                    <br />
                                    <div class="comment-form__btn-box">
                                        <button type="submit" class="thm-btn comment-form__btn" name="submit">Submit</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Contact Page End-->

    <br />
@endsection

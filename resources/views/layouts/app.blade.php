<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'YWP | You’re Wonderful Project:')</title>
    <style>
        .footer-donate__btn-dynamic {
            background-color: #ff4c1e !important;
            transition: all 0.3s ease !important;
        }

        .footer-donate__btn-dynamic:hover {
            background-color: #fff !important;
        }

        .footer-donate__btn-dynamic .support-text {
            color: #fff !important;
            transition: all 0.3s ease !important;
        }

        .footer-donate__btn-dynamic:hover .support-text {
            color: #1a1a1a !important;
        }

        .footer-donate__btn-dynamic .support-circle {
            background-color: #fff !important;
            transition: all 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .footer-donate__btn-dynamic:hover .support-circle {
            background-color: #ff4c1e !important;
        }

        .footer-donate__btn-dynamic .fa-heart {
            color: #ff4c1e !important;
            transition: all 0.3s ease !important;
            line-height: 1 !important;
            margin: 0 !important;
            font-size: 18px !important;
        }

        .footer-donate__btn-dynamic:hover .fa-heart {
            color: #fff !important;
        }
    </style>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/ymp-logo.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/ymp-logo.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/ymp-logo.png') }}" />
    <link rel="manifest" href="{{ asset('assets/images/favicons/site.webmanifest') }}" />
    <meta name="description" content="You’re Wonderful Project;" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&amp;display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;family=Fredoka+One&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/custom-animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/jarallax/jarallax.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/nouislider/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/nouislider/nouislider.pips.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/odometer/odometer.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/swiper/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/pifoxen-icons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/tiny-slider/tiny-slider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/reey-font/stylesheet.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/bxslider/jquery.bxslider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-select/css/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/vegas/vegas.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/timepicker/timePicker.css') }}" />

    <!-- template styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/pifoxen.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pifoxen-responsive.css') }}" />

    @stack('styles')
</head>

<body>
    <div class="preloader">
        <img class="preloader__image" width="60" src="{{ asset('assets/images/loader.png') }}" alt="" />
    </div>
    <!-- /.preloader -->
    <div class="page-wrapper">
        <header class="main-header clearfix">
            <div class="main-header__top">
                <div class="main-header__top-left">
                    <p class="main-header__top-text">Welcome to You’re Wonderful Project;</p>
                    <div class="main-header__top-social">
                        <a href="https://www.facebook.com/yourewonderfulproject" target="_blank"><i
                                class="fab fa-facebook"></i></a>
                        <a href="https://twitter.com/YWPIndia" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://m.youtube.com/c/YoureWonderfulProject" target="_blank"><i
                                class="fab fa-youtube"></i></a>
                        <a href="https://instagram.com/yourewonderfulproject?utm_medium=copy_link" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/ywpindia" target="_blank"><i
                                class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="main-header__top-right">
                    <ul class="list-unstyled main-header__top-address">
                        <li>
                            <div class="icon">
                                <span class="icon-pin"></span>
                            </div>
                            <div class="text">
                                <p>1, 22, Asaf Ali Rd, Kucha Pati Ram, Ajmeri Gate, New Delhi</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="icon-email"></span>
                            </div>
                            <div class="text">
                                <p><a href="mailto:info@yourewonderfulproject.org">info@yourewonderfulproject.org</a>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <nav class="main-menu clearfix">
                <div class="main-menu-wrapper clearfix">
                    <div class="main-menu-wrapper__left">
                        <div class="main-menu-wrapper__logo">
                            <a href="{{ url('/') }}"><img src="{{ asset('images/loader.png') }}" alt="" height="100px"
                                    width="59px"></a>
                        </div>
                        <div class="main-menu-wrapper__call">
                            <div class="main-menu-wrapper__call-icon">
                                <span class="icon-call"></span>
                            </div>
                            <div class="main-menu-wrapper__call-number">
                                <p>Call Anytime</p>
                                <h5><a href="tel:13073330079">+ 1 (307) 333-0079</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="main-menu-wrapper__main-menu">
                        <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                        <ul class="main-menu__list">
                            <li class="dropdown current">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="dropdown">
                                <a href="#">About</a>
                                <ul>
                                    <li><a href="{{ url('our-mission') }}">Our Mission</a></li>
                                    <li><a href="{{ url('history') }}">History</a></li>
                                    <li><a href="{{ url('advisory-board') }}">Advisory Board</a></li>
                                    <li><a href="{{ url('on-board-professionals') }}">On-Board Professionals</a></li>
                                    <li><a href="{{ url('gallery') }}">Gallery</a></li>
                                    <li><a href="{{ url('faq') }}">FAQs</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#">Documents</a>
                                <ul>
                                    <li><a href="{{ route('research-papers') }}">Research Papers</a></li>
                                    <li><a href="{{ route('policies') }}">Policies</a></li>
                                    <li><a href="{{ url('report') }}">Reports</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="{{ url('team') }}">Team</a>
                            </li>
                            <li class="dropdown">
                                <a href="#">Initiatives</a>
                                <ul>
                                    <li><a href="{{ url('campaigns') }}">Campaigns</a></li>
                                    <li><a href="{{ url('events') }}">Events</a></li>
                                    <li><a href="{{ url('training') }}">Trainings</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="{{ url('blog') }}">Blog</a>
                            </li>
                            <li class="dropdown"><a href="#">Connect</a>
                                <ul>
                                    <li><a href="{{ url('work-with-ywp') }}">Work with YWP</a></li>
                                    <li><a href="{{ url('contact') }}">Contact Us</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#">Donate</a>
                                <ul>
                                    <li><a href="https://pages.razorpay.com/contributetoywp/" target="_blank">One-time
                                            Donation</a></li>
                                    <li><a href="https://yourewonderfulproject.org/pledge" target="_blank">Pledge for
                                            YWP</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="{{ url('wonderstore') }}">Wonder Store</a>
                            </li>
                        </ul>
                    </div>
                    <div class="main-menu-wrapper__right">
                        <div class="main-menu-wrapper__search-cat">
                        </div>
                        <a href="https://pledge.yourewonderfulproject.org/" class="donate-btn main-menu-wrapper__btn"
                            target="_blank"> <i class="fa fa-heart"></i>
                            Donate Now</a>
                    </div>
                </div>
            </nav>
        </header>

        <div class="stricky-header stricked-menu main-menu">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->

        @yield('content')

        <!--Site Footer Start-->
        <footer class="site-footer">
            <div class="site-footer-bg"
                style="background-image: url({{ asset('assets/images/backgrounds/site-footer-bg.jpg') }});">
            </div>
            <div class="site-footer__top">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                            <div class="footer-widget__column footer-widget__about">
                                <div class="footer-widget__about-text-box">
                                    <p class="footer-widget__about-text" style="font-size:24px;">Donate towards better
                                        mental health</p>
                                </div>
                                <a href="mailto:peersupport@yourewonderfulproject.org"
                                    class="donate-btn footer-donate__btn footer-donate__btn-dynamic" target="_blank"
                                    style="text-transform: uppercase; display: inline-flex; align-items: center; padding: 6px 25px 6px 6px; border-radius: 50px !important; border: none; text-decoration: none;">
                                    <div class="support-circle"
                                        style="border-radius: 50%; width: 40px; height: 40px; margin-right: 15px; flex-shrink: 0; display: block !important; text-align: center !important; line-height: 40px !important; background-color: #fff;">
                                        <i class="fa fa-heart"
                                            style="line-height: 40px !important; margin: 0 !important; font-size: 18px !important;"></i>
                                    </div>
                                    <span class="support-text"
                                        style="font-weight: 700; font-size: 14px; letter-spacing: 0.5px; padding-right: 10px;">GET
                                        SUPPORT</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                            <div class="footer-widget__column footer-widget__links clearfix">
                                <h3 class="footer-widget__title">About</h3>
                                <ul class="footer-widget__links-list list-unstyled clearfix">
                                    <li><a href="{{ url('our-mission') }}">Our Mission</a></li>
                                    <li><a href="{{ url('history') }}">History</a></li>
                                    <li><a href="{{ url('advisory-board') }}">Advisory Board</a></li>
                                    <li><a href="{{ url('research-papers') }}">Research Papers</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                            <div class="footer-widget__column footer-widget__non-profit clearfix">
                                <h3 class="footer-widget__title">Information</h3>
                                <ul class="footer-widget__non-profit-list list-unstyled clearfix">
                                    <li><a href="{{ url('team') }}">Team</a></li>
                                    <li><a href="{{ url('campaigns') }}">Campaigns</a></li>
                                    <li><a href="{{ url('blog') }}">Blog</a></li>
                                    <li><a href="{{ url('work-with-ywp') }}">Work with YWP</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-1 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                            <div class="footer-widget__column footer-widget__non-profit clearfix">
                                <h3 class="footer-widget__title">Connect</h3>
                                <ul class="footer-widget__non-profit-list list-unstyled clearfix">
                                    <li><a href="{{ url('gallery') }}">Gallery</a></li>
                                    <li><a href="{{ url('faq') }}">FAQs</a></li>
                                    <li><a href="{{ url('contact') }}">Connect</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                            <div class="footer-widget__column footer-widget__contact clearfix">
                                <h3 class="footer-widget__title">Contact</h3>
                                <ul class="list-unstyled footer-widget__contact-list">
                                    <li>
                                        <div class="icon">
                                            <span class="icon-email"></span>
                                        </div>
                                        <div class="text">
                                            <a
                                                href="mailto:info@yourewonderfulproject.org">info@yourewonderfulproject.org</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon" style="padding-top:10px;">
                                            <span class="icon-telephone"></span>
                                        </div>
                                        <div class="text">
                                            <a href="tel:+91 7982718997"> +91 7982718997</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-pin"></span>
                                        </div>
                                        <div class="text">
                                            <p>1, 22, Asaf Ali Rd, Kucha Pati Ram, Ajmeri Gate, New Delhi, Delhi 110002
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-footer__bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="site-footer__bottom-inner">
                                <p class="site-footer__bottom-text">© Copyright {{ date('Y') }} by <a href="#">YWP;
                                        India</a>
                                </p>
                                <div class="site-footer__social">
                                    <a href="https://twitter.com/YWPIndia" target="_blank"><i
                                            class="fab fa-twitter"></i></a>
                                    <a href="https://www.facebook.com/yourewonderfulproject" target="_blank"><i
                                            class="fab fa-facebook"></i></a>
                                    <a href="https://m.youtube.com/c/YoureWonderfulProject" target="_blank"><i
                                            class="fab fa-youtube"></i></a>
                                    <a href="https://instagram.com/yourewonderfulproject?utm_medium=copy_link"
                                        target="_blank"><i class="fab fa-instagram"></i></a>
                                    <a href="https://www.linkedin.com/company/ywpindia#" target="_blank"><i
                                            class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--Site Footer End-->


    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
            <div class="logo-box">
                <a href="{{ url('/') }}" aria-label="logo image"><img src="{{ asset('images/loader.png') }}" alt=""
                        height="100px" width="59px" /></a>
            </div>
            <div class="mobile-nav__container"></div>
            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:info@yourewonderfulproject.org">info@yourewonderfulproject.org</a>
                </li>
                <li>
                    <i class="fa fa-phone-alt"></i>
                    <a href="tel:+91 7982718997">+91 7982718997</a>
                </li>
            </ul>
            <div class="mobile-nav__top">
                <div class="mobile-nav__social">
                    <a href="https://twitter.com/YWPIndia" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.facebook.com/yourewonderfulproject" target="_blank"><i
                            class="fab fa-facebook"></i></a>
                    <a href="https://m.youtube.com/c/YoureWonderfulProject" target="_blank"><i
                            class="fab fa-youtube"></i></a>
                    <a href="https://instagram.com/yourewonderfulproject?utm_medium=copy_link" target="_blank"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/company/ywpindia#" target="_blank"><i
                            class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <div class="search-popup__content">
            <form action="#">
                <label for="search" class="sr-only">search here</label>
                <input type="text" id="search" placeholder="Search Here..." />
                <button type="submit" aria-label="search submit" class="thm-btn">
                    <i class="icon-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>

    <script src="{{ asset('assets/vendors/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jarallax/jarallax.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-appear/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/odometer/odometer.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/tiny-slider/tiny-slider.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/wnumb/wNumb.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/wow/wow.js') }}"></script>
    <script src="{{ asset('assets/vendors/isotope/isotope.js') }}"></script>
    <script src="{{ asset('assets/vendors/countdown/countdown.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bxslider/jquery.bxslider.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/vegas/vegas.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendors/timepicker/timePicker.js') }}"></script>

    <!-- template js -->
    <script src="{{ asset('assets/js/pifoxen.js') }}"></script>
    @stack('scripts')
</body>

</html>
<!doctype html>
<html class="no-js" lang="en">


<!-- Mirrored from html.themegenix.com/skillgro/student-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Nov 2024 20:53:12 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>New Learning Era</title>
    <meta name="description" content="SkillGro - Online Courses & Education Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon-skillgro.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon-skillgro-new.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/default-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plyr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tg-cursor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('style')
    <style>
        #profile {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <!--Preloader-->
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('favicon.png') }}" alt="Preloader"></div>
            </div>
        </div>
    </div>
    <!--Preloader-end -->

    <!-- Scroll-top -->
    <button class="scroll__top scroll-to-target" data-target="html">
        <i class="tg-flaticon-arrowhead-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    @include('layouts.student.header')
    <!-- header-area-end -->



    <!-- main-area -->
    <main class="main-area">

        <!-- dashboard-area -->
        <section class="dashboard__area section-pb-120">
            <div class="dashboard__bg">
                <img src="{{ asset('assets/img/bg/dashboard_bg.jpg') }}" alt="">
            </div>
            <div class="container">
                {{-- <div class="dashboard__top-wrap">
                    <div class="dashboard__top-bg"
                        style="background-image: url('{{ asset('assets/img/bg/student_bg.jpg') }}');"></div>
                    <div class="dashboard__instructor-info">
                        <div class="dashboard__instructor-info-left">
                            <div class="thumb">
                                <img src="{{ asset('assets/img/courses/details_instructors02.jpg') }}" alt="img">
                            </div>
                            <div class="content">
                                <h4 class="title">Emily Hannah</h4>
                                <ul class="list-wrap">
                                    <li>
                                        <img src="{{ asset('assets/img/icons/course_icon03.svg') }}" alt="img"
                                            class="injectable">
                                        10 Courses Enrolled
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/icons/course_icon05.svg') }}" alt="img"
                                            class="injectable">
                                        7 Certificate
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="dashboard__instructor-info-right">
                            <a href="#" class="btn btn-two arrow-btn">Become an Instructor <img
                                    src="{{ asset('assets/img/icons/right_arrow.svg') }}" alt="img"
                                    class="injectable"></a>
                        </div>
                    </div>
                </div> --}}
                <section class="mb-5 breadcrumb__area breadcrumb__bg"
        style="background-image: url('{{ asset('assets/img/bg/breadcrumb_bg.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Dasboard</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="/">Home</a>
                            </span>
                            <span class="breadcrumb-separator">
                                <i class="fas fa-angle-right"></i>
                            </span>
                            <span property="itemListElement" typeof="ListItem">Dashboard</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape-wrap">
            <img src="{{ asset('assets/img/others/breadcrumb_shape01.svg') }}" alt="Shape" class="alltuchtopdown" />
            <img src="{{ asset('assets/img/others/breadcrumb_shape02.svg') }}" alt="Shape" data-aos="fade-right" data-aos-delay="300" />
            <img src="{{ asset('assets/img/others/breadcrumb_shape03.svg') }}" alt="Shape" data-aos="fade-up" data-aos-delay="400" />
            <img src="{{ asset('assets/img/others/breadcrumb_shape04.svg') }}" alt="Shape" data-aos="fade-down-left"
                data-aos-delay="400" />
            <img src="{{ asset('assets/img/others/breadcrumb_shape05.svg') }}" alt="Shape" data-aos="fade-left" data-aos-delay="400" />
        </div>
    </section>
                <div class="dashboard__inner-wrap">
                    <div class="row">
                        @if (!request()->is('student/materi/detail'))
                            <div class="col-lg-3">
                                @include('layouts.student.sidebar')
                            </div>
                        @endif
                        <div class="col-lg-9">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- dashboard-area-end -->

    </main>
    <!-- main-area-end -->



    <!-- footer-area -->
    <footer class="footer__area">
        <div class="footer__top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer__widget">
                            <div class="logo mb-35">
                            <a href="javascript:void(0);"><img src="{{ asset('logo.png') }}" width="200px" alt="Logo"></a>
                            </div>
                            <div class="footer__content">
                            <p>New Learning space</p>
                            <ul class="list-wrap">
                                <li>Jl. Pisang No.50, Malang, Kec. Lowokwaru,
                                    Kota Malang,
                                    Jawa Timur 65145</li>
                                </li>
                                <li></li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="footer__widget">
                            <h4 class="footer__widget-title">ide dari kami</h4>
                            <div class="footer__link">
                                <ul class="list-wrap">
                                    <li><a href="/about">Tentang kami</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="footer__widget">
                            <h4 class=""></h4>
                            <div class="footer__link">
                                {{-- <ul class="list-wrap">
                                    <li><a href="contact.html">Contact Us</a></li>
                                    <li><a href="instructor-details.html">Become Teacher</a></li>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="instructor-details.html">Instructor</a></li>
                                    <li><a href="events-details.html">Events</a></li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer__widget">
                            <h4 class="footer__widget-title">Dapatkan kami</h4>
                            <div class="footer__contact-content">
                                <p>Bisa cek sosial media <br> </p>
                                <ul class="list-wrap footer__social">
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <img src="{{ asset('assets/img/icons/facebook.svg') }}" alt="img"
                                                class="injectable">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <img src="{{ asset('assets/img/icons/twitter.svg') }}" alt="img"
                                                class="injectable">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <img src="{{ asset('assets/img/icons/whatsapp.svg') }}" alt="img"
                                                class="injectable">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <img src="{{ asset('assets/img/icons/instagram.svg') }}" alt="img"
                                                class="injectable">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <img src="{{ asset('assets/img/icons/youtube.svg') }}" alt="img"
                                                class="injectable">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="app-download">
                                <a href="#"><img src="{{ asset('assets/img/others/google-play.svg') }}"
                                        alt="img"></a>
                                <a href="#"><img src="{{ asset('assets/img/others/apple-store.svg') }}"
                                        alt="img"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="copy-right-text">
                            <p>Copyright 2024 © Trio Of Innovator.</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="footer__bottom-menu">
                            <ul class="list-wrap">
                                <li><a href="javascript:void(0);">Term of Use</a></li>
                                <li><a href="javascript:void(0);">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-area-end -->



    <!-- JS here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.odometer.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/js/tween-max.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.marquee.min.js') }}"></script>
    <script src="{{ asset('assets/js/tg-cursor.min.js') }}"></script>
    <script src="{{ asset('assets/js/vivus.min.js') }}"></script>
    <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/js/svg-inject.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.circleType.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.lettering.min.js') }}"></script>
    <script src="{{ asset('assets/js/plyr.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        SVGInject(document.querySelectorAll("img.injectable"));
    </script>
    @yield('script')
</body>

</html>

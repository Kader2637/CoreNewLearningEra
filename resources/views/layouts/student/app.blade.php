<!doctype html>
<html class="no-js" lang="en">



<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>New Learning Era</title>
    <meta name="description" content="SkillGro - Online Courses & Education Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.png') }}">

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
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
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

    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('favicon.png') }}" alt="Preloader"></div>
            </div>
        </div>
    </div>

    <button class="scroll__top scroll-to-target" data-target="html">
        <i class="tg-flaticon-arrowhead-up"></i>
    </button>

    @include('layouts.student.header')



    <main class="main-area">

        <section class="dashboard__area section-pb-120">
            <div class="dashboard__bg">
                <img src="{{ asset('assets/img/bg/dashboard_bg.jpg') }}" alt="">
            </div>
            <div class="container">
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
                        <img src="{{ asset('assets/img/others/breadcrumb_shape01.svg') }}" alt="Shape"
                            class="alltuchtopdown" />
                        <img src="{{ asset('assets/img/others/breadcrumb_shape02.svg') }}" alt="Shape"
                            data-aos="fade-right" data-aos-delay="300" />
                        <img src="{{ asset('assets/img/others/breadcrumb_shape03.svg') }}" alt="Shape"
                            data-aos="fade-up" data-aos-delay="400" />
                        <img src="{{ asset('assets/img/others/breadcrumb_shape04.svg') }}" alt="Shape"
                            data-aos="fade-down-left" data-aos-delay="400" />
                        <img src="{{ asset('assets/img/others/breadcrumb_shape05.svg') }}" alt="Shape"
                            data-aos="fade-left" data-aos-delay="400" />
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

    </main>



    <footer class="footer__area">
        <div class="footer__top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer__widget">
                            <div class="logo mb-35">
                                <a href="javascript:void(0);"><img src="{{ asset('logo.png') }}" width="200px"
                                        alt="Logo"></a>
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



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/tween-max.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/tg-cursor.min.js') }}"></script>
    <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/js/svg-inject.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        SVGInject(document.querySelectorAll("img.injectable"));
    </script>
    @yield('script')
</body>

</html>

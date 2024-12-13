<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>New Learning Era</title>
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
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @yield('style')
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

    @include('layouts.landingpage.header')


    <main class="main-area fix">
        @yield('content')
    </main>



    @include('layouts.landingpage.footer')


    <div id="loading" style="text-align: center; display: none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
            <rect width="10" height="10" x="1" y="1" fill="currentColor" rx="1">
                <animate id="svgSpinnersBlocksShuffle30" fill="freeze" attributeName="x"
                    begin="0;svgSpinnersBlocksShuffle3b.end" dur="0.2s" values="1;13" />
                <animate id="svgSpinnersBlocksShuffle31" fill="freeze" attributeName="y"
                    begin="svgSpinnersBlocksShuffle38.end" dur="0.2s" values="1;13" />
                <animate id="svgSpinnersBlocksShuffle32" fill="freeze" attributeName="x"
                    begin="svgSpinnersBlocksShuffle39.end" dur="0.2s" values="13;1" />
                <animate id="svgSpinnersBlocksShuffle33" fill="freeze" attributeName="y"
                    begin="svgSpinnersBlocksShuffle3a.end" dur="0.2s" values="13;1" />
            </rect>
            <rect width="10" height="10" x="1" y="13" fill="currentColor" rx="1">
                <animate id="svgSpinnersBlocksShuffle34" fill="freeze" attributeName="y"
                    begin="svgSpinnersBlocksShuffle30.end" dur="0.2s" values="13;1" />
                <animate id="svgSpinnersBlocksShuffle35" fill="freeze" attributeName="x"
                    begin="svgSpinnersBlocksShuffle31.end" dur="0.2s" values="1;13" />
                <animate id="svgSpinnersBlocksShuffle36" fill="freeze" attributeName="y"
                    begin="svgSpinnersBlocksShuffle32.end" dur="0.2s" values="1;13" />
                <animate id="svgSpinnersBlocksShuffle37" fill="freeze" attributeName="x"
                    begin="svgSpinnersBlocksShuffle33.end" dur="0.2s" values="13;1" />
            </rect>
            <rect width="10" height="10" x="13" y="13" fill="currentColor" rx="1">
                <animate id="svgSpinnersBlocksShuffle38" fill="freeze" attributeName="x"
                    begin="svgSpinnersBlocksShuffle34.end" dur="0.2s" values="13;1" />
                <animate id="svgSpinnersBlocksShuffle39" fill="freeze" attributeName="y"
                    begin="svgSpinnersBlocksShuffle35.end" dur="0.2s" values="13;1" />
                <animate id="svgSpinnersBlocksShuffle3a" fill="freeze" attributeName="x"
                    begin="svgSpinnersBlocksShuffle36.end" dur="0.2s" values="1;13" />
                <animate id="svgSpinnersBlocksShuffle3b" fill="freeze" attributeName="y"
                    begin="svgSpinnersBlocksShuffle37.end" dur="0.2s" values="1;13" />
            </rect>
        </svg>
    </div>



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
    <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.circleType.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.lettering.min.js') }}"></script>
    <script src="{{ asset('assets/js/plyr.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield('script')
</body>



</html>

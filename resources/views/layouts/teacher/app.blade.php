<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="social-image.png" />
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>New Learning Era</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link href="{{ asset('assetsTeacher/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assetsTeacher/vendor/chartist/css/chartist.min.css') }}">
    <!-- Vectormap -->
    <link href="{{ asset('assetsTeacher/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assetsTeacher/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assetsTeacher/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assetsTeacher/css/style.css') }}" rel="stylesheet">
@yield('style')
</head>

<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div id="main-wrapper">
        @include('layouts.teacher.navHeader')
        @include('layouts.teacher.header')
        @include('layouts.teacher.sidebar')
        <div class="content-body">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        @include('layouts.teacher.footer')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('assetsTeacher/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assetsTeacher/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assetsTeacher/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assetsTeacher/vendor/owl-carousel/owl.carousel.js') }}"></script>
    <!-- Chart piety plugin files -->
    <script src="{{ asset('assetsTeacher/vendor/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assetsTeacher/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>

    <!-- Dashboard 1 -->
    <script src="{{ asset('assetsTeacher/js/dashboard/dashboard-1.js') }}"></script>
    <script src="{{ asset('assetsTeacher/js/custom.min.js') }}"></script>
    <script src="{{ asset('assetsTeacher/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('assetsTeacher/js/demo.js') }}"></script>
    @yield('script')
</body>

<!-- Mirrored from vora.dexignlab.com/xhtml/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Dec 2023 10:44:14 GMT -->

</html>

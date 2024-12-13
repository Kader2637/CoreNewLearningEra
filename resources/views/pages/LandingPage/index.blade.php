@extends('layouts.landingpage.app')
@section('content')
    <section class="banner-area banner-bg tg-motion-effects" data-background="assets/img/banner/banner_bg.png">
        <div class="container">
            <div class="row justify-content-between align-items-start">
                <div class="col-xl-5 col-lg-6">
                    <div class="banner__content">
                        <h3 class="title tg-svg" data-aos="fade-right" data-aos-delay="400">
                            New Learning
                            <span class="position-relative">
                                <span class="svg-icon" id="banner-svg"
                                    data-svg-icon="assets/img/objects/title_shape.svg"></span>
                                <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                                        fill="currentcolor" />
                                </svg>
                                Era
                            </span>
                        </h3>
                        <p data-aos="fade-right" data-aos-delay="600">Platform pembelajaran yang menyediakan akses ke
                            koleksi materi pembelajaran terbaik dan terbaru dalam satu lokasi yang mudah diakses. Dengan
                            berbagai topik yang mencakup berbagai bidang, mulai dari pengembangan web hingga keterampilan
                            digital lainnya, platform ini memudahkan Anda untuk menemukan materi berkualitas tanpa harus
                            mencari ke tempat lain.</p>
                        <div class="banner__btn-wrap" data-aos="fade-right" data-aos-delay="800">
                            <a href="/about" class="btn arrow-btn">Tentang Kami<img
                                    src="assets/img/icons/right_arrow.svg" alt="img" class="injectable"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="banner__images">
                        <img src="{{ asset('assets/img/banner/bannerlandingpage.png') }}" alt="img" class="main-img">
                        <div class="shape big-shape" data-aos="fade-up-right" data-aos-delay="600">
                            <img src="assets/img/banner/banner_shape01.png" alt="shape" class="tg-motion-effects1">
                        </div>
                        <img src="assets/img/banner/bg_dots.svg" alt="shape" class="shape bg-dots rotateme">
                        <img src="assets/img/banner/banner_shape02.png" alt="shape"
                            class="shape small-shape tg-motion-effects3">
                    </div>
                </div>
            </div>
        </div>
        <img src="assets/img/banner/banner_shape01.svg" alt="shape" class="line-shape" data-aos="fade-right"
            data-aos-delay="1600">
    </section>
    <section class="features__area-two pt-5 pb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 text-center mb-4">
                    <div class="section__title">
                        <span class="sub-title">Fitur Utama Kami</span>
                        <h2 class="title">Raih Tujuan Anda Dengan New Learning Era</h2>
                        <p>
                            Teknologi adalah jendela untuk membuka dunia baru.<br />
                            Manfaatkanlah untuk memperluas wawasan dan pengetahuanmu.
                        </p>
                    </div>
                </div>
            </div>

            <div class="features__item-wrap">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="features__item-two">
                            <div class="features__content-two">
                                <div class="content-top">
                                    <div class="features__icon-two">
                                        <img src="assets/img/icons/h2_features_icon01.svg" alt="Tutor Ahli icon"
                                            class="injectable" />
                                    </div>
                                    <h2 class="title">Tutor Ahli</h2>
                                </div>
                                <p>
                                    Dapatkan pembelajaran yang efektif dan terstruktur di New Learning Era, dengan tutorial
                                    ahli dan e-sertifikat yang mengakui kemampuan Anda di dunia.
                                </p>
                            </div>
                            <div class="features__item-shape">
                                <img src="assets/img/others/features_item_shape.svg" alt="Shape decoration"
                                    class="injectable" />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="features__item-two">
                            <div class="features__content-two">
                                <div class="content-top">
                                    <div class="features__icon-two">
                                        <img src="assets/img/icons/h2_features_icon02.svg"
                                            alt="Pembelajaran yang Efektif icon" class="injectable" />
                                    </div>
                                    <h2 class="title">Pembelajaran yang Efektif</h2>
                                </div>
                                <p>
                                    Dapatkan pembelajaran yang efektif dan terstruktur di New Learning Era, dengan tutorial
                                    ahli dan e-sertifikat yang mengakui kemampuan Anda di dunia.
                                </p>
                            </div>
                            <div class="features__item-shape">
                                <img src="assets/img/others/features_item_shape.svg" alt="Shape decoration"
                                    class="injectable" />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="features__item-two">
                            <div class="features__content-two">
                                <div class="content-top">
                                    <div class="features__icon-two">
                                        <img src="assets/img/icons/h2_features_icon03.svg" alt="Dapatkan Sertifikat icon"
                                            class="injectable" />
                                    </div>
                                    <h2 class="title">Dapatkan Sertifikat</h2>
                                </div>
                                <p>
                                    Dapatkan pembelajaran yang efektif dan terstruktur di New Learning Era, dengan tutorial
                                    ahli dan e-sertifikat yang mengakui kemampuan Anda di dunia.
                                </p>
                            </div>
                            <div class="features__item-shape">
                                <img src="assets/img/others/features_item_shape.svg" alt="Shape decoration"
                                    class="injectable" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="newsletter__area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="newsletter__img-wrap">
                        <img src="assets/img/others/kader.png" alt="img">
                        <img src="assets/img/others/newsletter_shape01.png" alt="img" data-aos="fade-up"
                            data-aos-delay="400">
                        <img src="assets/img/others/newsletter_shape02.png" alt="img" class="alltuchtopdown">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="newsletter__content">
                        <h2 class="title">Bingung cari <span>pembelajaran online?</span><br>New Learning Era,
                            <span>solusinya!</span></h2>
                        <div class="newsletter__form">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="newsletter__shape">
            <img src="assets/img/others/newsletter_shape03.png" alt="img" data-aos="fade-left"
                data-aos-delay="400">
        </div>
    </section>
    <section class="instructor__area-four mt-5">
        <div class="container">
            <div class="instructor__item-wrap-two">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="instructor__item-two tg-svg">
                            <div class="instructor__thumb-two">
                                <img src="assets/img/instructor/instructor_two01.png" alt="img" />
                                <div class="shape-one">
                                    <img src="assets/img/instructor/instructor_shape01.svg" alt="img"
                                        class="injectable" />
                                </div>
                                <div class="shape-two">
                                    <span class="svg-icon" id="instructor-svg"
                                        data-svg-icon="assets/img/instructor/instructor_shape02.svg"></span>
                                </div>
                            </div>
                            <div class="instructor__content-two">
                                <h3 class="title">
                                    <a href="/register/teacher">Masuk Sebagai Guru</a>
                                </h3>
                                <p>
                                    Bergabunglah sebagai guru untuk berbagi
                                    ilmu, menginspirasi, dan mendukung
                                    perkembangan siswa dalam lingkungan
                                    pembelajaran yang dinamis.
                                </p>
                                <div class="tg-button-wrap">
                                    <a href="/register/teacher" class="btn arrow-btn">
                                        Masuk
                                        <img src="assets/img/icons/right_arrow.svg" alt="img" class="injectable" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="instructor__item-two tg-svg">
                            <div class="instructor__thumb-two">
                                <img src="assets/img/instructor/siswa.png" width="200px" alt="img" />
                                <div class="shape-one">
                                    <img src="assets/img/instructor/instructor_shape01.svg" alt="img"
                                        class="injectable" />
                                </div>
                                <div class="shape-two">
                                    <span class="svg-icon" id="instructor-svg-two"
                                        data-svg-icon="assets/img/instructor/instructor_shape02.svg"></span>
                                </div>
                            </div>
                            <div class="instructor__content-two">
                                <h3 class="title">
                                    <a href="/register/student">
                                        Masuk Sebagai Siswa
                                    </a>
                                </h3>
                                <p>
                                    Daftar sebagai siswa untuk mengakses
                                    pembelajaran berkualitas, meningkatkan
                                    keterampilan, dan mencapai tujuan Anda
                                    bersama para ahli.
                                </p>
                                <div class="tg-button-wrap">
                                    <a href="/register/student" class="btn arrow-btn">
                                            Masuk
                                        <img src="assets/img/icons/right_arrow.svg" alt="img" class="injectable" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.landingpage.app')
@section('content')
    <section class="breadcrumb__area breadcrumb__bg"
        style="background-image: url('{{ asset('assets/img/bg/breadcrumb_bg.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Tentang Kami</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="/">Home</a>
                            </span>
                            <span class="breadcrumb-separator">
                                <i class="fas fa-angle-right"></i>
                            </span>
                            <span property="itemListElement" typeof="ListItem">Tentang Kami</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape-wrap">
            <img src="assets/img/others/breadcrumb_shape01.svg" alt="Shape" class="alltuchtopdown" />
            <img src="assets/img/others/breadcrumb_shape02.svg" alt="Shape" data-aos="fade-right" data-aos-delay="300" />
            <img src="assets/img/others/breadcrumb_shape03.svg" alt="Shape" data-aos="fade-up" data-aos-delay="400" />
            <img src="assets/img/others/breadcrumb_shape04.svg" alt="Shape" data-aos="fade-down-left"
                data-aos-delay="400" />
            <img src="assets/img/others/breadcrumb_shape05.svg" alt="Shape" data-aos="fade-left" data-aos-delay="400" />
        </div>
    </section>
    <section class="about-area-three section-py-120">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-9">
                    <div class="about__images-three tg-svg">
                        <img src="assets/img/others/about.jpg" alt="img" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about__content-three">
                        <div class="section__title mb-10">
                            <span class="sub-title">
                                Tentang Kami
                            </span>
                            <h2 class="title">
                                New
                                <span class="position-relative">
                                    <svg x="0px" y="0px" preserveAspectRatio="none" viewBox="0 0 209 59" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.74438 7.70565C69.7006 -1.18799 136.097 -2.38304 203.934 4.1205C207.178 4.48495 209.422 7.14626 208.933 10.0534C206.793 23.6481 205.415 36.5704 204.801 48.8204C204.756 51.3291 202.246 53.5582 199.213 53.7955C136.093 59.7623 74.1922 60.5985 13.5091 56.3043C10.5653 56.0924 7.84371 53.7277 7.42158 51.0325C5.20725 38.2627 2.76333 25.6511 0.0898448 13.1978C-0.465589 10.5873 1.61173 8.1379 4.73327 7.70565"
                                            fill="currentcolor" />
                                    </svg>
                                    Learning
                                </span>
                                Era
                            </h2>
                        </div>
                        <p class="desc">
                            Kami, tim Trio Innovator, mempersembahkan platform pembelajaran online yang revolusioner. Dengan
                            menawarkan kelas privat dan publik, kami berkomitmen untuk memudahkan akses pendidikan bagi
                            semua orang. Di era pembelajaran baru ini, kami percaya bahwa setiap individu berhak mendapatkan
                            ilmu dan keterampilan yang mereka butuhkan untuk berkembang. Bergabunglah dengan kami dan
                            rasakan pengalaman belajar yang lebih fleksibel, interaktif, dan menyenangkan!
                        </p>
                        <ul class="about__info-list list-wrap">
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">
                                    Akses Kelas Kapan Saja dan Di Mana Saja
                                </p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">
                                    Rencana Kursus yang Fleksibel
                                </p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">
                                    Kelas Publik dan Privat
                                </p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">
                                    Materi dalam Format Video, Dokumen, dan Lainnya
                                </p>
                            </li>
                            <li class="about__info-list-item">
                                <i class="flaticon-angle-right"></i>
                                <p class="content">
                                    Pengumpulan Tugas dan Penilaian yang Efisien
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.landingpage.app')
@section('content')
    <section class="breadcrumb__area breadcrumb__bg"
        style="background-image: url('{{ asset('assets/img/bg/breadcrumb_bg.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Kelas</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="/">Home</a>
                            </span>
                            <span class="breadcrumb-separator">
                                <i class="fas fa-angle-right"></i>
                            </span>
                            <span property="itemListElement" typeof="ListItem">Kelas</span>
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
    <section class="courses-area pt-5 pb-4" style="background-image: url('assets/img/bg/courses_bg.jpg');">
        <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card courses__item shine__animate-item">
                            <a href="#" class="shine__animate-link">
                                <img src="assets/img/courses/course_thumb01.jpg" alt="Learning JavaScript With Imagination" class="card-img-top" />
                            </a>
                            <div class="card-body">
                                <ul class="courses__item-meta list-wrap list-unstyled mb-3">
                                    <li class="courses__item-tag">
                                        <a href="#">Development</a>
                                    </li>
                                    <li class="avg-rating">
                                        <i class="fas fa-star"></i> (4.8 Reviews)
                                    </li>
                                </ul>
                                <h5 class="card-title">
                                    <a href="#">Learning JavaScript With Imagination</a>
                                </h5>
                                <p class="author">
                                    By <a href="#">David Millar</a>
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="button">
                                        <a href="#" class="btn btn-primary d-flex align-items-center">
                                            Masuk
                                            <i class="flaticon-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                    <h5 class="price mb-0">$15.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card courses__item shine__animate-item">
                            <a href="#" class="shine__animate-link">
                                <img src="assets/img/courses/course_thumb01.jpg" alt="Learning JavaScript With Imagination" class="card-img-top" />
                            </a>
                            <div class="card-body">
                                <ul class="courses__item-meta list-wrap list-unstyled mb-3">
                                    <li class="courses__item-tag">
                                        <a href="#">Development</a>
                                    </li>
                                    <li class="avg-rating">
                                        <i class="fas fa-star"></i> (4.8 Reviews)
                                    </li>
                                </ul>
                                <h5 class="card-title">
                                    <a href="#">Learning JavaScript With Imagination</a>
                                </h5>
                                <p class="author">
                                    By <a href="#">David Millar</a>
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="button">
                                        <a href="#" class="btn btn-primary d-flex align-items-center">
                                            Masuk
                                            <i class="flaticon-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                    <h5 class="price mb-0">$15.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card courses__item shine__animate-item">
                            <a href="#" class="shine__animate-link">
                                <img src="assets/img/courses/course_thumb01.jpg" alt="Learning JavaScript With Imagination" class="card-img-top" />
                            </a>
                            <div class="card-body">
                                <ul class="courses__item-meta list-wrap list-unstyled mb-3">
                                    <li class="courses__item-tag">
                                        <a href="#">Development</a>
                                    </li>
                                    <li class="avg-rating">
                                        <i class="fas fa-star"></i> (4.8 Reviews)
                                    </li>
                                </ul>
                                <h5 class="card-title">
                                    <a href="#">Learning JavaScript With Imagination</a>
                                </h5>
                                <p class="author">
                                    By <a href="#">David Millar</a>
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="button">
                                        <a href="#" class="btn btn-primary d-flex align-items-center">
                                            Masuk
                                            <i class="flaticon-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                    <h5 class="price mb-0">$15.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card courses__item shine__animate-item">
                            <a href="#" class="shine__animate-link">
                                <img src="assets/img/courses/course_thumb01.jpg" alt="Learning JavaScript With Imagination" class="card-img-top" />
                            </a>
                            <div class="card-body">
                                <ul class="courses__item-meta list-wrap list-unstyled mb-3">
                                    <li class="courses__item-tag">
                                        <a href="#">Development</a>
                                    </li>
                                    <li class="avg-rating">
                                        <i class="fas fa-star"></i> (4.8 Reviews)
                                    </li>
                                </ul>
                                <h5 class="card-title">
                                    <a href="#">Learning JavaScript With Imagination</a>
                                </h5>
                                <p class="author">
                                    By <a href="#">David Millar</a>
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="button">
                                        <a href="#" class="btn btn-primary d-flex align-items-center">
                                            Masuk
                                            <i class="flaticon-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                    <h5 class="price mb-0">$15.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="d-flex justify-content-center">
                <nav class="pagination__wrap mt-3">
                    <ul class="list-wrap pagination">
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">4</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection

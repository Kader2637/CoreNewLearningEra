@extends('layouts.student.app')
@section('content')
    <div class="col">
        <div class="dashboard__count-wrap">
            <div class="dashboard__content-title">
                <h4 class="title">Class</h4>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="courses__item courses__item-two shine__animate-item">
                        <div class="courses__item-thumb courses__item-thumb-two">
                            <a href="course-details.html" class="shine__animate-link">
                                <img src="{{ asset('assets/img/courses/course_thumb01.jpg') }}" alt="img">
                            </a>
                        </div>
                        <div class="courses__item-content courses__item-content-two">
                            <ul class="courses__item-meta list-wrap">
                                <li class="courses__item-tag">
                                    <a href="course.html">Development</a>
                                </li>
                            </ul>
                            <h5 class="title">
                                <a href="{{ route('course') }}">Learning JavaScript With Imagination</a>
                            </h5>

                            <div class="courses__item-content-bottom">
                                <div class="author-two">
                                    <a href="instructor-details.html"><img
                                            src="{{ asset('assets/img/courses/course_author001.png') }}"
                                            alt="img">David Millar</a>
                                </div>
                                <div class="avg-rating">
                                    <i class="fas fa-star"></i> (4.8 Reviews)
                                </div>
                            </div>

                        </div>
                        <div class="courses__item-bottom-two">
                            <ul class="list-wrap">
                                <li><i class="flaticon-book"></i>05</li>
                                <li><i class="flaticon-clock"></i>11h 20m</li>
                                <li><i class="flaticon-mortarboard"></i>22</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="courses__item courses__item-two shine__animate-item">
                        <div class="courses__item-thumb courses__item-thumb-two">
                            <a href="course-details.html" class="shine__animate-link">
                                <img src="{{ asset('assets/img/courses/course_thumb02.jpg') }}" alt="img">
                            </a>
                        </div>
                        <div class="courses__item-content courses__item-content-two">
                            <ul class="courses__item-meta list-wrap">
                                <li class="courses__item-tag">
                                    <a href="course.html">Design</a>
                                </li>
                            </ul>
                            <h5 class="title"><a href="course-details.html">The Complete Graphic Design for Beginners</a>
                            </h5>
                            <div class="courses__item-content-bottom">
                                <div class="author-two">
                                    <a href="instructor-details.html"><img
                                            src="{{ asset('assets/img/courses/course_author002.png') }}"
                                            alt="img">Wilson</a>
                                </div>
                                <div class="avg-rating">
                                    <i class="fas fa-star"></i> (4.5 Reviews)
                                </div>
                            </div>

                        </div>
                        <div class="courses__item-bottom-two">
                            <ul class="list-wrap">
                                <li><i class="flaticon-book"></i>60</li>
                                <li><i class="flaticon-clock"></i>70h 45m</li>
                                <li><i class="flaticon-mortarboard"></i>20</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="courses__item courses__item-two shine__animate-item">
                        <div class="courses__item-thumb courses__item-thumb-two">
                            <a href="course-details.html" class="shine__animate-link">
                                <img src="{{ asset('assets/img/courses/course_thumb03.jpg') }}" alt="img">
                            </a>
                        </div>
                        <div class="courses__item-content courses__item-content-two">
                            <ul class="courses__item-meta list-wrap">
                                <li class="courses__item-tag">
                                    <a href="course.html">Data Science</a>
                                </li>
                            </ul>
                            <h5 class="title"><a href="course-details.html">Learning JavaScript With Imagination</a></h5>
                            <div class="courses__item-content-bottom">
                                <div class="author-two">
                                    <a href="instructor-details.html"><img
                                            src="{{ asset('assets/img/courses/course_author003.png') }}"
                                            alt="img">Warren</a>
                                </div>
                                <div class="avg-rating">
                                    <i class="fas fa-star"></i> (4.8 Reviews)
                                </div>
                            </div>
                        </div>
                        <div class="courses__item-bottom-two">
                            <ul class="list-wrap">
                                <li><i class="flaticon-book"></i>08</li>
                                <li><i class="flaticon-clock"></i>18h 20m</li>
                                <li><i class="flaticon-mortarboard"></i>66</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.landingpage.app')
@section('style')
    <style>
        label {
            width: 100%;
        }

        .card-input-element {
            display: none;
        }

        .card-input {
            margin: 10px;
            padding: 00px;
        }

        .card-input:hover {
            cursor: pointer;
        }

        .card-input-element:checked+.card-input {
            box-shadow: 0 0 2px 2px #cb56fa;
        }

        .signup-area {
            background: linear-gradient(135deg, #eef2f3, #8e9eab);
            padding: 60px 0;
            text-align: center;
        }

        .signup-wrap .title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .signup-wrap p {
            font-size: 1.1rem;
            margin-bottom: 40px;
        }

        .role-button-circle {
            position: relative;
            display: inline-block;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #007bff, #0056b3);
            text-decoration: none;
            color: white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            transform-style: preserve-3d;
        }

        .role-button-circle.student {
            background: linear-gradient(135deg, #48cae4, #0077b6);
        }

        .role-button-circle.teacher {
            background: linear-gradient(135deg, #ffaf40, #ff7f50);
        }

        .role-button-circle:hover {
            transform: scale(1.1);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .role-button-circle .icon-wrapper {
            margin-top: 30px;
            animation: bounce 1.5s infinite;
        }

        .role-button-circle h5 {
            margin-top: 10px;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .role-button-circle .orbit {
            position: absolute;
            top: -10%;
            left: -10%;
            width: 120%;
            height: 120%;
            border: 2px dashed rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: rotate 6s linear infinite;
        }

        .role-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .role-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(-5px);
            }

            50% {
                transform: translateY(5px);
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection
@section('content')
    <section class="breadcrumb__area breadcrumb__bg"
        style="background-image: url('{{ asset('assets/img/bg/breadcrumb_bg.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Daftar</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="/">Home</a>
                            </span>
                            <span class="breadcrumb-separator">
                                <i class="fas fa-angle-right"></i>
                            </span>
                            <span property="itemListElement" typeof="ListItem">Daftar</span>
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
    <section class="signup-area section-py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 text-center">
                    <div class="signup-wrap">
                        <h2 class="title">PILIH ROLE</h2>
                        <p>
                            Pilih peran Anda dan mulailah perjalanan belajar Anda bersama kami. Klik salah satu peran di
                            bawah ini!
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-4 col-xl-6 col-lg-8 col-md-10 mt-4 text-center">
                    <a href="/register/student">
                        <div class="card role-card">
                            <div class="card-header">
                                <h5>Siswa</h5>
                            </div>
                            <div class="card-body">
                                <a href="/register/student" class="role-button-circle student">
                                    <div class="icon-wrapper mt-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                            viewBox="0 0 24 24">
                                            <path fill="#fff" d="M12 2L1 9l11 7l9-5.23V16h2V9L12 2z"></path>
                                            <path fill="#fff" d="M12 22L4 17v-5.07l8 4.58l8-4.58V17l-8 5z"></path>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-xxl-4 col-xl-6 col-lg-8 col-md-10 mt-4 text-center">
                    <a href="/register/teacher">
                        <div class="card role-card">
                            <div class="card-header">
                                <h5>Guru</h5>
                            </div>
                            <div class="card-body">
                                <a href="/register/teacher" class="role-button-circle teacher">
                                    <div class="icon-wrapper mt-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                            viewBox="0 0 24 24">
                                            <path fill="white"
                                                d="M12 3c2.21 0 4 1.79 4 4s-1.79 4-4 4s-4-1.79-4-4s1.79-4 4-4m4 10.54c0 1.06-.28 3.53-2.19 6.29L13 15l.94-1.88c-.62-.07-1.27-.12-1.94-.12s-1.32.05-1.94.12L11 15l-.81 4.83C8.28 17.07 8 14.6 8 13.54c-2.39.7-4 1.96-4 3.46v4h16v-4c0-1.5-1.6-2.76-4-3.46" />
                                        </svg>
                                    </div>
                                    <div class="orbit"></div>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

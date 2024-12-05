@extends('layouts.admin.app')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-xl-4 col-sm-7 box-col-3">
                <h3>Dashboard</h3>
            </div>
            <div class="col-5 d-none d-xl-block">

            </div>
            <div class="col-xl-3 col-sm-5 box-col-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/admin/dashboard">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="m2.25 12l8.955-8.955a1.124 1.124 0 0 1 1.59 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row folder">
        <div class="col-xl-3 col-lg-5 col-12 folder-box">
            <div class="card">
                <div class="card-body">
                    <div class="d-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 19.2c-2.5 0-4.71-1.28-6-3.2c.03-2 4-3.1 6-3.1s5.97 1.1 6 3.1a7.23 7.23 0 0 1-6 3.2M12 5a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-3A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10c0-5.53-4.5-10-10-10" />
                        </svg>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between">
                                <h4>Teacher</h4>
                                <p><span class="pull">30 Teacher</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-5 col-12 folder-box">
            <div class="card">
                <div class="card-body">
                    <div class="d-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M16 8c0 2.21-1.79 4-4 4s-4-1.79-4-4l.11-.94L5 5.5L12 2l7 3.5v5h-1V6l-2.11 1.06zm-4 6c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                        </svg>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between">
                                <h4>Student</h4>
                                <p><span class="pull">30 Student</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-5 col-12 folder-box">
            <div class="card">
                <div class="card-body">
                    <div class="d-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M23 2H1a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h22a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1m-1 18h-2v-1h-5v1H2V4h20zM10.29 9.71A1.71 1.71 0 0 1 12 8c.95 0 1.71.77 1.71 1.71c0 .95-.76 1.72-1.71 1.72s-1.71-.77-1.71-1.72m-4.58 1.58c0-.71.58-1.29 1.29-1.29a1.29 1.29 0 0 1 1.29 1.29c0 .71-.58 1.28-1.29 1.28S5.71 12 5.71 11.29m10 0A1.29 1.29 0 0 1 17 10a1.29 1.29 0 0 1 1.29 1.29c0 .71-.58 1.28-1.29 1.28s-1.29-.57-1.29-1.28M20 15.14V16H4v-.86c0-.94 1.55-1.71 3-1.71c.55 0 1.11.11 1.6.3c.75-.69 2.1-1.16 3.4-1.16s2.65.47 3.4 1.16c.49-.19 1.05-.3 1.6-.3c1.45 0 3 .77 3 1.71" />
                        </svg>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between">
                                <h4>Kelas</h4>
                                <p><span class="pull">30 Kelas</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-5 col-12 folder-box">
            <div class="card">
                <div class="card-body">
                    <div class="d-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M13 12h7v1.5h-7m0-4h7V11h-7m0 3.5h7V16h-7m8-12H3a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m0 15h-9V6h9" />
                        </svg>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between">
                                <h4>Materi</h4>
                                <p><span class="pull">30 Materi</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="d-flex justify-content-between">
            <h4 class="mb-4">
                Data Guru Menunggu approval
            </h4>
            <a href="#">
                Lihat Selengkapnya...
            </a>
        </div>
        <div class="col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
            <div class="card social-profile">
                <div class="card-body">
                    <div class="social-img-wrap">
                        <div class="social-img">
                            <img src="{{ asset('assets/img/others/kader.png') }}" width="75px" style="object-fit: cover" alt="profile" />
                        </div>
                        <div class="edit-icon">
                            <svg>
                                <use href="https://admin.pixelstrap.net/zono/assets/svg/icon-sprite.svg#profile-check">
                                </use>
                            </svg>
                        </div>
                    </div>
                    <div class="social-details">
                        <h5 class="mb-1">
                            <a href="#">Abdul Kader</a>
                        </h5>
                        <span class="f-light">abdulkader0126@gmail.com</span>
                        <div class="mt-4">
                            <div class="">
                                <button class="btn btn-info w-100">
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
            <div class="card social-profile">
                <div class="card-body">
                    <div class="social-img-wrap">
                        <div class="social-img">
                            <img src="{{ asset('assets/img/others/kader.png') }}" width="75px" style="object-fit: cover" alt="profile" />
                        </div>
                        <div class="edit-icon">
                            <svg>
                                <use href="https://admin.pixelstrap.net/zono/assets/svg/icon-sprite.svg#profile-check">
                                </use>
                            </svg>
                        </div>
                    </div>
                    <div class="social-details">
                        <h5 class="mb-1">
                            <a href="#">Abdul Kader</a>
                        </h5>
                        <span class="f-light">abdulkader0126@gmail.com</span>
                        <div class="mt-4">
                            <div class="">
                                <button class="btn btn-info w-100">
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
            <div class="card social-profile">
                <div class="card-body">
                    <div class="social-img-wrap">
                        <div class="social-img">
                            <img src="{{ asset('assets/img/others/kader.png') }}" width="75px" style="object-fit: cover" alt="profile" />
                        </div>
                        <div class="edit-icon">
                            <svg>
                                <use href="https://admin.pixelstrap.net/zono/assets/svg/icon-sprite.svg#profile-check">
                                </use>
                            </svg>
                        </div>
                    </div>
                    <div class="social-details">
                        <h5 class="mb-1">
                            <a href="#">Abdul Kader</a>
                        </h5>
                        <span class="f-light">abdulkader0126@gmail.com</span>
                        <div class="mt-4">
                            <div class="">
                                <button class="btn btn-info w-100">
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
            <div class="card social-profile">
                <div class="card-body">
                    <div class="social-img-wrap">
                        <div class="social-img">
                            <img src="{{ asset('assets/img/others/kader.png') }}" width="75px" style="object-fit: cover" alt="profile" />
                        </div>
                        <div class="edit-icon">
                            <svg>
                                <use href="https://admin.pixelstrap.net/zono/assets/svg/icon-sprite.svg#profile-check">
                                </use>
                            </svg>
                        </div>
                    </div>
                    <div class="social-details">
                        <h5 class="mb-1">
                            <a href="#">Abdul Kader</a>
                        </h5>
                        <span class="f-light">abdulkader0126@gmail.com</span>
                        <div class="mt-4">
                            <div class="">
                                <button class="btn btn-info w-100">
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

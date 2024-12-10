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
    </style>
@endsection

@section('content')
    <section class="breadcrumb__area breadcrumb__bg"
        style="background-image: url('{{ asset('assets/img/bg/breadcrumb_bg.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Masuk</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="/">Home</a>
                            </span>
                            <span class="breadcrumb-separator">
                                <i class="fas fa-angle-right"></i>
                            </span>
                            <span property="itemListElement" typeof="ListItem">Masuk</span>
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

    <section class="singUp-area section-py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="singUp-wrap">
                        <h2 class="title">Selamat datang!</h2>
                        <p>Halo, selamat datang kembali! Masukkan email dan kata sandi Anda untuk melanjutkan ke dalam akun. Kami siap membantu Anda menjalani pengalaman terbaik di sini. Ayo, segera masuk!</p>
                        <form action="/post/login" method="POST" class="account__form" id="loginForm">
                            @csrf
                            <div class="form-grp">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="text" placeholder="email" required>
                            </div>
                            <div class="form-grp">
                                <label for="password">Kata sandi</label>
                                <input id="password" name="password" type="password" placeholder="password" required>
                            </div>
                            <div class="account__check">
                                <div class="account__check-remember">
                                    <input type="checkbox" class="form-check-input" value="" id="terms-check">
                                    <label for="terms-check" class="form-check-label">Ingat saya</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-two arrow-btn">Masuk<img
                                    src="assets/img/icons/right_arrow.svg" alt="img" class="injectable"></button>
                        </form>
                        <div id="responseMessage"></div>
                        <div class="account__switch">
                            <p>Belum punya akun?<a href="{{ route('register') }}">Daftar</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        @if (session('warning'))
            toastr.warning('{!! session('warning') !!}', 'Status Pending');
        @elseif (session('error'))
            toastr.error('{!! session('error') !!}', 'Akses Ditolak');
        @elseif (session('success'))
            toastr.success('{!! session('success') !!}', 'Login Berhasil');
        @endif
    });
</script>
@endsection

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
                        <h3 class="title">Register Siswa</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="/">Home</a>
                            </span>
                            <span class="breadcrumb-separator">
                                <i class="fas fa-angle-right"></i>
                            </span>
                            <span property="itemListElement" typeof="ListItem">Register Siswa</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape-wrap">
            <img src="{{ asset('assets/img/others/breadcrumb_shape01.svg') }}" alt="Shape" class="alltuchtopdown" />
            <img src="{{ asset('assets/img/others/breadcrumb_shape02.svg') }}" alt="Shape" data-aos="fade-right"
                data-aos-delay="300" />
            <img src="{{ asset('assets/img/others/breadcrumb_shape03.svg') }}" alt="Shape" data-aos="fade-up"
                data-aos-delay="400" />
            <img src="{{ asset('assets/img/others/breadcrumb_shape04.svg') }}" alt="Shape" data-aos="fade-down-left"
                data-aos-delay="400" />
            <img src="{{ asset('assets/img/others/breadcrumb_shape05.svg') }}" alt="Shape" data-aos="fade-left"
                data-aos-delay="400" />
        </div>
    </section>
    <section class="singUp-area section-py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="singUp-wrap">
                        <h2 class="title">Student Register</h2>
                        <p>Hey there! Ready to log in? Just enter your username and password below and you'll be back in
                            action in no time. Let's go!</p>
                        <div class="account__social">

                        </div>
                        <div class="account__divider">

                        </div>
                        <form id="registrationForm" class="account__form">
                            <div class="form-grp">
                                <label for="nama">Nama Lengkap</label>
                                <input id="email" name="name" type="text" placeholder="nama lengkap">
                            </div>
                            <div class="form-grp">
                                <label for="jenis">Jenis Kelamin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                    value="male">
                                <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                            </div>
                            <div class="mb-4 form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                    value="female">
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                            </div>
                            <div class="form-grp">
                                <label for="no_telephone">No_telephone</label>
                                <input id="no_telephone" name="no_telephone" type="number" placeholder="masukan_no">
                            </div>
                            <div class="form-grp">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="text" placeholder="email">
                            </div>
                            <div class="row">
                                <div class="col-12 col-xl-6">
                                    <div class="form-grp">
                                        <label for="password">Password</label>
                                        <input id="password" name="password" type="password" placeholder="Masukkan Password"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="form-grp">
                                        <label for="confirm_password">Konfirmasi Password</label>
                                        <input id="confirm_password" name="password_confirmation" type="password"
                                            placeholder="Konfirmasi Password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="account__check">
                                <div class="account__check-remember">
                                    <input type="checkbox" class="form-check-input" value="" id="terms-check">
                                    <label for="terms-check" class="form-check-label">Remember me</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-two arrow-btn">Sign<img
                                    src="{{ asset('assets/img/icons/right_arrow.svg') }}" alt="img"
                                    class="injectable"></button>
                        </form>
                        <div class="account__switch">
                            <p><a href="{{ route('register') }}">Back</a></p>
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
            $('#registrationForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '/api/Apiregister/student',
                    data: $(this).serialize(),
                    success: function(response) {
                        toastr.success(
                            'Pendaftaran berhasil!',
                            'Sukses');
                        setTimeout(function() {
                            window.location.href = "/login";
                        }, 2000);
                    },
                    error: function(xhr) {
                        toastr.error('Terjadi kesalahan: ' + xhr.responseText, 'Kesalahan');
                    }
                });
            });
        });
    </script>
@endsection

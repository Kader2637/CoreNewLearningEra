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

        .card-input-element:checked + .card-input {
            box-shadow: 0 0 2px 2px #cb56fa;
        }

        label {
            width: 100%;
            text-align: left;
        }

      
        .profile-image-container {
            width: 120px;
            height: 120px;
            border-radius: 50%; 
            overflow: hidden; 
            background-color: #f0f0f0; 
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        .profile-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
        }

        .form-grp {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .form-grp label {
            margin-bottom: 8px;
        }

        .form-grp input,
        .form-grp textarea {
            width: 100%;
        }

       
        .profile-image-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center; 
            justify-content: center;
        }

        .profile-image-wrapper input {
            margin-top: 10px; 
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
                        <h2 class="title">Register siswa</h2>
                        <p>Selamat datang di platform pembelajaran kami! Bergabunglah dengan ribuan siswa lainnya dan mulailah perjalanan belajar Anda bersama New Learning Era. Daftar sekarang untuk mulai belajar dengan cara yang lebih menyenangkan dan efektif!</p>
                        <div class="account__social">

                        </div>
                        <div class="account__divider">

                        </div>
                        <form id="registrationForm" class="account__form" enctype="multipart/form-data">
                            <div class="col-12">
                                <div class="form-grp profile-image-wrapper">
                                    <div class="profile-image-container" id="profileImageContainer" style="display: none;">
                                        <img id="profileImage" src="{{ asset('assets/img/user.png') }}" alt="Foto Profil">
                                    </div>
                                    <label for="image">Foto Profil</label>
                                    <input id="image" name="image" type="file" onchange="previewImage(event)" required class="form-control">
                                </div>
                            </div>
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
                                    <label for="terms-check" class="form-check-label">Ingat saya</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-two arrow-btn" id="submitButton">
                                <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                Daftar<img src="{{ asset('assets/img/icons/right_arrow.svg') }}" alt="img" class="injectable">
                            </button>
                        </form>
                        <div class="account__switch">
                            <p><a href="{{ route('register') }}">Kembali</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profileImage');
                const container = document.getElementById('profileImageContainer');

                container.style.display = 'flex';
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        $(document).ready(function() {
            $('#registrationForm').on('submit', function(e) {
                e.preventDefault();

                $('#submitButton').prop('disabled', true);
                $('#spinner').show();

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: '/api/Apiregister/student',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success('Pendaftaran berhasil!', 'Sukses');
                        setTimeout(function() {
                            window.location.href = "/login";
                        }, 2000);
                    },
                    error: function(xhr) {
                        toastr.error('Terjadi kesalahan: ' + xhr.responseText, 'Kesalahan');
                    },
                    complete: function() {
                        $('#submitButton').prop('disabled', false);
                        $('#spinner').hide();
                    }
                });
            });
        });
    </script>
@endsection

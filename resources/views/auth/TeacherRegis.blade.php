@extends('layouts.landingpage.app')

@section('style')
    <style>
        label {
            width: 100%;
            text-align: left; /* Aligning the label text to the left */
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

        /* Styling for profile image inside the circle */
        .profile-image-container {
            width: 120px;
            height: 120px;
            border-radius: 50%; /* Make the image circular */
            overflow: hidden; /* Hide overflowed parts of the image */
            background-color: #f0f0f0; /* Background color if image is not available */
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px; /* Add margin if needed */
        }

        .profile-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Maintain aspect ratio */
        }

        .form-grp {
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Align the label to the left */
        }

        .form-grp label {
            margin-bottom: 8px;
        }

        .form-grp input, .form-grp textarea {
            width: 100%;
        }

        /* Ensure the label and the image are on separate lines */
        .profile-image-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center the elements */
            justify-content: center;
        }

        .profile-image-wrapper input {
            margin-top: 10px; /* Add margin between image and file input */
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
                        <h3 class="title">Register Teacher</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="/">Home</a>
                            </span>
                            <span class="breadcrumb-separator">
                                <i class="fas fa-angle-right"></i>
                            </span>
                            <span property="itemListElement" typeof="ListItem">Register Teacher</span>
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
                        <h2 class="title">Teacher Register</h2>
                        <p>Hey there! Ready to log in? Just enter your username and password below and you'll be back in
                            action in no time. Let's go!</p>
                        <div class="account__divider">
                            <span>or</span>
                        </div>
                        <form action="#" class="account__form" id="registrationForm" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Profile Picture (hidden initially) -->
                                <div class="col-12">
                                    <div class="form-grp profile-image-wrapper">

                                        <div class="profile-image-container" id="profileImageContainer" style="display: none;">
                                            <img id="profileImage" src="{{ asset('assets/img/user.png') }}" alt="Foto Profil">
                                        </div>
                                        <label for="image">Foto Profil</label>
                                        <input id="image" name="image" type="file" onchange="previewImage(event)" required class="form-control">
                                    </div>
                                </div>

                                <!-- Form Fields -->
                                <div class="col-12 col-xl-6">
                                    <div class="form-grp">
                                        <label for="username">Username</label>
                                        <input id="username" name="name" type="text" placeholder="Masukkan username" required>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="form-grp">
                                        <label for="email">Email</label>
                                        <input id="email" name="email" type="email" placeholder="Masukkan Email" required>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="form-grp">
                                        <label for="no_telephone">No Telephone</label>
                                        <input id="no_telephone" name="no_telephone" type="number" placeholder="Masukkan No" required>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="">
                                        <label for="gender">Jenis Kelamin</label>
                                        <div class="gap-2">
                                            <input type="radio" name="gender" value="male" required> Laki-Laki
                                            <input type="radio" name="gender" value="female"> Perempuan
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="form-grp">
                                        <label for="school">Asal Yayasan/Sekolah</label>
                                        <input id="school" name="school" type="text" placeholder="Masukkan Yayasan" required>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="form-grp">
                                        <label for="nip">Nip</label>
                                        <input id="nip" type="number" name="nip" placeholder="Masukkan Nip" required>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-12">
                                    <div class="form-grp">
                                        <label for="address">Alamat</label>
                                        <textarea name="address" id="address" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="form-grp">
                                        <label for="password">Password</label>
                                        <input id="password" name="password" type="password" placeholder="Masukkan Password" required>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="form-grp">
                                        <label for="confirm_password">Konfirmasi Password</label>
                                        <input id="confirm_password" name="password_confirmation" type="password" placeholder="Konfirmasi Password" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-two arrow-btn">
                                Daftar
                                <img src="{{ asset('assets/img/icons/right_arrow.svg') }}" alt="img" class="injectable">
                            </button>
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
        // Function to display the selected profile image
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profileImage');
                const container = document.getElementById('profileImageContainer');

                // Display the profile image container when an image is selected
                container.style.display = 'flex';
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        $(document).ready(function() {
            $('#registrationForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '/api/Apiregister/teacher',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success(
                            'Pendaftaran berhasil! Silahkan menunggu konfirmasi dari admin terlebih dahulu!',
                            'Sukses');
                        setTimeout(function() {
                            window.location.href = "/login";
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Pendaftaran gagal! Coba lagi!', 'Gagal');
                    }
                });
            });
        });
    </script>
@endsection

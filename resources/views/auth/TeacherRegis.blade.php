@extends('layouts.landingpage.app')

@section('style')
    <style>
        label {
            width: 100%;
            text-align: left;
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

        .form-grp input, .form-grp textarea {
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

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: none;
            margin-left: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .btn-spinner {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .btn-spinner span {
            margin-right: 10px;
        }
    </style>
@endsection

@section('content')
   
    <section class="singUp-area section-py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="title">Register guru</h2>
                            <p>Selamat datang, calon pengajar! Bergabunglah dengan New Learning Era dan bantu membentuk masa depan generasi penerus dengan cara mengajar yang lebih efektif dan menyenangkan. Daftarkan diri Anda sekarang untuk berbagi ilmu dan pengalaman!</p>
                            <div class="account__divider">
                                <span>or</span>
                            </div>
                            <form action="#" class="account__form" id="registrationForm" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-grp profile-image-wrapper">
                                            <div class="profile-image-container" id="profileImageContainer" style="display: none;">
                                                <img id="profileImage" src="{{ asset('assets/img/user.png') }}" alt="Foto Profil">
                                            </div>
                                            <label for="image">Foto Profil</label>
                                            <input id="image" name="image" type="file" onchange="previewImage(event)" required class="form-select">
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6">
                                        <div class="form-grp">
                                            <label for="username">Username</label>
                                            <input id="username" name="name" type="text" placeholder="Masukkan username" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="form-grp">
                                            <label for="email">Email</label>
                                            <input id="email" name="email" type="email" placeholder="Masukkan Email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="form-grp">
                                            <label for="no_telephone">No Telephone</label>
                                            <input id="no_telephone" name="no_telephone" class="form-control" type="number" placeholder="Masukkan No" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="">
                                            <label for="gender">Jenis Kelamin</label>
                                            <div class="gap-2">
                                                <input type="radio" name="gender"  value="male" required> Laki-Laki
                                                <input type="radio" name="gender" value="female"> Perempuan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="form-grp">
                                            <label for="school">Asal Yayasan/Sekolah</label>
                                            <input id="school" name="school" class="form-control" type="text" placeholder="Masukkan Yayasan" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="form-grp">
                                            <label for="nip">Nip</label>
                                            <input id="nip" type="number" class="form-control" name="nip" placeholder="Masukkan Nip" required>
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
                                            <input id="password" name="password" type="password" class="form-control" placeholder="Masukkan Password" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="form-grp">
                                            <label for="confirm_password">Konfirmasi Password</label>
                                            <input id="confirm_password" name="password_confirmation" class="form-control" type="password" placeholder="Konfirmasi Password" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class=" btn btn-primary mt-3 w-100 text-center" id="submitButton">
                                    <span class="text-center">Daftar</span>
                                    <div id="loadingSpinner" class="spinner"></div>
                                </button>
                            </form>
                            <div class="account__switch">
                                <p><a href="{{ route('register') }}">Kembali</a></p>
                            </div>
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

                $('#submitButton span').hide();
                $('#loadingSpinner').show();
                $('#submitButton').prop('disabled', true);

                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '/api/Apiregister/teacher',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success('Pendaftaran berhasil! Silahkan menunggu konfirmasi dari admin terlebih dahulu!', 'Sukses');
                        setTimeout(function() {
                            window.location.href = "/login";
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Pendaftaran gagal! Coba lagi!', 'Gagal');
                    },
                    complete: function() {
                        $('#loadingSpinner').hide();
                        $('#submitButton span').show();
                        $('#submitButton').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection

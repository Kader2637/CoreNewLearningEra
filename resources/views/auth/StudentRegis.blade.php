@extends('layouts.landingpage.app')

@section('style')
<style>
    body, html {
        height: 100%;
    }

    /* agar footer tetap di bawah */
    .main-area {
        min-height: calc(100vh - 200px);
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    label {
        width: 100%;
        text-align: left;
    }

    /* Wizard */
    .wizard-step { display: none; }
    .wizard-step.active { display: block; animation: fade .3s ease; }

    @keyframes fade {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .wizard-nav {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .step-indicator {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #d1d5db;
        color: #374151;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 600;
        transition: .3s;
    }

    .active-step {
        background: #4b5563;
        color: white;
        box-shadow: 0 0 6px rgba(0,0,0,.3);
    }

    /* tombol */
    .btn-wizard {
        border-radius: 8px;
        padding: 10px 18px;
        font-weight: 600;
        border: none;
    }

    .btn-next { background: #4b5563; color: white; }
    .btn-prev { background: #9ca3af; color: white; }

    /* breadcrumb tanpa biru */
    .breadcrumb__area {
        background: linear-gradient(135deg, #f5f5f5, #e5e5e5) !important;
        color: #111;
    }

    .breadcrumb__area .breadcrumb a {
        color: #111 !important;
    }

    /* profile preview */
    .profile-image-container {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        background-color: #e5e7eb;
        display: none;
        justify-content: center;
        align-items: center;
    }

    .profile-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endsection


@section('content')

{{-- BREADCRUMB BARU TANPA BIRU --}}
<section class="py-5 breadcrumb__area">
    <div class="container">
        <h3 class="fw-bold mb-1">Register Siswa</h3>
        <nav class="breadcrumb">
            <a href="/">Home</a>
            <span class="mx-1">/</span>
            <span>Register Siswa</span>
        </nav>
    </div>
</section>

<section class="singUp-area section-py-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">

                <h2 class="text-center mb-2">Register Siswa</h2>
                <p class="text-center mb-4">
                    Isi data diri Anda untuk membuat akun siswa.
                </p>

                {{-- NAVIGASI WIZARD --}}
                <div class="wizard-nav mb-4">
                    <div id="stepIndicator1" class="step-indicator active-step">1</div>
                    <div id="stepIndicator2" class="step-indicator">2</div>
                    <div id="stepIndicator3" class="step-indicator">3</div>
                </div>

                {{-- FORM --}}
                <form id="registrationForm" enctype="multipart/form-data">

                    {{-- STEP 1 --}}
                    <div id="step1" class="wizard-step active">
                        <div class="form-grp mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control step-input">
                        </div>

                        <div class="form-grp">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control step-input">
                        </div>

                        <button type="button" class="btn-wizard btn-next mt-4"
                                onclick="validateStep(1)">Lanjut</button>
                    </div>

                    {{-- STEP 2 --}}
                    <div id="step2" class="wizard-step">
                        <div class="form-grp mb-3">
                            <label>No. Telepon</label>
                            <input type="number" name="no_telephone" class="form-control step-input">
                        </div>

                        <div class="form-grp mb-3">
                            <label>Jenis Kelamin</label>
                            <div class="d-flex gap-3">
                                <label><input type="radio" name="gender" value="male"> Laki-laki</label>
                                <label><input type="radio" name="gender" value="female"> Perempuan</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button class="btn-wizard btn-prev" type="button" onclick="goToStep(1)">Kembali</button>
                            <button class="btn-wizard btn-next" type="button" onclick="validateStep(2)">Lanjut</button>
                        </div>
                    </div>

                    {{-- STEP 3 --}}
                    <div id="step3" class="wizard-step">

                        <label>Foto Profil</label>
                        <div id="profileImageContainer" class="profile-image-container mb-2">
                            <img id="profileImage" src="{{ asset('assets/img/user.png') }}">
                        </div>
                        <input type="file" id="image" name="image" class="form-control"
                               onchange="previewImage(event)">

                        <div class="row mt-3">
                            <div class="col-6">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control step-input">
                            </div>
                            <div class="col-6">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                       class="form-control step-input">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn-wizard btn-prev" onclick="goToStep(2)">Kembali</button>

                            <button type="submit" id="submitButton" class="btn btn-success btn-wizard">
                                <span id="spinner" class="spinner-border spinner-border-sm"
                                      style="display:none;"></span>
                                Daftar
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>

@endsection



@section('script')
<script>
    function goToStep(step) {
        $(".wizard-step").removeClass("active");
        $("#step" + step).addClass("active");

        $(".step-indicator").removeClass("active-step");
        $("#stepIndicator" + step).addClass("active-step");
    }

    function validateStep(step) {

        let valid = true;

        // Step-specific required fields
        let fields = {
            1: ["name", "email"],
            2: ["no_telephone", "gender"],
            3: ["password", "password_confirmation"]
        };

        fields[step].forEach(f => {

            if ($(`[name='${f}']`).attr("type") === "radio") {
                if ($("input[name='gender']:checked").length === 0) {
                    valid = false;
                }
            } else if ($(`[name='${f}']`).val().trim() === "") {
                valid = false;
            }

        });

        if (!valid) {
            toastr.warning("Lengkapi semua kolom sebelum melanjutkan.");
            return;
        }

        goToStep(step + 1);
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            $("#profileImageContainer").show();
            $("#profileImage").attr("src", reader.result);
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // submit
    $("#registrationForm").submit(function(e){
        e.preventDefault();

        $("#submitButton").prop("disabled", true);
        $("#spinner").show();

        let formData = new FormData(this);

        $.ajax({
            url: "/api/Apiregister/student",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(){
                toastr.success("Pendaftaran berhasil!", "Sukses");
                setTimeout(() => window.location.href="/login", 1200);
            },
            error: function(){
                toastr.error("Terjadi kesalahan.", "Error");
            },
            complete: function(){
                $("#submitButton").prop("disabled", false);
                $("#spinner").hide();
            }
        });
    });
</script>
@endsection

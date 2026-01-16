@extends('layouts.landingpage.app')

@section('title', 'Masuk – New Learning Era')

@section('style')
    <style>
        :root {
            --nl-primary: #111827;
            --nl-secondary: #6b7280;
            --nl-border: #e5e7eb;
            --nl-accent: #2563eb;
            --nl-soft: #f3f4f6;
        }

        .auth-page {
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
            padding: 4rem 0 3rem;
            background: linear-gradient(135deg, #ffffff 0%, #eef2ff 100%);
        }

        .auth-card {
            border-radius: 1.5rem;
            border: 1px solid var(--nl-border);
            background-color: #ffffff;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .08);
        }

        .auth-side {
            border-radius: 1.5rem;
            background: #0f172a;
            color: #e5e7eb;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .auth-dot {
            position: absolute;
            border-radius: 999px;
            background: radial-gradient(circle, #2563eb, transparent 60%);
            opacity: .4;
        }

        .auth-dot.dot-1 {
            width: 180px;
            height: 180px;
            top: -40px;
            right: -40px;
        }

        .auth-dot.dot-2 {
            width: 140px;
            height: 140px;
            bottom: -30px;
            left: -30px;
        }

        .auth-side-badge {
            border-radius: 999px;
            background-color: rgba(15, 23, 42, 0.85);
            color: #e5e7eb;
            font-size: .75rem;
        }

        .auth-label {
            font-size: .9rem;
            color: var(--nl-primary);
            font-weight: 500;
        }

        .form-control {
            border-radius: .75rem;
            border-color: #d1d5db;
            font-size: .9rem;
        }

        .form-control:focus {
            border-color: var(--nl-accent);
            box-shadow: 0 0 0 .15rem rgba(37, 99, 235, .18);
        }

        .btn-pill {
            border-radius: 999px;
        }

        .role-card {
            border-radius: 1rem;
            border: 1px solid var(--nl-border);
            padding: 1rem 1.25rem;
            background-color: #ffffff;
            transition: .15s ease;
            height: 100%;
        }

        .role-card:hover {
            border-color: var(--nl-accent);
            box-shadow: 0 12px 28px rgba(37, 99, 235, .15);
            transform: translateY(-2px);
            text-decoration: none;
        }

        .role-icon {
            width: 40px;
            height: 40px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eff6ff;
            color: #2563eb;
            font-size: 1.2rem;
            margin-bottom: .5rem;
        }

        @media (max-width: 767.98px) {
            .auth-page {
                padding-top: 4.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <section class="auth-page">
        <div class="container">
            <div class="row justify-content-center g-4">
                <div class="col-lg-10 col-xl-9">
                    <div class="row g-0 auth-card overflow-hidden">
                        {{-- SIDE INFO KIRI (DESKTOP) --}}
                        <div class="col-lg-5 d-none d-lg-block">
                            <div class="auth-side h-100 d-flex flex-column">
                                <div class="auth-dot dot-1"></div>
                                <div class="auth-dot dot-2"></div>

                                <div class="mb-4">
                                    <span class="auth-side-badge px-3 py-1 d-inline-flex align-items-center gap-2">
                                        <i class="bi bi-mortarboard"></i>
                                        New Learning Era
                                    </span>
                                </div>

                                <h4 class="fw-semibold mb-3">
                                    Selamat datang kembali.
                                </h4>
                                <p class="small mb-4" style="opacity:.85;">
                                    Silakan masuk untuk melanjutkan aktivitas belajar Anda.
                                    Anda dapat mengakses kelas, progres, dan materi yang telah diikuti sebelumnya.
                                </p>

                                <ul class="small mb-4" style="opacity:.9;">
                                    <li>Mengakses kelas yang sudah terdaftar</li>
                                    <li>Melihat progres dan sertifikat</li>
                                    <li>Mendapatkan pembaruan materi dan pengumuman</li>
                                </ul>

                                <div class="mt-auto small" style="opacity:.7;">
                                    Belum memiliki akun? Anda dapat mendaftar sebagai siswa atau mentor melalui tombol
                                    <strong>Daftar</strong> di formulir.
                                </div>
                            </div>
                        </div>

                        {{-- FORM LOGIN KANAN --}}
                        <div class="col-lg-7">
                            <div class="p-4 p-md-5 bg-white h-100 d-flex flex-column justify-content-center">
                                <div class="mb-3 d-lg-none">
                                    <h4 class="fw-semibold mb-1">Masuk ke akun Anda</h4>
                                    <p class="text-secondary small mb-0">
                                        Silakan login untuk mengakses kelas dan materi pembelajaran.
                                    </p>
                                </div>

                                <div class="mb-3 d-none d-lg-block">
                                    <h4 class="fw-semibold mb-1">Masuk ke akun Anda</h4>
                                    <p class="text-secondary small mb-0">
                                        Gunakan email dan kata sandi yang telah Anda daftarkan sebelumnya.
                                    </p>
                                </div>

                                {{-- NOTIFIKASI (opsional dari session/toastr) --}}
                                <div id="responseMessage"></div>

                                {{-- FORM LOGIN --}}
                                <form action="/post/login" method="POST" class="account__form" id="loginForm">
                                    @csrf

                                    {{-- EMAIL (name & id SAMA seperti kode lama) --}}
                                    <div class="mb-3 form-grp">
                                        <label for="email" class="auth-label mb-1">Email</label>
                                        <input id="email" name="email" type="text" class="form-control"
                                            placeholder="nama@mail.com" required>
                                    </div>

                                    {{-- PASSWORD (name & id SAMA seperti kode lama) --}}
                                    <div class="mb-3 form-grp">
                                        <label for="password" class="auth-label mb-1">Kata sandi</label>
                                        <div class="input-group">
                                            <input id="password" name="password" type="password" class="form-control"
                                                placeholder="Masukkan kata sandi" required>
                                            <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- INGAT SAYA (bisa ditambah name kalau dibutuhkan) --}}
                                    <div class="account__check mb-3 d-flex justify-content-between align-items-center">
                                        <div class="account__check-remember d-flex align-items-center gap-2">
                                            <input type="checkbox" class="form-check-input" value="" id="terms-check">
                                            <label for="terms-check" class="form-check-label small text-secondary m-0">
                                                Ingat saya
                                            </label>
                                        </div>
                                    </div>

                                    {{-- TOMBOL MASUK (URL & METHOD TIDAK DIUBAH) --}}
                                    <button type="submit"
                                        class="btn btn-two arrow-btn btn-pill w-100 btn-outline-secondary">
                                        Masuk
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            viewBox="0 0 16 16"><!-- Icon from Codicons by Microsoft Corporation - https://github.com/microsoft/vscode-codicons/blob/main/LICENSE -->
                                            <path fill="currentColor"
                                                d="M2.5 7.5a.5.5 0 0 0 0 1h9.697l-4.031 3.628a.5.5 0 0 0 .668.744l5-4.5a.5.5 0 0 0 0-.744l-5-4.5a.5.5 0 0 0-.668.744L12.197 7.5z" />
                                        </svg> </button>

                                    {{-- TOMBOL DAFTAR → MODAL ROLE PILIHAN --}}
                                    <div class="text-center mt-3">
                                        <p class="small text-secondary mb-2">
                                            Belum memiliki akun?
                                        </p>
                                        <button type="button" class="btn btn-outline-secondary btn-pill px-4"
                                            data-bs-toggle="modal" data-bs-target="#registerChoiceModal">
                                            Daftar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>{{-- end auth-card --}}
                </div>
            </div>
        </div>
    </section>

    {{-- MODAL PILIH JENIS AKUN --}}
    <div class="modal fade" id="registerChoiceModal" tabindex="-1" aria-labelledby="registerChoiceLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h6 class="modal-title fw-semibold" id="registerChoiceLabel">Pilih jenis akun</h6>
                        <p class="text-secondary small mb-0">
                            Silakan pilih peran yang sesuai dengan kebutuhan Anda.
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body pt-3 pb-3">
                    <div class="row g-3">
                        {{-- SISWA --}}
                        <div class="col-12 col-md-6">
                            <a href="{{ url('/register/student') }}" class="text-decoration-none text-reset">
                                <div class="role-card h-100">
                                    <div class="role-icon">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <h6 class="fw-semibold mb-1">Daftar sebagai siswa</h6>
                                    <p class="small text-secondary mb-1">
                                        Untuk Anda yang ingin mengikuti kelas dan mengembangkan keterampilan.
                                    </p>
                                    <small class="text-secondary">Akses materi, progres, dan sertifikat.</small>
                                </div>
                            </a>
                        </div>

                        {{-- MENTOR --}}
                        <div class="col-12 col-md-6">
                            <a href="{{ url('/register/teacher') }}" class="text-decoration-none text-reset">
                                <div class="role-card h-100">
                                    <div class="role-icon" style="background:#eefce8;color:#15803d;">
                                        <i class="bi bi-easel2"></i>
                                    </div>
                                    <h6 class="fw-semibold mb-1">Daftar sebagai mentor</h6>
                                    <p class="small text-secondary mb-1">
                                        Untuk Anda yang ingin berbagi ilmu dan mengajar di New Learning Era.
                                    </p>
                                    <small class="text-secondary">Buat kelas, kelola peserta, dan pantau progres.</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-link text-secondary small text-decoration-none"
                        data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // toastr dari session (TETAP sama seperti kode lama)
        $(document).ready(function() {
            @if (session('warning'))
                toastr.warning('{!! session('warning') !!}', 'Status Pending');
            @elseif (session('error'))
                toastr.error('{!! session('error') !!}', 'Akses Ditolak');
            @elseif (session('success'))
                toastr.success('{!! session('success') !!}', 'Login Berhasil');
            @endif
        });

        // toggle show / hide password
        const toggleBtn = document.getElementById('toggle-password');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                const pwd = document.getElementById('password');
                const icon = this.querySelector('i');
                if (pwd.type === 'password') {
                    pwd.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    pwd.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        }
    </script>
@endsection

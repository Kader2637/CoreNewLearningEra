@extends('layouts.landingpage.app')

@section('title', 'New Learning Era - Belajar Skill Digital')

@section('style')
<style>
    :root {
        --nl-primary: #111827;
        --nl-secondary: #6b7280;
        --nl-accent: #0f766e;
        --nl-soft: #f3f4f6;
        --nl-border: #e5e7eb;
        --radius: 18px;
    }

    body {
        background-color: #ffffff;
    }

    .home-hero {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        padding: 5rem 0 3rem;
        background-color: #ffffff;
    }

    @media (min-width: 992px) {
        .home-hero {
            padding: 5.5rem 0 4rem;
        }
    }

    .hero-badge {
        border-radius: 999px;
        background-color: #e5f2ff;
        color: #1d4ed8;
        font-size: .8rem;
    }

    .hero-title {
        font-size: 2.6rem;
        line-height: 1.3;
        color: var(--nl-primary);
    }

    .hero-title span {
        color: var(--nl-accent);
    }

    .hero-subtext {
        color: var(--nl-secondary);
        max-width: 520px;
    }

    .btn-pill {
        border-radius: 999px;
    }

    .hero-stats small {
        color: var(--nl-secondary);
        font-size: .8rem;
    }

    .hero-stats strong {
        color: var(--nl-primary);
        font-size: 1.1rem;
    }

    .hero-illustration {
        border-radius: 1.5rem;
        background: linear-gradient(135deg, #0f172a, #1f2937);
        box-shadow: 0 20px 45px rgba(15, 23, 42, .25);
        overflow: hidden;
        position: relative;
        color: #e5e7eb;
    }

    .hero-illustration img {
        max-width: 100%;
        height: auto;
        display: block;
    }

    .hero-illustration-badge {
        border-radius: .75rem;
        background-color: rgba(15, 23, 42, .8);
        font-size: .78rem;
    }

    .shadow-soft {
        box-shadow: 0 12px 30px rgba(15, 23, 42, .06);
    }

    .section-label {
        text-transform: uppercase;
        letter-spacing: .14em;
        font-size: .72rem;
        color: #9ca3af;
    }

    .logo-pill {
        border-radius: .75rem;
        border: 1px solid var(--nl-border);
        background-color: #ffffff;
        padding: .8rem 1.2rem;
        font-size: .85rem;
        color: var(--nl-secondary);
    }

    .path-card,
    .feature-card,
    .course-card {
        border-radius: 1rem;
        border: 1px solid var(--nl-border);
        background-color: #ffffff;
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        height: 100%;
    }

    .path-card:hover,
    .feature-card:hover,
    .course-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 35px rgba(15, 23, 42, .09);
        border-color: #d1d5db;
    }

    .icon-circle {
        width: 42px;
        height: 42px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #e5f2ff;
        color: #1d4ed8;
        font-size: 1.1rem;
    }

    .home-cta {
        border-radius: 1.5rem;
        background: linear-gradient(135deg, #0f766e, #2563eb);
        color: #f9fafb;
    }

    .home-cta small {
        opacity: .9;
    }

    /* CARD KELAS DI HOME (DINAMIS) */
    .home-class-card {
        border-radius: 1rem;
        border: 1px solid var(--nl-border);
        background-color: #ffffff;
        overflow: hidden;
        transition: .18s ease;
        height: 100%;
    }

    .home-class-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 35px rgba(15, 23, 42, .08);
        border-color: #d1d5db;
    }

    .home-class-img {
        width: 100%;
        height: 170px;
        object-fit: cover;
    }

    @media (max-width: 767.98px) {
        .hero-title {
            font-size: 2rem;
        }

        .home-hero {
            padding-top: 4.5rem;
            text-align: left;
        }
    }
</style>
@endsection

@section('content')

{{-- ==================== HERO SECTION ==================== --}}
<section id="home" class="home-hero">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
            {{-- Kiri: teks --}}
            <div class="col-lg-6">
                <span class="hero-badge px-3 py-1 d-inline-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-mortarboard"></i>
                    Belajar skill digital secara terarah
                </span>

                <h1 class="hero-title fw-bold mb-3">
                    Bangun kariermu di dunia digital
                    <br>
                    dengan <span>learning path yang jelas</span>.
                </h1>

                <p class="hero-subtext mb-4">
                    New Learning Era membantu Anda mempelajari pemrograman, desain, bahasa,
                    dan keterampilan karier melalui kelas online yang terstruktur dan praktis.
                </p>

                <div class="d-flex flex-wrap gap-2 mb-3">
                    {{-- URL diarahkan ke /classroom --}}
                    <a href="{{ url('/classroom') }}" class="btn btn-dark btn-pill px-4 py-2 fw-semibold">
                        Mulai Belajar Sekarang
                    </a>
                    <a href="{{ url('/about') }}" class="btn btn-outline-secondary btn-pill px-4 py-2">
                        Pelajari Tentang Platform
                    </a>
                </div>

                <small class="text-secondary d-block mb-4">
                    Akses materi kapan saja, tanpa batas waktu, lengkap dengan sertifikat penyelesaian kelas.
                </small>

                <div class="d-flex flex-wrap hero-stats gap-4">
                    <div>
                        <strong>3.200+</strong><br>
                        <small>Peserta terdaftar</small>
                    </div>
                    <div>
                        <strong>65+</strong><br>
                        <small>Kelas online aktif</small>
                    </div>
                    <div>
                        <strong>4.9/5</strong><br>
                        <small>Rata-rata ulasan kelas</small>
                    </div>
                </div>
            </div>

            {{-- Kanan: ilustrasi / kartu --}}
            <div class="col-lg-6">
                <div class="hero-illustration p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <small class="text-uppercase" style="font-size:.72rem;opacity:.8;">
                                Dashboard belajar
                            </small>
                            <h6 class="fw-semibold mb-0 text-white">Kelas yang sedang Anda ikuti</h6>
                        </div>
                        <span class="hero-illustration-badge px-3 py-1 d-flex align-items-center gap-1">
                            <span class="rounded-circle bg-success" style="width:8px;height:8px;"></span>
                            <span>Aktif</span>
                        </span>
                    </div>

                    <div class="mb-3 rounded-3 overflow-hidden bg-dark-subtle">
                        <img src="{{ asset('logo.png') }}" alt="New Learning Era" class="w-100">
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-success-subtle text-success rounded-pill">
                                Learning path Anda
                            </span>
                            <small style="opacity:.85;">Minggu ke-3 dari 8</small>
                        </div>

                        <div class="vstack gap-2">
                            <div class="d-flex justify-content-between align-items-center p-2 rounded-3"
                                 style="background-color:#0b1220;">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-primary d-flex align-items-center justify-content-center rounded-circle"
                                          style="width:28px;height:28px;">
                                        <i class="bi bi-code-slash text-white"></i>
                                    </span>
                                    <div>
                                        <small class="d-block text-white fw-semibold">Dasar Pemrograman Web</small>
                                        <small class="text-white-50">HTML • CSS • JavaScript</small>
                                    </div>
                                </div>
                                <small class="text-white-50">80%</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-info d-flex align-items-center justify-content-center rounded-circle"
                                          style="width:28px;height:28px;">
                                        <i class="bi bi-palette text-white"></i>
                                    </span>
                                    <div>
                                        <small class="d-block fw-semibold text-dark">UI/UX Design Fundamental</small>
                                        <small class="text-secondary">Wireframe & prototyping</small>
                                    </div>
                                </div>
                                <small class="text-secondary">Sedang berjalan</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-warning d-flex align-items-center justify-content-center rounded-circle"
                                          style="width:28px;height:28px;">
                                        <i class="bi bi-translate text-white"></i>
                                    </span>
                                    <div>
                                        <small class="d-block fw-semibold text-dark">English for Career</small>
                                        <small class="text-secondary">Interview & email</small>
                                    </div>
                                </div>
                                <small class="text-secondary">Batch baru</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center bg-body bg-opacity-10 rounded-3 p-2 px-3">
                        <div>
                            <small class="d-block" style="opacity:.8;">Progres minggu ini</small>
                            <small class="fw-semibold text-white">72% target belajar tercapai</small>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="progress" style="height:6px;background-color:#1f2937;">
                                <div class="progress-bar bg-success" style="width:72%;"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION TRUSTED / LOGO PARTNER (DUMMY) --}}
<section class="py-4 border-top border-bottom bg-white">
    <div class="container">
        <div class="text-center mb-3">
            <small class="section-label d-block mb-1">Telah dipercaya untuk kegiatan belajar</small>
        </div>
        <div class="row g-3 justify-content-center">
            <div class="col-6 col-md-3 col-lg-2">
                <div class="logo-pill text-center">Kampus Digital A</div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <div class="logo-pill text-center">Komunitas IT B</div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <div class="logo-pill text-center">SMK Teknologi C</div>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <div class="logo-pill text-center">Bootcamp D</div>
            </div>
            <div class="col-6 col-md-3 col-lg-2 d-none d-md-block">
                <div class="logo-pill text-center">Program Karier E</div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION LEARNING PATH / KATEGORI --}}
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <p class="section-label mb-1">Learning Path</p>
                <h2 class="fw-bold mb-1">Pilih jalur belajar sesuai tujuan Anda</h2>
                <p class="text-secondary mb-0">
                    Setiap jalur berisi beberapa kelas yang saling terhubung, mulai dari dasar hingga project akhir.
                </p>
            </div>
            {{-- URL diubah ke /classroom --}}
            <a href="{{ url('/classroom') }}" class="btn btn-outline-secondary btn-pill">
                Lihat semua kelas
                <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="path-card p-4">
                    <div class="mb-3">
                        <span class="icon-circle me-2">
                            <i class="bi bi-code-slash"></i>
                        </span>
                        <span class="badge bg-primary-subtle text-primary">Web Development</span>
                    </div>
                    <h5 class="fw-semibold mb-2">Front-End & Back-End Dasar</h5>
                    <p class="text-secondary mb-3">
                        Cocok bagi Anda yang ingin memulai karier sebagai web developer dari nol.
                    </p>
                    <ul class="small text-secondary mb-3 ps-3">
                        <li>HTML, CSS, dan JavaScript dasar</li>
                        <li>Framework back-end (contoh: Laravel)</li>
                        <li>Project website portofolio</li>
                    </ul>
                    <small class="text-secondary">
                        4 kelas · estimasi 8–10 minggu belajar
                    </small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="path-card p-4">
                    <div class="mb-3">
                        <span class="icon-circle me-2" style="background:#ecfeff;color:#0891b2;">
                            <i class="bi bi-bar-chart"></i>
                        </span>
                        <span class="badge bg-info-subtle text-info">Data & Analitik</span>
                    </div>
                    <h5 class="fw-semibold mb-2">Data Analysis & Visualisation</h5>
                    <p class="text-secondary mb-3">
                        Untuk Anda yang tertarik menganalisis data dan membuat insight yang mudah dipahami.
                    </p>
                    <ul class="small text-secondary mb-3 ps-3">
                        <li>Dasar pengolahan data</li>
                        <li>Visualisasi dan dashboard sederhana</li>
                        <li>Studi kasus berbasis dataset nyata</li>
                    </ul>
                    <small class="text-secondary">
                        3 kelas · estimasi 6–8 minggu belajar
                    </small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="path-card p-4">
                    <div class="mb-3">
                        <span class="icon-circle me-2" style="background:#fef3c7;color:#d97706;">
                            <i class="bi bi-brush"></i>
                        </span>
                        <span class="badge bg-warning-subtle text-warning">Desain & Konten</span>
                    </div>
                    <h5 class="fw-semibold mb-2">UI/UX & Konten Kreatif</h5>
                    <p class="text-secondary mb-3">
                        Sesuai bagi Anda yang ingin menggabungkan sisi visual dan pengalaman pengguna.
                    </p>
                    <ul class="small text-secondary mb-3 ps-3">
                        <li>Dasar desain antarmuka</li>
                        <li>Prototyping dengan Figma</li>
                        <li>Konten sosial media yang konsisten</li>
                    </ul>
                    <small class="text-secondary">
                        3 kelas · estimasi 6–8 minggu belajar
                    </small>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========== SECTION KELAS DINAMIS DI HOME ========== --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-4">
            <p class="section-label mb-1">Kelas Online</p>
            <h2 class="fw-bold mb-1">Kelas yang dapat Anda ikuti</h2>
            <p class="text-secondary mb-0">
                Beberapa kelas yang tersedia di New Learning Era. Anda dapat melihat daftar lengkapnya di halaman kelas.
            </p>
        </div>

        <div id="home-classroom-row" class="row g-4 justify-content-center">
            {{-- Card akan diisi secara dinamis dari /api/classroom --}}
        </div>
    </div>
</section>

{{-- SECTION FITUR UTAMA --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-4">
            <p class="section-label mb-1">Mengapa memilih New Learning Era?</p>
            <h2 class="fw-bold mb-2">Belajar dengan pendampingan yang lebih terarah</h2>
            <p class="text-secondary mb-0">
                Platform ini dirancang agar proses belajar tetap fleksibel, namun tetap memiliki struktur yang jelas.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card p-4">
                    <div class="icon-circle mb-3">
                        <i class="bi bi-person-video3"></i>
                    </div>
                    <h6 class="fw-semibold mb-2">Materi terstruktur</h6>
                    <p class="text-secondary small mb-0">
                        Setiap kelas memiliki modul yang disusun bertahap, sehingga peserta dapat memahami
                        konsep dari dasar hingga penerapan.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4">
                    <div class="icon-circle mb-3" style="background:#ecfeff;color:#0891b2;">
                        <i class="bi bi-easel2"></i>
                    </div>
                    <h6 class="fw-semibold mb-2">Latihan dan project</h6>
                    <p class="text-secondary small mb-0">
                        Tersedia latihan, kuis, dan project akhir sehingga peserta tidak hanya memahami teori,
                        tetapi juga memiliki pengalaman praktik.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4">
                    <div class="icon-circle mb-3" style="background:#fef3c7;color:#d97706;">
                        <i class="bi bi-patch-check"></i>
                    </div>
                    <h6 class="fw-semibold mb-2">Sertifikat penyelesaian</h6>
                    <p class="text-secondary small mb-0">
                        Setelah menyelesaikan kelas, peserta memperoleh sertifikat yang dapat digunakan sebagai
                        bukti belajar dalam CV maupun profil profesional.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA AKHIR --}}
<section class="py-5">
    <div class="container">
        <div class="home-cta p-4 p-md-5 shadow-soft text-center">
            <h3 class="fw-bold mb-2">Siap memulai perjalanan belajar Anda?</h3>
            <p class="mb-3">
                Mulailah dari kelas yang paling sesuai dengan kebutuhan. Anda dapat belajar secara mandiri,
                namun tetap mendapatkan dukungan dari mentor dan komunitas.
            </p>
            <div class="d-flex flex-wrap gap-2 justify-content-center mb-3">
                {{-- URL diarahkan ke /classroom --}}
                <a href="{{ url('/classroom') }}" class="btn btn-light btn-pill fw-semibold px-4">
                    Lihat daftar kelas
                </a>
                <a href="{{ url('/register/student') }}" class="btn btn-outline-light btn-pill px-4">
                    Daftar sebagai peserta
                </a>
            </div>
            <small>
                Jika belum yakin, Anda dapat melihat informasi lengkap setiap kelas sebelum melakukan pendaftaran.
            </small>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        const listContainer = $('#home-classroom-row');

        function renderHomeClassrooms(data) {
            listContainer.empty();

            if (!data || data.length === 0) {
                listContainer.append(`
                    <div class="col-12 text-center text-secondary">
                        Belum ada kelas yang dapat ditampilkan.
                    </div>
                `);
                return;
            }

            // tampilkan maksimal 3–6 kelas saja di landing, misal 3:
            const sliceData = data.slice(0, 3);

            sliceData.forEach(c => {
                const thumb = c.thumbnail ? `/storage/${c.thumbnail}` : `/default-thumbnail.jpg`;
                const desc = c.description
                    ? (c.description.length > 90 ? c.description.substring(0, 90) + '...' : c.description)
                    : 'Belum ada deskripsi';

                const mentor = c.user_name || 'Tidak diketahui';

                const card = `
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="home-class-card">
                            <img src="${thumb}" class="home-class-img" alt="${c.name}">
                            <div class="p-3">
                                <h5 class="fw-semibold mb-1">${c.name}</h5>
                                <p class="text-secondary small mb-2">${desc}</p>
                                <p class="text-secondary small mb-3">Mentor: <strong>${mentor}</strong></p>
                                <a href="/classroom" class="btn btn-dark btn-pill w-100">Lihat di halaman kelas</a>
                            </div>
                        </div>
                    </div>
                `;

                listContainer.append(card);
            });
        }

        $.ajax({
            url: '/api/classroom',
            method: 'GET',
            success: function (res) {
                const data = res.data || [];
                renderHomeClassrooms(data);
            },
            error: function () {
                renderHomeClassrooms([]);
            }
        });
    });
</script>
@endsection

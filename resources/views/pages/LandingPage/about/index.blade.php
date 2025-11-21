@extends('layouts.landingpage.app')

@section('title', 'Tentang Kami - New Learning Era')

@section('style')
<style>
    :root {
        --nl-primary: #1f2937;
        --nl-accent: #0f766e;
        --nl-soft: #f3f4f6;
    }

    .about-hero {
        padding: 5rem 0 3.5rem;
        background-color: #ffffff;
    }

    @media (min-width: 992px) {
        .about-hero {
            padding: 6rem 0 4rem;
        }
    }

    .about-badge {
        border-radius: 999px;
        background-color: #e5f2ff;
        color: #1d4ed8;
        font-size: .8rem;
    }

    .about-title {
        font-size: 2.2rem;
        line-height: 1.3;
        color: var(--nl-primary);
    }

    .about-title span {
        color: #0f766e;
    }

    .about-subtitle {
        color: #6b7280;
        max-width: 520px;
    }

    .chip-link {
        border-radius: 999px;
        font-size: .85rem;
    }

    .chip-link i {
        font-size: .9rem;
    }

    .about-hero-card {
        border-radius: 1.25rem;
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #e5e7eb;
        box-shadow: 0 18px 40px rgba(15, 23, 42, .24);
        overflow: hidden;
        position: relative;
    }

    .about-hero-card::before {
        content: "";
        position: absolute;
        top: -40px;
        right: -40px;
        width: 140px;
        height: 140px;
        background: radial-gradient(circle, rgba(34, 197, 94, .7), transparent 60%);
        opacity: .65;
    }

    .about-hero-card small {
        opacity: .85;
    }

    .about-stat-chip {
        border-radius: .75rem;
        background-color: rgba(15, 23, 42, .7);
        padding: .4rem .7rem;
        font-size: .75rem;
    }

    .about-stat-chip strong {
        color: #f9fafb;
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

    .about-card {
        border-radius: 1rem;
        background-color: #ffffff;
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        border: 1px solid #e5e7eb;
        height: 100%;
    }

    .about-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 30px rgba(15, 23, 42, .10);
        border-color: #d1d5db;
    }

    .timeline-dot {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background-color: #0f766e;
    }

    .timeline-line {
        width: 2px;
        background-color: #e5e7eb;
        flex-grow: 1;
    }

    .about-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--nl-primary);
    }

    .about-number-label {
        font-size: .85rem;
        color: #6b7280;
    }

    .about-cta {
        background: linear-gradient(135deg, #0f766e, #2563eb);
        border-radius: 1.5rem;
        color: #f9fafb;
    }

    .about-cta small {
        opacity: .9;
    }
</style>
@endsection

@section('content')

{{-- HERO TENTANG KAMI --}}
<section class="about-hero">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
            {{-- Kiri: teks utama --}}
            <div class="col-lg-7">
                <span class="about-badge px-3 py-1 d-inline-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-mortarboard"></i>
                    Tentang New Learning Era
                </span>

                <h1 class="about-title fw-bold mb-3">
                    Membantu Anda membangun
                    <span>keterampilan digital</span>
                    secara terarah dan berkelanjutan.
                </h1>

                <p class="about-subtitle mb-3">
                    New Learning Era merupakan platform pembelajaran yang dirancang untuk
                    mendukung pelajar, mahasiswa, dan profesional muda dalam mempelajari
                    keterampilan digital yang relevan dengan kebutuhan saat ini.
                </p>

                <p class="about-subtitle mb-4">
                    Kami menggabungkan materi terstruktur, praktik langsung, serta
                    pendampingan mentor agar proses belajar terasa jelas dan terukur,
                    tanpa mengabaikan kenyamanan dan fleksibilitas Anda.
                </p>

                <div class="d-flex flex-wrap gap-2 mb-3">
                    <a href="#visi-misi" class="btn btn-outline-secondary chip-link px-3 py-1">
                        <i class="bi bi-bullseye me-1"></i> Visi & Misi
                    </a>
                    <a href="#cara-kerja" class="btn btn-outline-secondary chip-link px-3 py-1">
                        <i class="bi bi-diagram-3 me-1"></i> Cara Belajar
                    </a>
                    <a href="#tim" class="btn btn-outline-secondary chip-link px-3 py-1">
                        <i class="bi bi-people me-1"></i> Tim & Mentor
                    </a>
                </div>
            </div>

            {{-- Kanan: kartu statistik --}}
            <div class="col-lg-5">
                <div class="about-hero-card p-4 p-md-4 hero-floating position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <small class="text-uppercase" style="font-size:.72rem;opacity:.8;">
                                Gambaran singkat
                            </small>
                            <h5 class="fw-semibold mb-0 text-white">New Learning Era dalam angka</h5>
                        </div>
                        <span class="badge bg-success-subtle text-success rounded-pill">
                            <i class="bi bi-check-circle me-1"></i> Aktif berjalan
                        </span>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-4">
                            <div class="about-number">3.200+</div>
                            <div class="about-number-label">Peserta terdaftar</div>
                        </div>
                        <div class="col-4">
                            <div class="about-number">65+</div>
                            <div class="about-number-label">Kelas online</div>
                        </div>
                        <div class="col-4">
                            <div class="about-number">4.9/5</div>
                            <div class="about-number-label">Rata-rata ulasan</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="d-block mb-1">Bidang pembelajaran utama</small>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="about-stat-chip">
                                <i class="bi bi-code-slash me-1 text-teal-300"></i>
                                Pemrograman & Web
                            </span>
                            <span class="about-stat-chip">
                                <i class="bi bi-brush me-1 text-warning"></i>
                                Desain & Kreatif
                            </span>
                            <span class="about-stat-chip">
                                <i class="bi bi-translate me-1 text-info"></i>
                                Bahasa & Karier
                            </span>
                        </div>
                    </div>

                    <small class="d-block" style="opacity:.9;">
                        Fokus kami adalah menyediakan pengalaman belajar yang terarah, dapat diikuti
                        secara mandiri, dan tetap memberikan ruang interaksi melalui forum dan sesi
                        bersama mentor.
                    </small>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- VISI & MISI --}}
<section id="visi-misi">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-6">
                <p class="section-label mb-1">Visi</p>
                <div class="about-card shadow-soft p-4">
                    <h4 class="fw-bold mb-3">Mendukung lebih banyak individu untuk berkembang melalui pembelajaran digital yang terarah.</h4>
                    <p class="text-secondary mb-2">
                        New Learning Era bertujuan untuk menjadi mitra belajar yang dapat diandalkan,
                        khususnya bagi Anda yang ingin memperkuat kompetensi di bidang teknologi dan
                        keterampilan pendukung lainnya.
                    </p>
                    <p class="text-secondary mb-0">
                        Kami ingin proses belajar tidak hanya menghasilkan pemahaman konsep,
                        tetapi juga mendorong peserta untuk berani berkarya dan mengembangkan karier.
                    </p>
                </div>
            </div>

            <div class="col-lg-6">
                <p class="section-label mb-1">Misi</p>
                <div class="vstack gap-3">
                    <div class="about-card p-3 d-flex gap-3">
                        <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center"
                             style="width:34px;height:34px;">
                            <i class="bi bi-compass text-primary"></i>
                        </div>
                        <div>
                            <strong>Menyusun jalur belajar yang jelas</strong>
                            <p class="text-secondary small mb-0">
                                Menyajikan materi yang tersusun dari dasar hingga tingkat lanjutan,
                                sehingga peserta memahami tahapan yang perlu ditempuh untuk mencapai tujuan belajar.
                            </p>
                        </div>
                    </div>
                    <div class="about-card p-3 d-flex gap-3">
                        <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center"
                             style="width:34px;height:34px;">
                            <i class="bi bi-people text-primary"></i>
                        </div>
                        <div>
                            <strong>Menghadirkan pendampingan mentor</strong>
                            <p class="text-secondary small mb-0">
                                Memberikan ruang tanya jawab, diskusi, dan umpan balik agar peserta
                                mendapatkan panduan yang lebih personal selama proses belajar.
                            </p>
                        </div>
                    </div>
                    <div class="about-card p-3 d-flex gap-3">
                        <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center"
                             style="width:34px;height:34px;">
                            <i class="bi bi-lightbulb text-primary"></i>
                        </div>
                        <div>
                            <strong>Mendorong praktik dan portofolio</strong>
                            <p class="text-secondary small mb-0">
                                Setiap jalur belajar diarahkan untuk menghasilkan project nyata, sehingga
                                peserta memiliki bukti kemampuan yang dapat ditampilkan di CV atau profil profesional.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CARA KERJA PLATFORM / TIMELINE --}}
<section id="cara-kerja">
    <div class="container">
        <div class="text-center mb-4">
            <p class="section-label mb-1">Cara Belajar di New Learning Era</p>
            <h2 class="fw-bold mb-2">Alur belajar yang sederhana dan terstruktur</h2>
            <p class="text-secondary mb-0">
                Kami merancang alur pembelajaran agar mudah dipahami, sehingga Anda dapat fokus pada materi dan latihan.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="about-card p-4 text-center">
                    <div class="mb-3">
                        <div class="timeline-dot mx-auto mb-2"></div>
                        <small class="text-secondary">Langkah 1</small>
                    </div>
                    <h6 class="fw-semibold mb-2">Pilih jalur dan kelas</h6>
                    <p class="text-secondary small mb-0">
                        Tentukan bidang yang ingin dipelajari, lalu pilih kelas sesuai tingkat kemampuan
                        dan tujuan pengembangan Anda.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-card p-4 text-center">
                    <div class="mb-3">
                        <div class="timeline-dot mx-auto mb-2"></div>
                        <small class="text-secondary">Langkah 2</small>
                    </div>
                    <h6 class="fw-semibold mb-2">Ikuti materi dan latihan</h6>
                    <p class="text-secondary small mb-0">
                        Pelajari video, baca modul pendukung, dan kerjakan latihan maupun kuis yang
                        disediakan pada setiap modul pembelajaran.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-card p-4 text-center">
                    <div class="mb-3">
                        <div class="timeline-dot mx-auto mb-2"></div>
                        <small class="text-secondary">Langkah 3</small>
                    </div>
                    <h6 class="fw-semibold mb-2">Bangun project dan raih sertifikat</h6>
                    <p class="text-secondary small mb-0">
                        Di akhir pembelajaran, Anda menyelesaikan project sebagai output.
                        Setelah selesai, Anda memperoleh sertifikat sebagai bukti pencapaian.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TIM & MENTOR --}}
<section id="tim">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <p class="section-label mb-1">Tim & Mentor</p>
                <h3 class="fw-bold mb-0">Kolaborasi pengajar dan praktisi</h3>
            </div>
            <span class="text-secondary small">
                Data nama dan peran dapat disesuaikan dengan kebutuhan institusi atau tim Anda.
            </span>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="about-card shadow-soft p-4 text-center">
                    <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width:70px;height:70px;">
                        <i class="bi bi-person-badge text-primary" style="font-size:1.7rem;"></i>
                    </div>
                    <h6 class="fw-semibold mb-1">Rahma Putri</h6>
                    <small class="text-muted d-block mb-2">Product & Learning Experience</small>
                    <p class="text-secondary small mb-0">
                        Bertanggung jawab menyusun alur pembelajaran dan memastikan materi dapat diikuti dengan nyaman
                        oleh berbagai profil peserta.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-card shadow-soft p-4 text-center">
                    <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width:70px;height:70px;">
                        <i class="bi bi-laptop text-primary" style="font-size:1.7rem;"></i>
                    </div>
                    <h6 class="fw-semibold mb-1">Andi Pratama</h6>
                    <small class="text-muted d-block mb-2">Mentor Pemrograman</small>
                    <p class="text-secondary small mb-0">
                        Berpengalaman di pengembangan aplikasi web dan berbagi praktik terbaik untuk membantu peserta
                        memahami dasar hingga implementasi.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-card shadow-soft p-4 text-center">
                    <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width:70px;height:70px;">
                        <i class="bi bi-brush text-primary" style="font-size:1.7rem;"></i>
                    </div>
                    <h6 class="fw-semibold mb-1">Dina Salsabila</h6>
                    <small class="text-muted d-block mb-2">Mentor Desain & Konten</small>
                    <p class="text-secondary small mb-0">
                        Memfokuskan materi pada desain antarmuka, visual branding, dan pembuatan konten yang informatif
                        sekaligus menarik secara visual.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA AKHIR --}}
<section class="pb-5">
    <div class="container">
        <div class="about-cta p-4 p-md-5 shadow-soft text-center">
            <h3 class="fw-bold mb-2">Ingin mengenal New Learning Era lebih jauh?</h3>
            <p class="mb-3">
                Anda dapat memulai dengan melihat daftar kelas yang tersedia atau membuat akun terlebih dahulu
                untuk menyusun rencana belajar sesuai kebutuhan.
            </p>
            <div class="d-flex flex-wrap gap-2 justify-content-center mb-3">
                <a href="{{ url('/kelas') }}" class="btn btn-light btn-pill fw-semibold">
                    <i class="bi bi-collection-play me-1"></i> Lihat daftar kelas
                </a>
                <a href="{{ url('/register/student') }}" class="btn btn-outline-light btn-pill">
                    <i class="bi bi-person-plus me-1"></i> Daftar sebagai peserta
                </a>
            </div>
            <small>
                Jika masih ragu menentukan kelas, Anda tetap dapat membuat akun terlebih dahulu dan menjelajahi materi secara bertahap.
            </small>
        </div>
    </div>
</section>

@endsection

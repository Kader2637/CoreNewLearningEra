<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'New Learning Era')</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />

    {{-- Google Font --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Global Style --}}
    <style>
        :root {
            --primary: #4f46e5;
            --primary-soft: #e0e7ff;
            --dark: #020617;
            --muted: #6b7280;
            --bg: #f4f4fb;
        }

        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--bg);
            color: #0f172a;
        }

        .navbar {
            backdrop-filter: blur(18px);
            background: rgba(255, 255, 255, 0.97) !important;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        }

        .navbar-brand-logo {
            width: 36px;
            height: 36px;
            border-radius: 999px;
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.45);
        }

        .nav-link {
            font-size: .95rem;
            color: #6b7280 !important;
        }

        .nav-link.active,
        .nav-link:hover {
            color: #111827 !important;
        }

        .btn-pill {
            border-radius: 999px;
        }

        main {
            padding-top: 4.5rem;
            /* ruang buat navbar fixed-top */
        }

        section {
            padding: 4.5rem 0;
        }

        /* === HERO FULL SCREEN === */
        .hero-section {
            position: relative;
            min-height: calc(100vh - 4.5rem);
            /* tingginya min 1 layar, dikurangi navbar */
            display: flex;
            align-items: center;
            padding: 5.5rem 0 5rem;
            background: radial-gradient(circle at top left, #4f46e5, #0f172a);
            color: #e5e7eb;
            overflow: hidden;
        }

        .hero-section .badge-soft {
            background: rgba(15, 23, 42, 0.4);
            border-radius: 999px;
            color: #e5e7eb;
            font-size: .78rem;
        }

        .hero-highlight {
            background: linear-gradient(135deg, #f97316, #facc15);
            -webkit-background-clip: text;
            color: transparent;
        }

        .hero-subtext {
            color: #e5e7ebcc;
        }

        .hero-blob {
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(96, 165, 250, 0.9), transparent 65%);
            top: -80px;
            right: -80px;
            opacity: .6;
            pointer-events: none;
        }

        .hero-blob-2 {
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(45, 212, 191, 0.75), transparent 65%);
            bottom: -60px;
            left: -40px;
            opacity: .55;
            pointer-events: none;
        }

        .hero-glass {
            background: rgba(15, 23, 42, 0.75);
            border-radius: 1.5rem;
            border: 1px solid rgba(148, 163, 184, 0.4);
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(18px);
        }

        .hero-floating {
            animation: heroFloat 4.2s ease-in-out infinite;
        }

        @keyframes heroFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .hero-mini-card {
            border-radius: 1rem;
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(148, 163, 184, 0.5);
        }

        .stat-pill {
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.9);
            padding: .35rem .9rem;
            font-size: .78rem;
            color: #e5e7eb;
        }

        .section-label {
            text-transform: uppercase;
            letter-spacing: .12em;
            font-size: .7rem;
            color: var(--muted);
        }

        .course-card {
            transition: all .18s ease;
        }

        .course-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.16);
        }

        .shadow-soft {
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
        }

        footer {
            font-size: .9rem;
            color: #6b7280;
        }

        /* MOBILE */
        @media (max-width: 767.98px) {
            main {
                padding-top: 4rem;
            }

            .hero-section {
                min-height: calc(100vh - 4rem);
                padding-top: 5rem;
                padding-bottom: 3.5rem;
                text-align: center;
            }

            .hero-section .d-flex {
                justify-content: center;
            }
        }
    </style>


    @yield('style')
</head>

<body data-bs-spy="scroll" data-bs-target="#mainNavbar" data-bs-offset="80">

    @include('layouts.landingpage.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.landingpage.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNavbar',
            offset: 80,
        });
    </script>

    @yield('script')
</body>

</html>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- === FIX FOOTER SELALU DI BAWAH === -->
    <style>
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        }
    </style>
    <!-- === END FIX FOOTER === -->

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
            font-family: "Poppins", system-ui, sans-serif;
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
        }

        section {
            padding: 4.5rem 0;
        }

        footer {
            font-size: .9rem;
            color: #6b7280;
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

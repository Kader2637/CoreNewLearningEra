<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top py-2">
    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="{{ asset('logo.png') }}" alt="Logo"
                 style="height:50px; width:auto;" class="me-2">

            <div class="lh-sm d-none d-md-block">
                <span class="fw-bold text-dark" style="font-size:1.05rem;">New Learning Era</span><br>
                <small class="text-muted" style="font-size:.78rem;">Learn • Build • Upgrade</small>
            </div>
        </a>

        {{-- TOGGLER --}}
        <button class="navbar-toggler border-0 shadow-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list" style="font-size:1.8rem;"></i>
        </button>

        {{-- NAV MENU --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">

                <li class="nav-item">
                    <a class="nav-link fw-semibold {{ request()->is('/') ? 'text-primary' : 'text-dark' }}"
                       href="{{ url('/') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold {{ request()->is('about') ? 'text-primary' : 'text-dark' }}"
                       href="{{ url('/about') }}">
                        Tentang Kami
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold {{ request()->is('classroom*') ? 'text-primary' : 'text-dark' }}"
                       href="{{ url('/classroom') }}">
                        Kelas
                    </a>
                </li>

                {{-- BUTTON LOGIN --}}
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <a href="{{ url('/login') }}"
                       class="btn btn-primary btn-pill px-4 fw-semibold d-flex align-items-center gap-1 shadow-sm">
                        <i class="bi bi-person-circle"></i>
                        Masuk
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>

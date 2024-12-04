<header>
    <div id="header-fixed-height"></div>
    <div id="sticky-header" class="tg-header__area">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="tgmenu__wrap">
                        <nav class="tgmenu__nav">
                            <div class="logo">
                                <a href="index-2.html"><img src="{{ asset('logo.png') }}" width="200px" alt="Logo"></a>
                            </div>
                            <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">
                                <ul class="navigation">
                                    <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
                                        <a href="/">Dashboard</a>
                                    </li>
                                    <li class="menu-item {{ request()->is('about') ? 'active' : '' }}">
                                        <a href="/about">Tentang Kami</a>
                                    </li>
                                    <li class="menu-item {{ request()->is('classroom') ? 'active' : '' }}">
                                        <a href="/classroom">Kelas</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tgmenu__action">
                                <ul class="list-wrap">
                                    <li class="header-btn login-btn">
                                        <a href="{{ route('login') }}">Log in</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mobile-login-btn">
                                <a href="{{ route('login') }}"><img src="assets/img/icons/user.svg" alt=""
                                        class="injectable"></a>
                            </div>
                            <div class="mobile-nav-toggler"><i class="tg-flaticon-menu-1"></i></div>
                        </nav>
                    </div>
                    <!-- Mobile Menu  -->
                    <div class="tgmobile__menu">
                        <nav class="tgmobile__menu-box">
                            <div class="close-btn"><i class="tg-flaticon-close-1"></i></div>
                            <div class="nav-logo">
                                <a href="index-2.html"><img src="{{ asset('logo.png') }}" width="200px" alt="Logo"></a>
                            </div>
                            <div class="tgmobile__search">
                                <form action="#">
                                    <input type="text" placeholder="Search here...">
                                    <button><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                            <div class="tgmobile__menu-outer">
                            </div>
                        </nav>
                    </div>
                    <div class="tgmobile__menu-backdrop"></div>
                </div>
            </div>
        </div>
    </div>
</header>

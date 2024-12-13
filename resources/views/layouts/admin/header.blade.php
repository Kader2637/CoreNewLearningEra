<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.html"> <img class="img-fluid for-light"
                        src="assetsAdmin/assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark"
                        src="assetsAdmin/assets/images/logo/logo_dark.png" alt=""></a></div>
            <div class="toggle-sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                    <path fill="currentColor"
                        d="M2 8.5A4.5 4.5 0 0 1 6.5 4h19A4.5 4.5 0 0 1 30 8.5v15a4.5 4.5 0 0 1-4.5 4.5h-19A4.5 4.5 0 0 1 2 23.5zM25.5 27a3.5 3.5 0 0 0 3.5-3.5v-15A3.5 3.5 0 0 0 25.5 5H12v22z" />
                </svg>
            </div>
        </div>
        <form class="col-sm-4 form-inline search-full d-none d-xl-block" action="#" method="get">
            <div class="form-group">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                    </div>
                </div>
            </div>
        </form>
        <div class="nav-right col-xl-8 col-lg-12 col-auto pull-right right-header p-0">
            <ul class="nav-menus">

                <li class="profile-nav onhover-dropdown pe-0 py-0">
                    <div class="d-flex align-items-center profile-media"><img class="b-r-25"
                            src="assetsAdmin/assets/images/dashboard/profile.png" alt="">
                        <div class="flex-grow-1 user"><span>New Learning</span>
                            <p class="mb-0 font-nunito">Admin

                            </p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">

                        <li>
                            <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                            <a href="#" id="logoutButton"
                                onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                <i data-feather="log-in"></i>
                                <span>Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

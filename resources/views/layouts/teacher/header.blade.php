<div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">

                            </div>
                        </div>
                        <ul class="navbar-nav header-right">

                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0)" role="button" data-bs-toggle="dropdown">
                                    <img src="{{ asset('storage/') }}/{{ auth()->user()->image }}" style="object-fit: cover" width="20" alt=""/>
									<div class="header-info">
										<span class="text-black">{{ auth()->user()->name }}</span>
										<p class="fs-12 mb-0">{{ auth()->user()->role }}</p>
									</div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
                                        @csrf
                                    </form>
                                    <a href="#"  class="dropdown-item ai-icon" id="logoutButton"
                                        onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span>Log Out</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

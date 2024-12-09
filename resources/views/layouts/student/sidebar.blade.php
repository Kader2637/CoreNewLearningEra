@if (!request()->is('student/materi/detail'))
<div class="dashboard__sidebar-wrap">
    <div class="mb-20 dashboard__sidebar-title">
        <h6 class="title">Welcome, {{ auth()->user()->name }}</h6>
    </div>
    <nav class="dashboard__sidebar-menu">
        <ul class="list-wrap">
            <li class="">
                <a href="/student/dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M3.5 3.5h7v7h-7zm10 0h7v7h-7zm-10 10h7v7h-7zm13 0h1v3h3v1h-3v3h-1v-3h-3v-1h3z"/></svg>
                    <i class=""></i>
                    Dashboard
                </a>
            </li>
            <li class="">
                <a href="/student/classroom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2M6 4h5v8l-2.5-1.5L6 12z"/></svg>
                    <i class=""></i>
                    Kelas
                </a>
            </li>
            <li class="">
                <a href="{{ route('join.classroom') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M17 15.635q-.961 0-1.634-.673q-.674-.673-.674-1.635t.674-1.635T17 11.02t1.635.673q.673.674.673 1.635t-.674 1.635t-1.634.673m-5.308 5.903v-3.101q.858-.504 1.775-.837t1.887-.494L17 19.25l1.627-2.144q.989.13 1.906.488t1.775.837v3.107zM8.923 20H4V4h16v5.308q-.64-.514-1.394-.786T17 8.25q-.134 0-.25.01t-.25.028v-.557h-9v1h7.423q-.923.4-1.602 1.111q-.679.712-1.05 1.658H7.5v1h4.52q-.097.621-.052 1.246t.245 1.235q-.172.077-.336.144t-.318.144H7.5v1h1.423z"/></svg>
                    <i class=""></i>
                    Bergabung
                </a>
            </li>
        </ul>
    </nav>
    <div class="mb-20 dashboard__sidebar-title mt-30">
        <h6 class="title">User</h6>
    </div>
    <nav class="dashboard__sidebar-menu">
        <ul class="list-wrap">
            <li>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
                <a href="#" id="logoutButton"
                    onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                    <i class="skillgro-logout"></i>
                    <span>Log Out</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
@endif

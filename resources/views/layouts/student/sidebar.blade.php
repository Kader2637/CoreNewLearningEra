@if (!request()->is('student/materi/detail'))
<div class="dashboard__sidebar-wrap">
    <div class="dashboard__sidebar-title mb-20">
        <h6 class="title">Welcome, Abdul Kader</h6>
    </div>
    <nav class="dashboard__sidebar-menu">
        <ul class="list-wrap">
            <li class="">
                <a href="/student/dashboard">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="">
                <a href="/student/classroom">
                    <i class="fas fa-home"></i>
                    Kelas
                </a>
            </li>
            <li class="">
                <a href="{{ route('join.classroom') }}">
                    <i class="fas fa-home"></i>
                    Bergabung
                </a>
            </li>
        </ul>
    </nav>
    <div class="dashboard__sidebar-title mt-30 mb-20">
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

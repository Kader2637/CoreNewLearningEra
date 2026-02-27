<div class="fixed z-50 top-5 left-0 w-full flex justify-center px-4 sm:px-6 lg:px-8 pointer-events-none">
    
    <div class="w-full max-w-7xl pointer-events-auto transition-all duration-300" data-aos="fade-down" data-aos-duration="800">
        
        <nav id="mainNavbar" class="relative bg-white/80 backdrop-blur-xl border border-white/60 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] rounded-2xl md:rounded-full px-5 lg:px-8 flex justify-between items-center h-16 md:h-20">

            {{-- LOGO --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3 group flex-shrink-0">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="h-12 md:h-14 w-auto group-hover:scale-105 transition-transform duration-300">
            </a>

            {{-- DESKTOP MENU (Tengah) --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ url('/') }}" class="relative font-bold text-[14px] transition-colors hover:text-indigo-600 {{ request()->is('/') ? 'text-indigo-600' : 'text-slate-600' }}">
                    Home
                    @if(request()->is('/')) <span class="absolute -bottom-1.5 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-indigo-600 rounded-full"></span> @endif
                </a>
                <a href="{{ url('/about') }}" class="relative font-bold text-[14px] transition-colors hover:text-indigo-600 {{ request()->is('about') ? 'text-indigo-600' : 'text-slate-600' }}">
                    Tentang Kami
                    @if(request()->is('about')) <span class="absolute -bottom-1.5 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-indigo-600 rounded-full"></span> @endif
                </a>
                <a href="{{ url('/classroom') }}" class="relative font-bold text-[14px] transition-colors hover:text-indigo-600 {{ request()->is('classroom*') ? 'text-indigo-600' : 'text-slate-600' }}">
                    Katalog Kelas
                    @if(request()->is('classroom*')) <span class="absolute -bottom-1.5 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-indigo-600 rounded-full"></span> @endif
                </a>
            </div>

            {{-- DESKTOP ACTION (Kanan) --}}
            <div class="hidden md:flex items-center flex-shrink-0">
                <a href="{{ url('/login') }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-indigo-600 text-white px-7 py-2.5 rounded-full font-bold text-[14px] transition-all duration-300 shadow-md hover:shadow-[0_0_20px_rgba(79,70,229,0.3)] hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    Masuk
                </a>
            </div>

            {{-- MOBILE MENU BUTTON --}}
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-btn" class="text-slate-800 hover:text-indigo-600 focus:outline-none p-2 bg-slate-100 rounded-xl transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            {{-- MOBILE MENU PANEL (Dropdown di bawah Navbar) --}}
            <div id="mobile-menu-panel" class="hidden absolute top-[115%] left-0 w-full bg-white/95 backdrop-blur-2xl border border-slate-200/80 shadow-2xl rounded-2xl overflow-hidden transition-all origin-top">
                <div class="p-5 flex flex-col gap-3">
                    <a href="{{ url('/') }}" class="flex items-center p-3.5 rounded-xl font-bold text-sm transition-colors {{ request()->is('/') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50' }}">
                        Home
                    </a>
                    <a href="{{ url('/about') }}" class="flex items-center p-3.5 rounded-xl font-bold text-sm transition-colors {{ request()->is('about') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50' }}">
                        Tentang Kami
                    </a>
                    <a href="{{ url('/classroom') }}" class="flex items-center p-3.5 rounded-xl font-bold text-sm transition-colors {{ request()->is('classroom*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50' }}">
                        Katalog Kelas
                    </a>
                    
                    <div class="w-full h-px bg-slate-100 my-2"></div>
                    
                    <a href="{{ url('/login') }}" class="flex items-center justify-center gap-2 w-full bg-slate-900 text-white p-4 rounded-xl font-bold text-sm shadow-md active:scale-95 transition-transform">
                        Masuk ke Akun
                    </a>
                </div>
            </div>

        </nav>
    </div>
</div>

{{-- Script Animasi Mobile Menu --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('mobile-menu-btn');
        const panel = document.getElementById('mobile-menu-panel');

        if (btn && panel) {
            btn.addEventListener('click', function () {
                if(panel.classList.contains('hidden')) {
                    panel.classList.remove('hidden');
                    panel.classList.add('animate-[slideDown_0.2s_ease-out]');
                } else {
                    panel.classList.add('hidden');
                }
            });
        }
    });
</script>

<style>
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
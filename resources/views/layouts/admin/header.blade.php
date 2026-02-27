<header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-[900] px-4 md:px-8 flex items-center justify-between shadow-sm transition-all duration-300">
    <div class="flex items-center gap-3 md:gap-4 overflow-hidden">
        <button onclick="toggleSidebar()" class="lg:hidden p-2.5 text-slate-500 bg-slate-50 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all active:scale-90">
            <i data-feather="menu" class="w-5 h-5"></i>
        </button>
        
        <h1 class="text-[10px] md:text-xs font-black text-slate-900 tracking-[0.1em] md:tracking-[0.2em] uppercase italic truncate max-w-[150px] md:max-w-none">
            @yield('page_title', 'Control Center')
        </h1>
    </div>

    <div class="flex items-center gap-2 md:gap-4 shrink-0">
        <div class="text-right hidden sm:block border-r border-slate-100 pr-4">
            <p class="text-[9px] md:text-[10px] font-black text-slate-900 leading-none uppercase">Admin Account</p>
            <p class="text-[8px] md:text-[9px] font-bold text-indigo-500 uppercase mt-1 tracking-tighter">Superuser</p>
        </div>
        
        <div class="w-10 h-10 md:w-11 md:h-11 bg-slate-100 rounded-xl md:rounded-2xl flex items-center justify-center border-2 border-white shadow-sm overflow-hidden shrink-0">
            <img src="{{ asset('favicon.png') }}" class="w-full h-full object-cover" onerror="this.src='{{ asset('favicon.png') }}'">
        </div>
    </div>
</header>
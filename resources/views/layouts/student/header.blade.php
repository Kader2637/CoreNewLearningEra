<header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-30 px-6 flex items-center justify-between">
    <div class="flex items-center gap-4">
        <h1 class="text-xl font-extrabold tracking-tight text-slate-900 md:block hidden">
            @yield('page_title', 'Overview')
        </h1>
    </div>

    <div class="flex items-center gap-4">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-slate-900 leading-none">{{ auth()->user()->name }}</p>
            <p class="text-[11px] font-medium text-slate-500 uppercase tracking-widest mt-1">Student Account</p>
        </div>
        <button class="w-10 h-10 rounded-full border-2 border-slate-100 overflow-hidden hover:border-indigo-500 transition-all">
            <img src="{{ auth()->user()->image ? asset('storage/'.auth()->user()->image) : asset('assets/img/user.png') }}" class="w-full h-full object-cover">
        </button>
    </div>
</header>
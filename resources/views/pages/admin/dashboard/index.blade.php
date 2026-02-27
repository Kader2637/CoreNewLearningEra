@extends('layouts.admin.app')

@section('page_title', 'System Intelligence')

@section('style')
<style>
    /* Premium Glassmorphism & Depth */
    .glass-card { 
        background: rgba(255, 255, 255, 0.7); 
        backdrop-filter: blur(10px); 
        border: 1px solid rgba(255, 255, 255, 0.5); 
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .glass-card:hover { 
        transform: translateY(-8px); 
        box-shadow: 0 30px 60px -12px rgba(79, 70, 229, 0.1); 
        border-color: #4f46e5;
    }
    .stat-circle { position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: #4f46e5; filter: blur(50px); opacity: 0.1; }
    
    /* Animation Pulse for Live Status */
    .status-pulse { animation: pulse-custom 2s infinite; }
    @keyframes pulse-custom { 
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4); } 
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(79, 70, 229, 0); } 
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); } 
    }
</style>
@endsection

@section('content')
<div class="space-y-10 mb-20 animate-fade-in">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 px-2">
        <div>
            <h2 class="text-4xl font-black text-slate-900 tracking-tighter uppercase leading-none">
                Command <span class="text-indigo-600">Center</span>
            </h2>
            <p class="text-slate-400 font-bold mt-2 uppercase text-[10px] tracking-[0.4em] flex items-center gap-2">
                <span class="w-2 h-2 bg-indigo-600 rounded-full status-pulse"></span>
                System Operational: {{ date('F Y') }}
            </p>
        </div>
        <div class="flex gap-3">
            <div class="px-6 py-3 bg-white rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                <span class="text-[10px] font-black uppercase text-slate-500 tracking-widest">Active Server</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="glass-card bg-white p-10 rounded-[3rem] shadow-sm relative overflow-hidden group">
            <div class="stat-circle"></div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Mentors</p>
            <div class="flex items-baseline gap-2">
                <h3 class="text-5xl font-black text-slate-900 tracking-tighter" id="countTeacher">0</h3>
                <span class="text-xs font-bold text-indigo-500">Active</span>
            </div>
            <div class="mt-8 flex items-center justify-between">
                <div class="w-12 h-12 bg-indigo-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-100 group-hover:rotate-12 transition-transform">
                    <i data-feather="users" class="w-5 h-5"></i>
                </div>
                <div class="text-right">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">+2 This Month</p>
                </div>
            </div>
        </div>

        <div class="glass-card bg-white p-10 rounded-[3rem] shadow-sm relative overflow-hidden group">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Students</p>
            <div class="flex items-baseline gap-2">
                <h3 class="text-5xl font-black text-slate-900 tracking-tighter" id="countStudent">0</h3>
                <span class="text-xs font-bold text-emerald-500">Enrolled</span>
            </div>
            <div class="mt-8 flex items-center justify-between">
                <div class="w-12 h-12 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-100 group-hover:-rotate-12 transition-transform">
                    <i data-feather="user-check" class="w-5 h-5"></i>
                </div>
            </div>
        </div>

        <div class="glass-card bg-white p-10 rounded-[3rem] shadow-sm relative overflow-hidden group">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Classrooms</p>
            <div class="flex items-baseline gap-2">
                <h3 class="text-5xl font-black text-slate-900 tracking-tighter" id="countClassroom">0</h3>
                <span class="text-xs font-bold text-amber-500">Hosted</span>
            </div>
            <div class="mt-8 flex items-center justify-between">
                <div class="w-12 h-12 bg-amber-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-amber-100 group-hover:rotate-12 transition-transform">
                    <i data-feather="box" class="w-5 h-5"></i>
                </div>
            </div>
        </div>

        <div class="glass-card bg-white p-10 rounded-[3rem] shadow-sm relative overflow-hidden group md:col-span-1">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Unit</p>
            <div class="flex items-baseline gap-2">
                <h3 class="text-5xl font-black text-slate-900 tracking-tighter" id="countCourse">0</h3>
                <span class="text-xs font-bold text-rose-500">Published</span>
            </div>
            <div class="mt-8 flex items-center justify-between">
                <div class="w-12 h-12 bg-rose-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-rose-100 group-hover:-rotate-12 transition-transform">
                    <i data-feather="book-open" class="w-5 h-5"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between px-4">
                <h4 class="text-sm font-black text-slate-900 uppercase tracking-[0.3em]">Pending Requests</h4>
                <a href="/admin/approval" class="text-[10px] font-black text-indigo-600 uppercase hover:underline">View Ledger</a>
            </div>
            
            <div class="data-pending grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-full py-12 text-center bg-white rounded-[2.5rem] border border-slate-100 shadow-sm animate-pulse">
                    <p class="text-[10px] font-bold text-slate-400 tracking-widest">FETCHING DATA...</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-900 rounded-[3rem] p-10 text-white relative overflow-hidden shadow-2xl">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-600/30 blur-[80px]"></div>
            <h4 class="text-xs font-black uppercase tracking-[0.3em] text-indigo-400 mb-10">Admin Shortcuts</h4>
            <div class="space-y-4">
                <a href="/admin/teacher" class="flex items-center justify-between p-5 bg-white/5 border border-white/10 rounded-3xl hover:bg-indigo-600 transition-all group">
                    <span class="text-xs font-bold tracking-tight uppercase">Manage Teachers</span>
                    <i data-feather="chevron-right" class="w-4 h-4 text-white group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="/admin/classroom" class="flex items-center justify-between p-5 bg-white/5 border border-white/10 rounded-3xl hover:bg-indigo-600 transition-all group">
                    <span class="text-xs font-bold tracking-tight uppercase">Audit Classroom</span>
                    <i data-feather="chevron-right" class="w-4 h-4 text-white group-hover:translate-x-1 transition-transform"></i>
                </a>
                <div class="mt-10 p-6 bg-indigo-600/20 rounded-3xl border border-indigo-500/20">
                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-2">System Version</p>
                    <p class="text-lg font-black tracking-tight uppercase">V0.1 <span class="text-xs font-normal text-indigo-300">| AETHER CODE</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function fetchData() {
        $.ajax({
            url: '/api/teacher/pending',
            method: 'GET',
            success: function(response) {
                let container = $('.data-pending');
                container.empty();

                if (response.status === "success" && response.data.length > 0) {
                    const maxCards = Math.min(response.data.length, 4);
                    for (let i = 0; i < maxCards; i++) {
                        let item = response.data[i];
                        let profileImage = item.image ? `/storage/${item.image}` : '/user.png';

                        container.append(`
                            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm flex items-center gap-5 hover:border-indigo-600 transition-all animate-fade-in group">
                                <img src="${profileImage}" class="w-14 h-14 rounded-2xl object-cover grayscale group-hover:grayscale-0 transition-all border-2 border-slate-50">
                                <div class="flex-1 overflow-hidden">
                                    <h5 class="text-xs font-black text-slate-900 truncate uppercase tracking-tight">${item.name}</h5>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">${item.email}</p>
                                </div>
                                <a href="/admin/teacher/detail/${item.id}" class="w-10 h-10 bg-slate-900 text-white rounded-xl flex items-center justify-center hover:bg-indigo-600 shadow-lg active:scale-90 transition-all">
                                    <i data-feather="chevron-right" style="width:14px"></i>
                                </a>
                            </div>
                        `);
                    }
                    feather.replace();
                } else {
                    container.html(`
                        <div class="col-span-full py-12 text-center bg-white rounded-[2.5rem] border border-dashed border-slate-200 animate-fade-in">
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.4em]">Zero Pending Requests</p>
                        </div>
                    `);
                }
            }
        });
    }

    function fetchCount() {
        $.ajax({
            url: '/api/count/statistika/admin/data',
            method: 'GET',
            success: function(res) {
                // Countup Animation Mock (Biar lebih hidup)
                animateValue("countTeacher", 0, res.countTeacher, 1000);
                animateValue("countStudent", 0, res.countStudent, 1000);
                animateValue("countClassroom", 0, res.countClassroom, 1000);
                animateValue("countCourse", 0, res.countCourse, 1000);
            }
        });
    }

    function animateValue(id, start, end, duration) {
        if (start === end) { document.getElementById(id).innerHTML = end; return; }
        let range = end - start;
        let current = start;
        let increment = end > start? 1 : -1;
        let stepTime = Math.abs(Math.floor(duration / range));
        let obj = document.getElementById(id);
        let timer = setInterval(function() {
            current += increment;
            obj.innerHTML = current;
            if (current == end) { clearInterval(timer); }
        }, stepTime);
    }

    $(document).ready(function() {
        fetchData();
        fetchCount();
    });
</script>
@endsection
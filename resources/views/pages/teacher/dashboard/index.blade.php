@extends('layouts.teacher.app')

@section('page_title', 'Dashboard Overview')

@section('style')
<style>
    .course-card {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .course-card:hover {
        transform: translateY(-10px);
    }
    .img-gradient {
        background: linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0) 60%);
    }
</style>
@endsection

@section('content')
<div class="mb-10 bg-slate-900 rounded-[3rem] p-8 md:p-12 text-white relative overflow-hidden shadow-2xl shadow-indigo-200/50" data-aos="fade-up">
    <div class="absolute top-0 right-0 w-80 h-80 bg-indigo-600/20 blur-[100px] rounded-full -mr-20 -mt-20"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-cyan-500/10 blur-[80px] rounded-full -ml-10 -mb-10"></div>

    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-10">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-white/5 border border-white/10 text-indigo-300 font-bold text-[10px] uppercase tracking-[0.2em] mb-6">
                <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                Instructor Account
            </div>
            <h2 class="text-3xl md:text-5xl font-black tracking-tighter leading-tight">
                Selamat Datang, <br> 
                <span class="text-indigo-400">{{ auth()->user()->name }}</span>
            </h2>
            <p class="mt-4 text-slate-400 font-medium max-w-md leading-relaxed text-lg">
                Pantau statistik kelas dan kelola materi belajar siswa Anda dalam satu panel kendali.
            </p>
        </div>

        <div class="flex gap-4 sm:gap-6">
            <div class="bg-white/5 border border-white/10 p-6 rounded-[2.5rem] backdrop-blur-xl flex flex-col items-center min-w-[140px] shadow-xl">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Total Guru</p>
                <span class="text-4xl font-black text-white" id="countTeacher">0</span>
            </div>
            <div class="bg-indigo-600 p-6 rounded-[2.5rem] flex flex-col items-center min-w-[140px] shadow-2xl shadow-indigo-600/20">
                <p class="text-[10px] font-black uppercase tracking-widest text-indigo-200 mb-2">Total Kelas</p>
                <span class="text-4xl font-black text-white" id="countClassroom">0</span>
            </div>
        </div>
    </div>
</div>

<div class="mb-10 flex items-center justify-between px-2">
    <div>
        <h3 class="text-2xl font-black text-slate-900 tracking-tight">Manajemen <span class="text-indigo-600">Kelas</span></h3>
        <p class="text-slate-400 text-sm font-bold uppercase tracking-widest mt-1">Daftar kelas aktif yang Anda kelola</p>
    </div>
    <a href="{{ route('classroom.teacher') }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm group">
        <svg class="w-6 h-6 transform group-hover:rotate-90 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
    </a>
</div>

<div id="loading" class="py-32 flex flex-col items-center justify-center text-center">
    <div class="w-14 h-14 border-[5px] border-slate-100 border-t-indigo-600 rounded-full animate-spin mb-6"></div>
    <p class="text-slate-400 font-black text-[11px] uppercase tracking-[0.3em] animate-pulse">Menghubungkan Database...</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10" id="data-teacher"></div>

<div id="no-data-message" class="hidden py-32 flex-col items-center justify-center text-center bg-white border-4 border-dashed border-slate-100 rounded-[3.5rem]" data-aos="zoom-in">
    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-8">
        <img src="{{ asset('no-data.png') }}" class="w-14 opacity-40">
    </div>
    <h3 class="text-2xl font-black text-slate-900 tracking-tight">Belum Ada Kelas</h3>
    <p class="text-slate-400 font-medium mt-2 max-w-xs mx-auto">Mulai buat ruang kelas pertama Anda untuk berbagi ilmu.</p>
    <a href="{{ route('classroom.teacher') }}" class="mt-10 px-10 py-4 bg-slate-900 text-white font-black uppercase text-xs tracking-[0.2em] rounded-2xl hover:bg-indigo-600 transition-all shadow-xl shadow-indigo-100">Buat Ruang Kelas</a>
</div>
@endsection

@section('script')
<script>
    const fetchClassData = () => {
        const authId = '{{ auth()->user()->id }}';
        $('#loading').show();
        $('#data-teacher').empty();

        $.ajax({
            url: `/api/my/classroom/teacher/data/${authId}`,
            method: 'GET',
            success: function(res) {
                $('#loading').hide();
                if (res.data.length > 0) {
                    res.data.forEach((kelas) => {
                        const thumb = kelas.thumbnail ? `{{ asset('storage') }}/${kelas.thumbnail}` : '/assets/user.png';
                        const desc = kelas.description.length > 85 ? kelas.description.substring(0, 85) + '...' : kelas.description;

                        $('#data-teacher').append(`
                            <div class="course-card group bg-white border border-slate-100 rounded-[3rem] overflow-hidden flex flex-col h-full shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10 transition-all">
                                <div class="relative aspect-[16/10] overflow-hidden">
                                    <img src="${thumb}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                                    <div class="absolute inset-0 img-gradient"></div>
                                    <div class="absolute top-6 left-6">
                                        <div class="flex items-center gap-2 px-3 py-1.5 bg-white/90 backdrop-blur-md rounded-xl shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                            <span class="text-[9px] font-black text-slate-900 uppercase tracking-widest">Active Room</span>
                                        </div>
                                    </div>
                                    <div class="absolute bottom-6 left-8 right-8 flex items-center justify-between text-white">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-indigo-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path></svg>
                                            <span class="text-[10px] font-black uppercase tracking-wider">E-Learning</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-8 md:p-10 flex flex-col flex-grow">
                                    <h5 class="text-2xl font-black text-slate-900 leading-tight group-hover:text-indigo-600 transition-colors mb-4 line-clamp-2">${kelas.name}</h5>
                                    <p class="text-slate-500 text-sm font-medium leading-relaxed mb-10 line-clamp-3">${desc}</p>
                                    
                                    <div class="mt-auto grid grid-cols-1 gap-4">
                                        <a href="/teacher/classroom/course/${kelas.id}" class="flex items-center justify-center gap-3 w-full py-4.5 bg-slate-50 text-indigo-600 font-black uppercase text-[10px] tracking-[0.2em] rounded-2xl group-hover:bg-indigo-600 group-hover:text-white group-hover:shadow-xl group-hover:shadow-indigo-500/30 transition-all duration-300">
                                            Manage Course
                                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                } else {
                    $('#no-data-message').removeClass('hidden').addClass('flex');
                }
            },
            error: () => $('#loading').hide()
        });
    };

    function fetchCount() {
        const authId = '{{ auth()->user()->id }}';
        $.ajax({
            url: `/api/count/statistika/${authId}`,
            method: 'GET',
            success: function(res) {
                $('#countTeacher').text(res.countTeacher);
                $('#countClassroom').text(res.countClassroom);
            }
        });
    }

    $(document).ready(function() {
        fetchClassData();
        fetchCount();
    });
</script>
@endsection
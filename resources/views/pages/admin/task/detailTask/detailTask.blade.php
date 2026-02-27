@extends('layouts.admin.app')

@section('page_title', 'Task Monitoring')

@section('style')
<style>
    .status-card { transition: all 0.3s ease; }
    .status-card:hover { transform: translateY(-5px); border-color: #4f46e5; }
    .custom-table th { font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #94a3b8; padding: 1.5rem 1rem; border: none; background: #f8fafc; }
    .custom-table td { padding: 1.25rem 1rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; font-weight: 600; color: #1e293b; font-size: 13px; }
    .table-container { background: white; border-radius: 2rem; border: 1px solid #f1f5f9; overflow: hidden; }
</style>
@endsection

@section('content')
<div class="mb-10 px-2 flex flex-col md:flex-row md:items-end justify-between gap-6 animate-fade-in">
    <div>
        <div class="flex items-center gap-3 mb-2">
            <div class="w-2 h-6 bg-indigo-600 rounded-full"></div>
            <h4 class="text-xl font-black text-slate-900 tracking-tight uppercase italic">Task Audit: <span class="text-indigo-600">{{ $taskCourse->name }}</span></h4>
        </div>
        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest leading-none">Memantau progres pengumpulan tugas secara real-time</p>
    </div>
    <a href="/admin/classroom/detail/course/{{ $taskCourse->course_id }}" class="px-8 py-3 bg-slate-900 text-white font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-indigo-600 transition-all shadow-lg active:scale-95 flex items-center gap-2">
        <i data-feather="arrow-left" class="w-4 h-4"></i> Kembali ke Materi
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
    <div class="lg:col-span-2 bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm relative overflow-hidden group">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-50 rounded-full blur-3xl opacity-50 group-hover:opacity-100 transition-opacity"></div>
        <h5 class="text-[10px] font-black uppercase text-indigo-600 tracking-[0.3em] mb-4">Lampiran & Instruksi</h5>
        <p class="text-slate-600 font-medium leading-relaxed italic text-lg">"{{ $taskCourse->description }}"</p>
    </div>

    <div class="bg-slate-900 p-10 rounded-[3rem] text-white flex flex-col justify-center relative overflow-hidden shadow-2xl">
        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/20 blur-[50px]"></div>
        <h5 class="text-[10px] font-black uppercase text-indigo-400 tracking-widest mb-4">Status Deadline</h5>
        @php
            $deadline = \Carbon\Carbon::parse($taskCourse->deadline);
            $now = \Carbon\Carbon::now();
        @endphp

        @if ($now->greaterThan($deadline))
            <h3 class="text-2xl font-black text-rose-400 tracking-tighter uppercase leading-tight">Masa Pengumpulan Berakhir</h3>
            <p class="text-[10px] font-bold text-slate-400 mt-2 uppercase tracking-widest opacity-60">Telat {{ $deadline->diffInDays($now) }} hari {{ $deadline->diffInHours($now) % 24 }} jam</p>
        @else
            <h3 class="text-2xl font-black text-emerald-400 tracking-tighter uppercase leading-tight">Sedang Berlangsung</h3>
            <p class="text-[10px] font-bold text-slate-400 mt-2 uppercase tracking-widest opacity-60">Sisa waktu: {{ $deadline->locale('id')->diffForHumans() }}</p>
        @endif
    </div>
</div>

<div class="space-y-12">
    <div>
        <div class="flex items-center gap-3 mb-6 px-4">
            <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
            <h4 class="text-sm font-black text-slate-900 uppercase tracking-[0.3em]">Completed Submissions</h4>
        </div>
        <div class="table-container shadow-xl shadow-slate-200/40">
            <table class="w-full text-left custom-table">
                <thead>
                    <tr>
                        <th class="text-center w-20">No</th>
                        <th>Identitas Siswa</th>
                        <th class="text-center">Nilai Audit</th>
                    </tr>
                </thead>
                <tbody id="submitted-tbody">
                    <tr><td colspan="3" class="py-20 text-center text-slate-400 font-bold uppercase text-[10px] tracking-widest animate-pulse">Syncing Submission Ledger...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="opacity-60 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500">
        <div class="flex items-center gap-3 mb-6 px-4">
            <div class="w-2 h-2 bg-slate-400 rounded-full"></div>
            <h4 class="text-sm font-black text-slate-400 uppercase tracking-[0.3em]">Awaiting Submission</h4>
        </div>
        <div class="table-container border-dashed border-2 border-slate-200">
            <table class="w-full text-left custom-table">
                <thead>
                    <tr>
                        <th class="text-center w-20">No</th>
                        <th>Nama Siswa</th>
                        <th class="text-right px-10">Status Sistem</th>
                    </tr>
                </thead>
                <tbody id="not-submitted-tbody">
                    <tr><td colspan="3" class="py-20 text-center text-slate-400 font-bold uppercase text-[10px] tracking-widest animate-pulse">Checking Attendance List...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        const taskCourseId = "{{ $taskCourse->id }}";

        function loadSubmittedAssignments() {
            const tbody = $('#submitted-tbody');
            $.ajax({
                url: `/api/done/assigment/task/${taskCourseId}`,
                method: 'GET',
                success: function(res) {
                    tbody.empty();
                    if (res.data.length === 0) {
                        tbody.append('<tr><td colspan="3" class="py-20 text-center text-slate-300 font-bold uppercase text-[10px] tracking-widest">Belum ada pengumpulan terdeteksi</td></tr>');
                    } else {
                        res.data.forEach((item, i) => {
                            tbody.append(`
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="text-center text-slate-400 font-black">${i + 1}</td>
                                    <td>
                                        <div class="font-black text-slate-900 uppercase tracking-tight">${item.name}</div>
                                        <div class="text-[9px] text-indigo-500 font-bold uppercase mt-1 tracking-widest">Verified Submission</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="inline-block px-5 py-2 bg-slate-900 text-white rounded-xl font-black text-sm shadow-lg shadow-slate-200">
                                            ${item.grade !== null ? item.grade : 'UNGRADED'}
                                        </div>
                                    </td>
                                </tr>
                            `);
                        });
                    }
                }
            });
        }

        function loadNotSubmittedAssignments() {
            const tbody = $('#not-submitted-tbody');
            $.ajax({
                url: `/api/not/assigment/task/${taskCourseId}`,
                method: 'GET',
                success: function(res) {
                    tbody.empty();
                    if (res.data.length === 0) {
                        tbody.append('<tr><td colspan="3" class="py-20 text-center text-slate-300 font-bold uppercase text-[10px] tracking-widest">Seluruh siswa sudah mengumpulkan</td></tr>');
                    } else {
                        res.data.forEach((item, i) => {
                            tbody.append(`
                                <tr>
                                    <td class="text-center text-slate-300 font-black">${i + 1}</td>
                                    <td class="text-slate-400 font-bold italic uppercase tracking-tight">${item.name}</td>
                                    <td class="text-right px-10">
                                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] bg-slate-100 px-3 py-1.5 rounded-lg border">Pending Submission</span>
                                    </td>
                                </tr>
                            `);
                        });
                    }
                }
            });
        }

        loadSubmittedAssignments();
        loadNotSubmittedAssignments();
    });
</script>
@endsection
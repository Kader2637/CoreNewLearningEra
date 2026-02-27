@extends('layouts.admin.app')

@section('page_title', 'Audit Profil Instruktur')

@section('style')
<style>
    .bio-card { background: white; border-radius: 3rem; border: 1px solid #f1f5f9; position: relative; overflow: hidden; }
    .profile-large-frame { width: 140px; height: 140px; border-radius: 3.5rem; border: 6px solid #fff; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); object-fit: cover; flex-shrink: 0; }
    .info-pill { background: #f8fafc; padding: 1.25rem; border-radius: 2rem; border: 1px solid #f1f5f9; display: flex; align-items: center; gap: 1rem; min-width: 0; }
    .course-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .course-card:hover { transform: translateY(-10px); }
    .status-banner { padding: 0.5rem 1.25rem; border-radius: 1rem; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; white-space: nowrap; }
    @keyframes zoomIn { from { opacity: 0; transform: scale(0.9) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    .animate-zoom-in { animation: zoomIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
</style>
@endsection

@section('content')
<div class="mb-10 px-2 flex flex-col md:flex-row md:items-end justify-between gap-6 animate-fade-in text-left">
    <div class="overflow-hidden">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-2 h-6 bg-indigo-600 rounded-full shrink-0"></div>
            <h4 class="text-xl font-black text-slate-900 tracking-tight uppercase italic truncate">Audit Profil: {{ $user->name }}</h4>
        </div>
        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest leading-none">Verifikasi identitas dan performa instruktur dalam sistem</p>
    </div>
    
    <div class="flex items-center gap-3 shrink-0">
        @if ($user->status == 'pending')
            <button class="px-6 md:px-8 py-4 bg-white border-2 border-rose-100 text-rose-500 font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-rose-500 hover:text-white transition-all active:scale-95 reject-button-user" data-id="{{ $user->id }}">Tolak</button>
            <button class="px-6 md:px-8 py-4 bg-indigo-600 text-white font-black uppercase text-[10px] tracking-widest rounded-2xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all active:scale-95 accept-button-user" data-id="{{ $user->id }}">Terima</button>
        @else
            <a href="/admin/teacher" class="px-8 py-4 bg-slate-900 text-white font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-indigo-600 transition-all flex items-center gap-2 shrink-0">
                <i data-feather="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
        @endif
    </div>
</div>

<div class="bio-card p-8 md:p-16 mb-16 shadow-sm">
    <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-50 rounded-full blur-[100px] -mr-32 -mt-32"></div>
    
    <div class="relative z-10 flex flex-col lg:flex-row items-center lg:items-start gap-12 text-left min-w-0">
        <div class="shrink-0 text-center">
            <img src="{{ asset('storage/' . $user->image) }}" class="profile-large-frame shadow-2xl mb-6 mx-auto" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff'">
            <div class="flex justify-center">
                @if ($user->status == 'accept')
                    <span class="status-banner bg-emerald-50 text-emerald-600 border border-emerald-100">Mentor Terverifikasi</span>
                @elseif ($user->status == 'pending')
                    <span class="status-banner bg-amber-50 text-amber-600 border border-amber-100">Menunggu Tinjauan</span>
                @else
                    <span class="status-banner bg-rose-50 text-rose-600 border border-rose-100">Akses Dibatasi</span>
                @endif
            </div>
        </div>

        <div class="flex-1 w-full min-w-0">
            <div class="mb-10">
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 tracking-tighter uppercase leading-none mb-3 break-words">{{ $user->name }}</h2>
                <p class="text-indigo-600 font-bold uppercase text-[11px] tracking-[0.3em] truncate">{{ $user->role }} • Anggota Akademik Sistem</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="info-pill">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 shadow-sm border border-slate-100 shrink-0"><i data-feather="mail" class="w-4 h-4"></i></div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest">Alamat Email</p>
                        <p class="text-sm font-bold text-slate-700 leading-tight truncate">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="info-pill">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 shadow-sm border border-slate-100 shrink-0"><i data-feather="user" class="w-4 h-4"></i></div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest">Jenis Kelamin</p>
                        <p class="text-sm font-bold text-slate-700 leading-tight truncate">{{ $user->gender }}</p>
                    </div>
                </div>
                <div class="info-pill">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 shadow-sm border border-slate-100 shrink-0"><i data-feather="phone" class="w-4 h-4"></i></div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest">No. Telepon</p>
                        <p class="text-sm font-bold text-slate-700 leading-tight truncate">{{ $user->no_telephone }}</p>
                    </div>
                </div>
                <div class="info-pill">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 shadow-sm border border-slate-100 shrink-0"><i data-feather="map-pin" class="w-4 h-4"></i></div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest">Lokasi Domisili</p>
                        <p class="text-sm font-bold text-slate-700 leading-tight truncate">{{ $user->address }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-6 flex items-center gap-3 px-4">
    <div class="w-2 h-2 bg-indigo-600 rounded-full animate-pulse"></div>
    <h4 class="text-sm font-black text-slate-900 uppercase tracking-[0.3em]">Armada Kelas Instruktur</h4>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-20 text-left" id="data-teacher">
    <div class="col-span-full py-20 text-center" id="loading">
        <div class="w-10 h-10 border-4 border-slate-100 border-t-indigo-600 rounded-full animate-spin mx-auto mb-4"></div>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sinkronisasi Data...</p>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        const authId = '{{ $user->id }}';

        const fetchClassData = () => {
            $.ajax({
                url: `/api/classroom/teacher/data/${authId}`,
                method: 'GET',
                success: function(response) {
                    $('#loading').hide();
                    let container = $('#data-teacher');
                    container.empty();

                    if (response.data.length > 0) {
                        response.data.forEach((kelas) => {
                            let statusBadge = kelas.status === 'accept' ? 'bg-emerald-50 text-emerald-600' : (kelas.status === 'reject' ? 'bg-rose-50 text-rose-600' : 'bg-amber-50 text-amber-600');
                            
                            container.append(`
                                <div class="course-card bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm flex flex-col group animate-fade-in min-w-0 overflow-hidden">
                                    <div class="flex justify-between items-start mb-8 shrink-0">
                                        <div class="bg-indigo-50 text-indigo-600 p-4 rounded-2xl shadow-inner"><i data-feather="layers" class="w-6 h-6"></i></div>
                                        <span class="px-3 py-1.5 ${statusBadge} rounded-xl font-black text-[8px] uppercase tracking-widest border border-current opacity-70">${kelas.status}</span>
                                    </div>
                                    <h3 class="text-xl font-black text-slate-900 leading-tight mb-2 group-hover:text-indigo-600 transition-colors uppercase tracking-tighter truncate">${kelas.name}</h3>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-6">Kode: ${kelas.codeClass}</p>
                                    <div class="grid grid-cols-2 gap-4 mt-auto pt-6 border-t border-slate-50">
                                        <div class="min-w-0"><p class="text-[8px] font-black text-slate-300 uppercase tracking-widest">Siswa</p><p class="text-xs font-bold text-slate-700 truncate">${kelas.total_user} / ${kelas.limit}</p></div>
                                        <div class="text-right min-w-0"><p class="text-[8px] font-black text-slate-300 uppercase tracking-widest">Visibilitas</p><p class="text-xs font-bold text-slate-700 uppercase truncate">${kelas.statusClass}</p></div>
                                    </div>
                                    <a href="/admin/classroom/detail/${kelas.id}" class="mt-8 block w-full py-4 bg-slate-900 text-white text-center font-black uppercase text-[9px] tracking-[0.2em] rounded-2xl hover:bg-indigo-600 shadow-lg shadow-indigo-100 transition-all active:scale-95 shrink-0">Inspeksi Kelas</a>
                                </div>
                            `);
                        });
                        feather.replace();
                    } else {
                        container.html('<div class="col-span-full py-20 text-center bg-white rounded-[3rem] border border-dashed border-slate-200 text-slate-300 font-bold uppercase text-[10px]">Belum memiliki data kelas</div>');
                    }
                }
            });
        };

        const handleUserStatus = (userId, type) => {
            const isAccept = type === 'accept';
            Swal.fire({
                title: isAccept ? 'Terima Pengajar?' : 'Tolak Pengajar?',
                text: isAccept ? "Pengajar akan diberikan akses penuh ke fitur sistem." : "Akses pengajar akan dibatasi dan ditolak.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: isAccept ? '#4f46e5' : '#ef4444',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: isAccept ? 'Ya, Terima' : 'Ya, Tolak',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-[2.5rem]',
                    confirmButton: 'rounded-xl font-black uppercase text-[10px] tracking-widest py-4 px-8 mx-2',
                    cancelButton: 'rounded-xl font-black uppercase text-[10px] tracking-widest py-4 px-8 mx-2 text-slate-500'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: isAccept ? `/api/accept/${userId}` : `/api/reject/${userId}`,
                        method: 'POST',
                        success: function() {
                            Swal.fire({ title: 'Berhasil!', text: 'Status telah diperbarui.', icon: 'success', customClass: { popup: 'rounded-[2.5rem]' } })
                            .then(() => location.reload());
                        }
                    });
                }
            });
        };

        $('.accept-button-user').click(function() { handleUserStatus($(this).data('id'), 'accept'); });
        $('.reject-button-user').click(function() { handleUserStatus($(this).data('id'), 'reject'); });

        fetchClassData();
    });
</script>
@endsection
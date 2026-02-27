@extends('layouts.admin.app')

@section('page_title', 'Pusat Verifikasi Sistem')

@section('style')
<style>
    /* Desain Tabel Audit Premium */
    .audit-table th { font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.15em; color: #94a3b8; padding: 1.5rem 1rem; border: none; background: #f8fafc; }
    .audit-table td { padding: 1.25rem 1rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; font-weight: 600; color: #1e293b; font-size: 13px; }
    .table-container { background: white; border-radius: 2.5rem; border: 1px solid #f1f5f9; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05); }
    
    /* Kartu Kelas Modern */
    .course-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); border-radius: 2.5rem; background: white; border: 1px solid #f1f5f9; padding: 1.5rem; display: flex; flex-direction: column; }
    .course-card:hover { transform: translateY(-8px); border-color: #4f46e5; box-shadow: 0 30px 60px -12px rgba(79, 70, 229, 0.1); }
    .thumb-container { aspect-ratio: 16/9; overflow: hidden; border-radius: 1.5rem; position: relative; margin-bottom: 1.5rem; }

    @keyframes zoomIn { from { opacity: 0; transform: scale(0.9) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    .animate-zoom-in { animation: zoomIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
</style>
@endsection

@section('content')
<div class="mb-12 px-2 animate-fade-in text-left">
    <div class="flex items-center gap-3 mb-2">
        <div class="w-2 h-6 bg-indigo-600 rounded-full"></div>
        <h4 class="text-2xl font-black text-slate-900 tracking-tight uppercase italic">Gerbang Verifikasi</h4>
    </div>
    <p class="text-slate-400 text-[11px] font-bold uppercase tracking-widest">Tinjau permohonan akun pengajar dan aktivasi modul kelas baru</p>
</div>

<div class="space-y-24 mb-32">
    <div>
        <div class="flex items-center gap-3 mb-6 px-4">
            <div class="w-2 h-2 bg-indigo-600 rounded-full animate-pulse"></div>
            <h4 class="text-xs font-black text-slate-900 uppercase tracking-[0.3em]">Antrean Verifikasi Guru</h4>
        </div>
        
        <div class="table-container">
            <div class="table-responsive no-scrollbar">
                <table class="w-full text-left audit-table" id="data-table">
                    <thead>
                        <tr>
                            <th class="text-center w-20">No</th>
                            <th>Profil Instruktur</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Kontak</th>
                            <th class="text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td colspan="5" class="py-20 text-center text-slate-400 font-bold uppercase text-[10px] tracking-widest animate-pulse" id="teacher-loader">Memindai Database Pengajar...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center gap-3 mb-8 px-4">
            <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
            <h4 class="text-xs font-black text-slate-900 uppercase tracking-[0.3em]">Persetujuan Modul Kelas</h4>
        </div>
        
        <div id="project-container" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-8">
            </div>
    </div>
</div>

<div id="modal-accept" class="fixed inset-0 z-[1000] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('accept')"></div>
    <div class="relative bg-white w-full max-w-md rounded-[3rem] shadow-2xl animate-zoom-in p-10 text-center">
        <div class="w-20 h-20 bg-emerald-50 text-emerald-500 rounded-3xl flex items-center justify-center mx-auto mb-6">
            <i data-feather="check-circle" class="w-10 h-10"></i>
        </div>
        <h3 class="text-xl font-black text-slate-900 mb-2 uppercase tracking-tighter">Aktifkan Kelas?</h3>
        <p class="text-slate-500 font-medium mb-10 text-sm">Kelas ini akan segera dipublikasikan dan dapat diakses oleh seluruh siswa.</p>
        <form id="form-accept">
            @csrf <input type="hidden" id="AcceptClassId">
            <div class="flex gap-3">
                <button type="button" onclick="closeModal('accept')" class="flex-1 py-4 bg-slate-100 text-slate-600 font-black text-[10px] uppercase rounded-2xl">Batal</button>
                <button type="submit" class="flex-1 py-4 bg-indigo-600 text-white font-black text-[10px] uppercase rounded-2xl shadow-lg shadow-indigo-100">Setujui</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-reject" class="fixed inset-0 z-[1000] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('reject') Hatch()"></div>
    <div class="relative bg-white w-full max-w-md rounded-[3rem] shadow-2xl animate-zoom-in p-10 text-center">
        <div class="w-20 h-20 bg-rose-50 text-rose-500 rounded-3xl flex items-center justify-center mx-auto mb-6">
            <i data-feather="x-circle" class="w-10 h-10"></i>
        </div>
        <h3 class="text-xl font-black text-slate-900 mb-2 uppercase tracking-tighter">Tolak Aktivasi?</h3>
        <p class="text-slate-500 font-medium mb-10 text-sm">Instruktur wajib memperbaiki data modul sebelum mengajukan kembali.</p>
        <form id="form-tolak">
            @csrf <input type="hidden" id="RejectClassId">
            <div class="flex gap-3">
                <button type="button" onclick="closeModal('reject')" class="flex-1 py-4 bg-slate-100 text-slate-600 font-black text-[10px] uppercase rounded-2xl">Batal</button>
                <button type="submit" class="flex-1 py-4 bg-rose-500 text-white font-black text-[10px] uppercase rounded-2xl shadow-lg shadow-rose-100">Tolak</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Kontrol Modal
        window.openModal = function(type, id) {
            $(`#AcceptClassId, #RejectClassId`).val(id);
            $(`#modal-${type}`).removeClass('hidden').addClass('flex');
        };

        window.closeModal = function(type) {
            $(`#modal-${type}`).removeClass('flex').addClass('hidden');
        };

        // Ambil Data Guru
        function fetchInstructors() {
            $.ajax({
                url: '/api/teacher/pending',
                method: 'GET',
                success: function(res) {
                    let tbody = $('#data-table tbody');
                    tbody.empty();
                    if (res.data.length === 0) {
                        tbody.append('<tr><td colspan="5" class="py-20 text-center text-slate-300 font-bold uppercase text-[10px]">Tidak ada permintaan verifikasi</td></tr>');
                    } else {
                        res.data.forEach((item, i) => {
                            const img = item.image ? `/storage/${item.image}` : `https://ui-avatars.com/api/?name=${item.name}&background=random`;
                            tbody.append(`
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="text-center text-slate-400 font-black">#0${i + 1}</td>
                                    <td>
                                        <div class="flex items-center gap-4">
                                            <img class="w-10 h-10 rounded-xl object-cover border-2 border-slate-50" src="${img}" onerror="this.src='https://ui-avatars.com/api/?name=${item.name}'">
                                            <div>
                                                <p class="font-black text-slate-900 leading-none uppercase tracking-tight">${item.name}</p>
                                                <p class="text-[9px] text-indigo-500 font-bold uppercase mt-1 tracking-widest">ID: ${item.id}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><span class="px-3 py-1 bg-slate-100 rounded-lg text-[9px] font-black text-slate-500 uppercase">${item.gender}</span></td>
                                    <td class="text-center text-[11px] font-bold text-slate-500">${item.email}</td>
                                    <td class="text-center">
                                        <a href="/admin/teacher/detail/${item.id}" class="px-5 py-2.5 bg-slate-900 text-white rounded-xl font-black uppercase text-[9px] tracking-widest hover:bg-indigo-600 transition-all shadow-md">Tinjau Akun</a>
                                    </td>
                                </tr>
                            `);
                        });
                    }
                },
                error: function() { $('#teacher-loader').text('Gagal memuat data.'); }
            });
        }

        // Ambil Data Kelas
        function fetchClassrooms() {
            $.ajax({
                url: '/api/approval/classroom',
                method: 'GET',
                success: function(res) {
                    const container = $('#project-container');
                    container.empty();
                    if (res.data.length === 0) {
                        container.html('<div class="col-span-full py-20 text-center bg-white rounded-[3rem] border border-dashed border-slate-200"><p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Antrean kelas saat ini bersih</p></div>');
                    } else {
                        res.data.forEach(item => {
                            const thumb = item.thumbnail ? `/storage/${item.thumbnail}` : '/user.png';
                            container.append(`
                                <div class="course-card group animate-fade-in text-left">
                                    <div class="thumb-container">
                                        <img src="${thumb}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" onerror="this.src='/user.png'">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
                                        <span class="absolute top-4 right-4 px-3 py-1.5 bg-amber-500 text-white font-black text-[8px] uppercase tracking-widest rounded-xl">Menunggu</span>
                                    </div>
                                    <h3 class="text-lg font-black text-slate-900 mb-2 truncate uppercase tracking-tighter">${item.name}</h3>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-6">Oleh: ${item.user}</p>
                                    <div class="mt-auto grid grid-cols-3 gap-2">
                                        <a href="/admin/classroom/detail/${item.id}" class="py-3 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center hover:bg-slate-200 transition-all"><i data-feather="info" style="width:14px"></i></a>
                                        <button onclick="openModal('reject', ${item.id})" class="py-3 bg-rose-50 text-rose-500 rounded-xl flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all"><i data-feather="x" style="width:14px"></i></button>
                                        <button onclick="openModal('accept', ${item.id})" class="py-3 bg-indigo-600 text-white rounded-xl flex items-center justify-center hover:bg-slate-900 transition-all shadow-lg"><i data-feather="check" style="width:14px"></i></button>
                                    </div>
                                </div>
                            `);
                        });
                        feather.replace();
                    }
                }
            });
        }

        // Aksi Submit
        $('#form-accept').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: `/api/acceptClass/${$('#AcceptClassId').val()}`,
                method: 'POST',
                data: $(this).serialize(),
                success: function() {
                    toastr.success('Kelas Berhasil Diaktifkan');
                    closeModal('accept');
                    fetchClassrooms();
                }
            });
        });

        $('#form-tolak').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: `/api/rejectClass/${$('#RejectClassId').val()}`,
                method: 'POST',
                data: $(this).serialize(),
                success: function() {
                    toastr.success('Aktivasi Kelas Ditolak');
                    closeModal('reject');
                    fetchClassrooms();
                }
            });
        });

        fetchInstructors();
        fetchClassrooms();
    });
</script>
@endsection
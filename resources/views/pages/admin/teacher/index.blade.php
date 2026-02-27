@extends('layouts.admin.app')

@section('page_title', 'Mentor Management')

@section('style')
<style>
    .teacher-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .teacher-card:hover { transform: translateY(-8px); border-color: #4f46e5; box-shadow: 0 25px 50px -12px rgba(79, 70, 229, 0.08); }
    .profile-frame { position: relative; width: 100px; height: 100px; margin: 0 auto 1.5rem; }
    .profile-frame img { width: 100%; height: 100%; object-fit: cover; border-radius: 2.5rem; border: 4px solid #f8fafc; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
    .status-badge { position: absolute; bottom: 0; right: 0; width: 24px; height: 24px; background: #10b981; border: 4px solid #fff; border-radius: 50%; }
    
    @keyframes zoomIn {
        from { opacity: 0; transform: scale(0.9) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    .animate-zoom-in { animation: zoomIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
</style>
@endsection

@section('content')
<div class="mb-10 px-2 flex flex-col md:flex-row md:items-end justify-between gap-6 animate-fade-in">
    <div>
        <div class="flex items-center gap-3 mb-2">
            <div class="w-2 h-6 bg-indigo-600 rounded-full"></div>
            <h4 class="text-xl font-black text-slate-900 tracking-tight uppercase italic">Instructor Database</h4>
        </div>
        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest leading-none">Manajemen akses dan verifikasi seluruh pengajar sistem</p>
    </div>
    
    <div class="flex items-center gap-3">
        <div class="px-6 py-3 bg-white rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
            <div class="w-2 h-2 bg-indigo-600 rounded-full animate-pulse"></div>
            <span class="text-[10px] font-black uppercase text-slate-500 tracking-widest">Database Sync Active</span>
        </div>
    </div>
</div>

<div id="teacher-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-20">
    <div class="col-span-full py-24 text-center" id="loading-state">
        <div class="w-12 h-12 border-[3px] border-slate-100 border-t-indigo-600 rounded-full animate-spin mx-auto mb-4"></div>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em]">Retrieving Mentor Records...</p>
    </div>
</div>

<div id="no-data-message" class="hidden py-24 flex flex-col items-center justify-center bg-white rounded-[3rem] border border-dashed border-slate-200 animate-fade-in">
    <img src="{{ asset('no-data.png') }}" class="w-40 opacity-20 mb-6 grayscale" alt="">
    <h4 class="text-lg font-black text-slate-900 tracking-tight">Database Kosong</h4>
    <p class="text-slate-400 text-xs font-medium uppercase tracking-widest mt-1">Tidak ada instruktur yang terdaftar dalam sistem</p>
</div>

@include('components.modal-delete')
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // 1. Fungsi Ambil Data
        const fetchTeachers = () => {
            $('#loading-state').removeClass('hidden');
            $.ajax({
                url: '/api/teacher',
                type: 'GET',
                success: function(res) {
                    $('#loading-state').addClass('hidden');
                    const container = $('#teacher-container');
                    container.empty();

                    if (res.status === 'success' && res.data.length > 0) {
                        $('#no-data-message').addClass('hidden');
                        res.data.forEach(t => {
                            const img = t.image ? `/storage/${t.image}` : '/user.png';
                            container.append(`
                                <div class="teacher-card bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm text-center flex flex-col items-center animate-fade-in group">
                                    <div class="profile-frame">
                                        <img src="${img}" alt="${t.name}" onerror="this.src='/user.png'">
                                        <div class="status-badge shadow-sm"></div>
                                    </div>
                                    
                                    <h5 class="text-lg font-black text-slate-900 leading-tight mb-1 truncate w-full px-4 group-hover:text-indigo-600 transition-colors">${t.name}</h5>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-8 truncate w-full px-4">${t.email}</p>
                                    
                                    <div class="w-full flex gap-3 mt-auto">
                                        <a href="/admin/teacher/detail/${t.id}" class="flex-[2] py-4 bg-slate-900 text-white rounded-2xl font-black uppercase text-[9px] tracking-widest hover:bg-indigo-600 shadow-lg shadow-slate-200 transition-all active:scale-95 flex items-center justify-center gap-2">
                                            <i data-feather="eye" style="width:12px"></i> Detail
                                        </a>
                                        <button onclick="openDeleteModal(${t.id})" class="flex-1 py-4 bg-white border-2 border-red-50 text-red-500 rounded-2xl font-black uppercase text-[9px] tracking-widest hover:bg-red-500 hover:text-white hover:border-red-500 transition-all active:scale-95 flex items-center justify-center">
                                            <i data-feather="trash-2" style="width:12px"></i>
                                        </button>
                                    </div>
                                </div>
                            `);
                        });
                        feather.replace();
                    } else {
                        $('#no-data-message').removeClass('hidden');
                    }
                }
            });
        };

        // 2. Fungsi Kontrol Modal (Manual Tailwind)
        window.openDeleteModal = function(userId) {
            $('#deleteClassId').val(userId);
            $('#modal-delete').removeClass('hidden').addClass('flex');
        };

        window.closeModal = function(type) {
            if(type === 'delete') {
                $('#modal-delete').removeClass('flex').addClass('hidden');
            }
        };

        // 3. Logika Submit Hapus
        $('#form-delete').on('submit', function(e) {
            e.preventDefault();
            const id = $('#deleteClassId').val();
            
            $.ajax({
                url: `/api/user/delete/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    toastr.success('Record Mentor Berhasil Dimusnahkan');
                    closeModal('delete');
                    fetchTeachers();
                },
                error: function() {
                    toastr.error('Otorisasi Gagal!');
                }
            });
        });

        fetchTeachers();
    });
</script>
@endsection
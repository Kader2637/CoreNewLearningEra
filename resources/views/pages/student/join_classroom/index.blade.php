@extends('layouts.student.app')

@section('page_title', 'Eksplorasi Katalog')

@section('style')
<style>
    .course-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .course-card:hover { transform: translateY(-8px); box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); }
    .bg-grid-subtle {
        background-image: linear-gradient(to right, #f1f5f9 1px, transparent 1px),
                          linear-gradient(to bottom, #f1f5f9 1px, transparent 1px);
        background-size: 30px 30px;
    }
</style>
@endsection

@section('content')
<div class="mb-10 bg-white p-8 md:p-12 rounded-[2.5rem] border border-slate-200 bg-grid-subtle shadow-sm overflow-hidden relative" data-aos="fade-down">
    <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-50 blur-[80px] rounded-full -mr-20 -mt-20"></div>
    <div class="relative z-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Katalog <span class="text-indigo-600">Kelas</span></h2>
        <p class="text-slate-500 font-medium mt-2 max-w-lg">Temukan materi terbaik dan bergabunglah dengan komunitas pengembang masa depan.</p>
    </div>
</div>

<div id="classroom-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pb-20">
    <div id="loading-spinner" class="col-span-full py-32 flex flex-col items-center justify-center">
        <div class="w-12 h-12 border-4 border-slate-200 border-t-indigo-600 rounded-full animate-spin mb-4"></div>
        <p class="text-slate-400 font-black text-[10px] uppercase tracking-[0.2em] animate-pulse">Menyiapkan Katalog...</p>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function loadClassrooms() {
        const userId = {{ auth()->user()->id }};
        const list = $('#classroom-list');

        $.ajax({
            url: `/api/join/classroom/${userId}`,
            type: 'GET',
            success: function(response) {
                list.empty();
                let classrooms = response.data;

                if (classrooms.length === 0) {
                    list.append(`
                        <div class="col-span-full py-24 flex flex-col items-center justify-center text-center bg-white border-2 border-dashed border-slate-200 rounded-[3rem]">
                            <img src="{{ asset('no-data.png') }}" class="w-40 mb-6 opacity-50">
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Katalog Kosong</h3>
                            <p class="text-slate-500 text-sm mt-2">Saat ini belum ada kelas baru yang tersedia.</p>
                        </div>
                    `);
                } else {
                    $.each(classrooms, function(index, classroom) {
                        const thumb = classroom.thumbnail ? `/storage/${classroom.thumbnail}` : '/assets/user.png';
                        const userImg = classroom.user_image ? `/storage/${classroom.user_image}` : '/user.png';
                        const desc = classroom.description.length > 80 ? classroom.description.substring(0, 80) + '...' : classroom.description;

                        list.append(`
                            <div class="course-card group bg-white border border-slate-200 rounded-[2.5rem] overflow-hidden flex flex-col h-full hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-500">
                                <div class="relative aspect-video overflow-hidden">
                                    <img src="${thumb}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                                    <div class="absolute top-5 left-5">
                                        <span class="px-3 py-1 bg-white/90 backdrop-blur text-indigo-600 font-black text-[9px] uppercase tracking-widest rounded-lg shadow-sm">Katalog</span>
                                    </div>
                                </div>
                                <div class="p-8 flex flex-col flex-grow">
                                    <h5 class="text-lg font-black text-slate-900 leading-tight group-hover:text-indigo-600 transition-colors">${classroom.name}</h5>
                                    <p class="mt-3 text-slate-500 text-sm font-medium leading-relaxed">${desc}</p>
                                    
                                    <div class="mt-auto pt-8">
                                        <div class="flex items-center gap-3 mb-6">
                                            <img src="${userImg}" class="w-8 h-8 rounded-full border border-slate-100 object-cover">
                                            <div class="flex flex-col">
                                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Instruktur</span>
                                                <span class="text-xs font-bold text-slate-700 mt-1">${classroom.user_name}</span>
                                            </div>
                                        </div>
                                        <button class="join-button flex items-center justify-center gap-2 w-full py-4 bg-slate-900 text-white font-black uppercase text-[10px] tracking-[0.2em] rounded-2xl hover:bg-indigo-600 shadow-lg hover:shadow-indigo-500/30 transition-all active:scale-95" data-id="${classroom.id}">
                                            Daftar Sekarang
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `);
                    });

                    $('.join-button').on('click', function() {
                        const id = $(this).data('id');
                        confirmJoin(id, userId);
                    });
                }
            }
        });
    }

    function confirmJoin(classId, userId) {
        Swal.fire({
            title: 'Konfirmasi Pendaftaran',
            text: 'Permintaan bergabung Anda akan diverifikasi oleh instruktur kelas.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Daftar Sekarang',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl mx-2 transition-all hover:bg-indigo-700',
                cancelButton: 'px-8 py-3 bg-slate-100 text-slate-600 font-bold rounded-xl mx-2 transition-all hover:bg-slate-200'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/api/Apiclassroom/join/${classId}`,
                    type: 'POST',
                    data: { user_id: userId, _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        toastr.success(res.message || 'Pendaftaran berhasil dikirim!');
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message || 'Gagal mendaftar ke kelas.');
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        loadClassrooms();
    });
</script>
@endsection
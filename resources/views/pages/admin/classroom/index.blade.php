@extends('layouts.admin.app')

@section('page_title', 'Classroom Exploration')

@section('style')
<style>
    .course-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .course-card:hover { transform: translateY(-10px); }
    .image-container { aspect-ratio: 16/9; overflow: hidden; border-radius: 1.5rem; }
    .image-container img { transition: transform 0.6s ease; }
    .course-card:hover .image-container img { transform: scale(1.1); }
    
    /* Skeleton Loading Effect */
    .skeleton { background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%); background-size: 200% 100%; animation: loading 1.5s infinite; }
    @keyframes loading { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }
</style>
@endsection

@section('content')
<div class="mb-10 px-2">
    <div class="flex items-center gap-3">
        <div class="w-2 h-6 bg-indigo-600 rounded-full"></div>
        <h3 class="text-xl font-black text-slate-900 tracking-tight uppercase italic">Global Classroom Database</h3>
    </div>
    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mt-2">Memantau seluruh aktivitas pengajaran di sistem</p>
</div>

<div class="container-fluid">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-8" id="classroom-container">
        <div class="col-span-full py-24 text-center" id="loading">
            <div class="w-12 h-12 border-[3px] border-slate-100 border-t-indigo-600 rounded-full animate-spin mx-auto mb-4"></div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em]">Syncing Classrooms...</p>
        </div>
    </div>

    <div id="no-data" class="hidden py-24 flex flex-col items-center justify-center bg-white rounded-[3rem] border border-dashed border-slate-200 animate-fade-in">
        <img src="{{ asset('no-data.png') }}" class="w-40 opacity-20 mb-6 grayscale" alt="">
        <h4 class="text-lg font-black text-slate-900 tracking-tight">Data Belum Tersedia</h4>
        <p class="text-slate-400 text-xs font-medium uppercase tracking-widest mt-1">Belum ada kelas yang dibuat oleh instruktur</p>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        const fetchClassrooms = () => {
            $('#loading').removeClass('hidden');
            
            $.ajax({
                url: '/api/classroom/admin',
                type: 'GET',
                success: function(response) {
                    $('#loading').addClass('hidden');
                    const container = $('#classroom-container');
                    container.empty();

                    if (response.data.length === 0) {
                        $('#no-data').removeClass('hidden');
                    } else {
                        response.data.forEach(function(course) {
                            // Logika Gambar & Deskripsi
                            const courseThumbnail = course.thumbnail ? `/storage/${course.thumbnail}` : '/user.png';
                            const authorImage = course.profile ? `/storage/${course.profile}` : '/user.png';
                            const desc = course.description.length > 90 ? course.description.substring(0, 90) + '...' : course.description;

                            // Logika Kapasitas (Progress Bar)
                            const percent = (course.total_user / course.limit) * 100;
                            const barColor = percent > 90 ? 'bg-rose-500' : (percent > 60 ? 'bg-amber-500' : 'bg-indigo-600');

                            // Logika Status Badges
                            const statusColor = course.status === 'accept' ? 'bg-emerald-50 text-emerald-600' : (course.status === 'reject' ? 'bg-rose-50 text-rose-600' : 'bg-amber-50 text-amber-600');
                            const statusText = course.status === 'accept' ? 'Active' : (course.status === 'reject' ? 'Blocked' : 'Pending');

                            container.append(`
                                <div class="course-card bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10 flex flex-col group animate-fade-in">
                                    <div class="image-container relative mb-6">
                                        <img src="${courseThumbnail}" class="w-full h-full object-cover" onerror="this.src='/user.png'">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
                                        
                                        <div class="absolute top-4 left-4">
                                            <span class="px-3 py-1.5 bg-white/90 backdrop-blur-md rounded-xl text-indigo-600 font-black text-[9px] uppercase tracking-widest shadow-sm border border-white">
                                                ${course.statusClass || 'Public'}
                                            </span>
                                        </div>

                                        <div class="absolute bottom-4 right-4">
                                            <span class="px-3 py-1.5 ${statusColor} rounded-xl font-black text-[9px] uppercase tracking-widest shadow-sm">
                                                ${statusText}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex-grow flex flex-col">
                                        <h3 class="text-lg font-black text-slate-900 leading-tight mb-2 truncate group-hover:text-indigo-600 transition-colors">${course.name}</h3>
                                        
                                        <div class="flex items-center gap-2 mb-4">
                                            <img src="${authorImage}" class="w-6 h-6 rounded-lg object-cover border border-slate-100">
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight truncate">${course.user_name}</p>
                                        </div>

                                        <p class="text-slate-500 text-xs font-medium leading-relaxed mb-6 h-12 overflow-hidden">${desc}</p>

                                        <div class="bg-slate-50 p-4 rounded-2xl mb-6">
                                            <div class="flex justify-between items-center mb-2">
                                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Enrolled Capacity</span>
                                                <span class="text-[10px] font-black text-slate-900">${course.total_user} / ${course.limit}</span>
                                            </div>
                                            <div class="w-full h-1.5 bg-slate-200 rounded-full overflow-hidden">
                                                <div class="${barColor} h-full rounded-full transition-all duration-1000" style="width: ${percent}%"></div>
                                            </div>
                                        </div>

                                        <a href="/admin/classroom/detail/${course.id}" class="mt-auto block w-full py-4 bg-slate-900 text-white text-center font-black uppercase text-[10px] tracking-[0.2em] rounded-2xl hover:bg-indigo-600 shadow-xl shadow-indigo-100 transition-all active:scale-95">
                                            Audit Classroom
                                        </a>
                                    </div>
                                </div>
                            `);
                        });
                        feather.replace();
                    }
                },
                error: function(xhr) {
                    $('#loading').addClass('hidden');
                    toastr.error('System Failure: Gagal menyinkronkan data kelas.');
                }
            });
        };

        fetchClassrooms();
    });
</script>
@endsection
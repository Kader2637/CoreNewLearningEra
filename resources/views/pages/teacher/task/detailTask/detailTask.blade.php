@extends('layouts.teacher.app')

@section('page_title', 'Monitoring Tugas')

@section('style')
<style>
    .table-container { background: white; border-radius: 2rem; border: 1px solid #f1f5f9; overflow: hidden; }
    .custom-table th { font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #64748b; padding: 1.5rem 1rem; border: none; background: #f8fafc; }
    .custom-table td { padding: 1.25rem 1rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; font-weight: 600; color: #1e293b; font-size: 13px; }
    .grade-input { width: 80px; text-align: center; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 0.85rem; padding: 0.5rem; font-weight: 800; color: #4f46e5; transition: all 0.2s; }
    .grade-input:focus { outline: none; border-color: #4f46e5; background: white; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
    
    /* Modal Animation */
    .animate-zoom-in { transform: scale(0.95); opacity: 0; transition: all 0.2s ease-out; }
    .modal-open .animate-zoom-in { transform: scale(1); opacity: 1; }
    
    /* Preview Styles */
    .preview-box { width: 100%; height: 450px; border-radius: 1.5rem; border: 1px solid #e2e8f0; background: #f8fafc; overflow: hidden; position: relative; }
    .preview-box iframe { width: 100%; height: 100%; border: none; }
</style>
@endsection

@section('content')
<div class="mb-8 flex items-center justify-between px-2">
    <div class="flex items-center gap-4 text-left">
        <a href="/teacher/course/detail/{{ $taskCourse->course_id }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-indigo-600 transition-all shadow-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <div>
            <p class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] leading-none mb-1.5">Submission Details</p>
            <h4 class="text-2xl font-black text-slate-900 tracking-tight">{{ $taskCourse->name }}</h4>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-10">
    <div class="lg:col-span-3 bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm">
        <h5 class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Deskripsi Instruksi</h5>
        <p class="text-slate-600 font-medium text-sm leading-relaxed">{{ $taskCourse->description }}</p>
    </div>
    <div class="bg-indigo-600 p-8 rounded-[2.5rem] text-white flex flex-col justify-center shadow-xl shadow-indigo-100">
        <h5 class="text-[10px] font-black uppercase text-indigo-200 tracking-widest mb-2">Tipe Jawaban</h5>
        <p class="text-xl font-black uppercase">{{ $taskCourse->type == 'file' ? '📁 Berkas / ZIP' : '🔗 Tautan Luar' }}</p>
    </div>
</div>

<div class="mb-10">
    <div class="flex items-center gap-3 mb-6 px-2">
        <div class="w-2 h-6 bg-indigo-600 rounded-full"></div>
        <h3 class="text-xl font-black text-slate-900 tracking-tight uppercase">Siswa Sudah Mengumpulkan</h3>
    </div>
    
    <div class="table-container shadow-xl shadow-slate-200/40">
        <table class="w-full text-left custom-table">
            <thead>
                <tr>
                    <th class="text-center w-20">No</th>
                    <th>Nama Lengkap Siswa</th>
                    <th class="text-center">Hasil Pekerjaan</th>
                    <th class="text-center w-40">Beri Nilai</th>
                    <th class="text-right px-10">Opsi</th>
                </tr>
            </thead>
            <tbody id="submitted-tbody"></tbody>
        </table>
    </div>
</div>

<div class="mb-20 opacity-60">
    <div class="flex items-center gap-3 mb-6 px-2">
        <div class="w-2 h-6 bg-slate-400 rounded-full"></div>
        <h3 class="text-xl font-black text-slate-400 tracking-tight uppercase">Belum Mengumpulkan</h3>
    </div>
    <div class="table-container border-dashed border-2">
        <table class="w-full text-left custom-table">
            <tbody id="not-submitted-tbody"></tbody>
        </table>
    </div>
</div>

<div id="modal-preview" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closePreview()"></div>
    <div class="relative bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl overflow-hidden animate-zoom-in">
        <div class="p-8 md:p-10">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 id="preview-student-name" class="text-xl font-black text-slate-900"></h3>
                    <p class="text-[10px] font-black text-indigo-600 uppercase tracking-widest">Detail Penyerahan Tugas</p>
                </div>
                <button onclick="closePreview()" class="w-10 h-10 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center hover:text-slate-900 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div id="preview-body" class="preview-box mb-6">
                </div>

            <div class="flex items-center justify-between bg-slate-50 p-5 rounded-2xl border border-slate-100 mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 bg-indigo-600 rounded-full"></div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Sumber Jawaban Terdeteksi</span>
                </div>
                <a id="external-link" href="#" target="_blank" class="text-indigo-600 font-black text-[10px] uppercase tracking-widest hover:text-indigo-800 transition-all flex items-center gap-1 group">
                    Lihat jawaban lebih jelas
                    <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closePreview()" class="flex-1 py-4 bg-slate-100 text-slate-600 font-black uppercase text-[10px] tracking-widest rounded-2xl">Tutup</button>
                <a id="main-action-btn" href="#" target="_blank" class="flex-[1.5] py-4 bg-indigo-600 text-white font-black uppercase text-[10px] tracking-widest rounded-2xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all text-center"></a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        const taskCourseId = "{{ $taskCourse->id }}";
        const taskType = "{{ $taskCourse->type }}";

        // Logic Modal Preview
        window.openPreview = function(studentName, sourceData) {
            $('#preview-student-name').text(studentName);
            const previewBody = $('#preview-body');
            const mainActionBtn = $('#main-action-btn');
            const externalLink = $('#external-link');
            
            previewBody.empty();

            if (taskType === 'file') {
                const fileUrl = `/storage/${sourceData}`;
                const isPDF = sourceData.toLowerCase().endsWith('.pdf');

                if (isPDF) {
                    // Preview PDF
                    previewBody.html(`<iframe src="${fileUrl}#toolbar=0" class="w-full h-full border-0"></iframe>`);
                    mainActionBtn.text('Buka PDF di Tab Baru').attr('href', fileUrl);
                } else {
                    // ZIP / RAR / Others
                    previewBody.html(`
                        <div class="flex flex-col items-center justify-center h-full p-10 text-center">
                            <div class="w-24 h-24 bg-amber-50 text-amber-500 rounded-[2rem] flex items-center justify-center mb-6 shadow-sm border border-amber-100">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                            </div>
                            <h4 class="text-slate-900 font-black uppercase text-sm tracking-widest">Berkas Terkompresi (ZIP/RAR)</h4>
                            <p class="text-slate-400 text-xs mt-2 max-w-xs leading-relaxed">Siswa melampirkan berkas ZIP/RAR. Berkas ini tidak dapat dibuka di browser, silakan unduh untuk mengeceknya.</p>
                        </div>
                    `);
                    mainActionBtn.text('Unduh Berkas Sekarang').attr('href', fileUrl);
                }
                externalLink.attr('href', fileUrl);

            } else {
                // Tipe Tautan (Link)
                previewBody.html(`
                    <div class="flex flex-col items-center justify-center h-full p-10 text-center">
                        <div class="w-24 h-24 bg-indigo-50 text-indigo-600 rounded-[2rem] flex items-center justify-center mb-6 shadow-sm border border-indigo-100">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.828a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        </div>
                        <h4 class="text-slate-900 font-black uppercase text-sm tracking-widest">Tautan Terdeteksi</h4>
                        <p class="text-indigo-600 font-bold text-[10px] mt-2 truncate w-full px-10">${sourceData}</p>
                    </div>
                `);
                mainActionBtn.text('Kunjungi Tautan Sekarang').attr('href', sourceData);
                externalLink.attr('href', sourceData);
            }

            const modal = $('#modal-preview');
            modal.removeClass('hidden').addClass('flex');
            setTimeout(() => modal.addClass('modal-open'), 10);
        };

        window.closePreview = function() {
            $('#modal-preview').removeClass('modal-open');
            setTimeout(() => $('#modal-preview').removeClass('flex').addClass('hidden'), 200);
        };

        function loadSubmittedAssignments() {
            const tbody = $('#submitted-tbody');
            tbody.html('<tr><td colspan="5" class="py-20 text-center text-slate-400 font-bold animate-pulse uppercase text-[10px] tracking-widest">Sinkronisasi Jawaban...</td></tr>');

            $.ajax({
                url: `/api/done/assigment/task/${taskCourseId}`,
                method: 'GET',
                success: function(res) {
                    tbody.empty();
                    if (res.data.length === 0) {
                        tbody.append('<tr><td colspan="5" class="py-24 text-center text-slate-400 font-bold uppercase text-[10px]">Belum ada data pengumpulan</td></tr>');
                    } else {
                        res.data.forEach((item, i) => {
                            const rawData = taskType === 'file' ? item.file : item.link;
                            tbody.append(`
                                <tr class="hover:bg-slate-50/50 transition-all group">
                                    <td class="text-center text-slate-400 font-black">${i + 1}</td>
                                    <td>
                                        <div class="font-black text-slate-900 group-hover:text-indigo-600 transition-colors">${item.name}</div>
                                        <div class="text-[9px] text-slate-400 uppercase tracking-widest mt-0.5 italic">Submission ID: #${item.id}</div>
                                    </td>
                                    <td class="text-center">
                                        <button onclick="openPreview('${item.name}', '${rawData}')" class="px-5 py-2 bg-slate-900 text-white rounded-xl font-black uppercase text-[9px] tracking-widest hover:bg-indigo-600 transition-all shadow-md active:scale-95">Lihat Jawaban</button>
                                    </td>
                                    <td class="text-center">
                                        <input type="number" name="grade" class="grade-input" value="${item.grade || ''}" placeholder="0" min="0" max="100">
                                    </td>
                                    <td class="text-right px-10">
                                        <button onclick="submitGrade(this, ${item.id})" class="px-6 py-2.5 bg-indigo-600 text-white font-black uppercase text-[10px] tracking-widest rounded-xl hover:bg-slate-900 transition-all shadow-lg shadow-indigo-100">Simpan</button>
                                    </td>
                                </tr>
                            `);
                        });
                    }
                }
            });
        }

        window.submitGrade = function(btn, assignmentId) {
            const $btn = $(btn);
            const grade = $btn.closest('tr').find('input[name="grade"]').val();
            if(!grade) return toastr.warning('Tentukan nilai siswa!');
            
            $btn.prop('disabled', true).html('<div class="w-3 h-3 border-2 border-white border-t-transparent rounded-full animate-spin mx-auto"></div>');

            $.ajax({
                url: `/api/assigment/grade/${assignmentId}`,
                method: 'PATCH',
                data: { grade: grade },
                success: function() {
                    toastr.success('Nilai berhasil direkam');
                    loadSubmittedAssignments();
                },
                error: () => {
                    toastr.error('Terjadi gangguan server');
                    $btn.prop('disabled', false).text('Simpan');
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
                    if (res.data.length > 0) {
                        res.data.forEach((item, i) => {
                            tbody.append(`
                                <tr>
                                    <td class="text-center text-slate-300 font-bold w-20">${i + 1}</td>
                                    <td class="text-slate-400 font-medium">${item.name}</td>
                                    <td class="text-right px-10 text-[9px] font-black uppercase text-slate-300 tracking-widest italic">Awaiting Submission</td>
                                </tr>
                            `);
                        });
                    } else {
                        tbody.append('<tr><td class="py-10 text-center text-slate-400 font-bold uppercase tracking-widest text-[9px]">Semua siswa telah mengumpulkan tugas</td></tr>');
                    }
                }
            });
        }

        loadSubmittedAssignments();
        loadNotSubmittedAssignments();
    });
</script>
@endsection
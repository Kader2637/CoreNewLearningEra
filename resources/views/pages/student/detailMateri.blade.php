@extends('layouts.student.app')

@section('page_title', 'Materi Modul')

@section('style')
<style>
    .nav-tab-active { border-bottom: 3px solid #4f46e5; color: #4f46e5; font-weight: 800; }
    .video-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 2.5rem; background: #000; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3); }
    .video-container iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0; }
    #pdf-canvas { max-width: 100%; height: auto; border-radius: 1.5rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
    .glass-control { background: rgba(15, 23, 42, 0.8); backdrop-blur: 16px; border: 1px solid rgba(255, 255, 255, 0.1); }
</style>
@endsection

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div class="flex items-center gap-4">
        <a href="" id="class-link" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <div>
            <p class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] leading-none mb-1.5">Learning Unit</p>
            <h4 class="text-2xl font-black text-slate-900 tracking-tight" id="class-name1">Memuat Materi...</h4>
        </div>
    </div>
</div>

<div class="mb-10 flex border-b border-slate-200 gap-10">
    <button onclick="switchTab('materi')" id="btn-materi" class="pb-4 text-sm font-bold text-slate-400 nav-tab-active transition-all">Isi Materi</button>
    <button onclick="switchTab('tugas')" id="btn-tugas" class="pb-4 text-sm font-bold text-slate-400 transition-all">Penugasan</button>
</div>

<div id="content-materi" class="tab-content block animate-fade-in">
    <div id="link" class="hidden mb-12"></div>
    
    <div id="document" class="hidden relative w-full mb-12 group min-h-[600px]">
        <div class="flex justify-center bg-slate-100 p-6 md:p-12 rounded-[3rem] border border-slate-200 overflow-x-auto shadow-inner">
            <canvas id="pdf-canvas"></canvas>
        </div>
        
        <div id="pdf-controls" class="absolute right-8 top-1/2 -translate-y-1/2 flex flex-col items-center gap-4 z-50 opacity-0 group-hover:opacity-100 transition-all duration-500 translate-x-4 group-hover:translate-x-0">
            <button id="prev" class="w-14 h-14 glass-control text-white rounded-2xl flex items-center justify-center shadow-2xl hover:bg-indigo-600 transition-all active:scale-90">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            
            <div class="py-5 px-3 bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl border border-slate-100 flex flex-col items-center gap-1 min-w-[60px]">
                <span id="current_page" class="text-sm font-black text-indigo-600">1</span>
                <div class="w-4 h-[1px] bg-slate-200"></div>
                <span id="total_pages" class="text-[10px] font-bold text-slate-400">0</span>
            </div>

            <button id="next" class="w-14 h-14 glass-control text-white rounded-2xl flex items-center justify-center shadow-2xl hover:bg-indigo-600 transition-all active:scale-90">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </div>

    <div id="text" class="bg-white p-10 md:p-16 rounded-[3rem] border border-slate-100 shadow-sm prose prose-indigo max-w-none prose-img:rounded-3xl prose-headings:font-black"></div>
</div>

<div id="content-tugas" class="tab-content hidden animate-fade-in">
    <form id="submit-task-form">
        @csrf
        <input type="hidden" name="task_course_id" id="task_course_id">
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight" id="taskTitle"></h3>
                        <div class="px-5 py-2.5 bg-red-50 text-red-600 rounded-2xl flex items-center gap-2.5 border border-red-100">
                            <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                            <span class="text-[10px] font-black uppercase tracking-[0.1em]" id="deadlineDate"></span>
                        </div>
                    </div>
                    <p class="text-slate-600 font-medium leading-relaxed text-lg" id="taskDescription"></p>
                </div>
                <div id="taskSubmissionContainer"></div>
            </div>

            <div class="space-y-6">
                <div class="bg-slate-900 p-10 rounded-[3rem] text-white relative overflow-hidden shadow-2xl shadow-slate-200">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/20 blur-[60px]"></div>
                    <div class="relative z-10">
                        <h4 class="text-xl font-black mb-3 uppercase tracking-tighter">Submission</h4>
                        <p class="text-slate-400 text-sm font-medium mb-8 leading-relaxed">Pastikan file atau tautan yang Anda kirimkan sudah diperiksa kembali.</p>
                        <div id="form-action-area"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script>
    const courseId = {{ $id }};
    
    function switchTab(tab) {
        $('.tab-content').addClass('hidden');
        $(`#content-${tab}`).removeClass('hidden');
        $('[id^="btn-"]').removeClass('nav-tab-active text-indigo-600').addClass('text-slate-400');
        $(`#btn-${tab}`).addClass('nav-tab-active text-indigo-600').removeClass('text-slate-400');
    }

    function fetchTaskData() {
        $.ajax({
            url: '/api/task/course/' + courseId,
            method: 'GET',
            success: function(res) {
                if (res.status === "success" && res.data.length > 0) {
                    const task = res.data[0];
                    $('#task_course_id').val(task.id);
                    $('#taskTitle').text(task.name);
                    $('#deadlineDate').text(task.deadline_format);
                    $('#taskDescription').text(task.description);

                    $.ajax({
                        url: '/api/Apiassigment/' + task.id,
                        method: 'GET',
                        success: function(assRes) {
                            const container = $('#taskSubmissionContainer');
                            const actionArea = $('#form-action-area');
                            container.empty(); actionArea.empty();

                            if (assRes.status === "success" && assRes.data.length > 0) {
                                const ass = assRes.data[0];
                                const gradeHtml = ass.grade != null ? `
                                    <div class="mt-6 p-6 bg-indigo-50 rounded-[2rem] border border-indigo-100 flex items-center justify-between">
                                        <span class="text-xs font-black text-indigo-700 uppercase tracking-widest">Grade Result</span>
                                        <span class="text-3xl font-black text-indigo-700">${ass.grade}</span>
                                    </div>` : '';

                                container.append(`
                                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex items-center justify-between group">
                                        <div class="flex items-center gap-6">
                                            <div class="w-16 h-16 bg-slate-50 text-3xl flex items-center justify-center rounded-2xl group-hover:bg-indigo-50 transition-all">${task.type === 'file' ? '📂' : '🔗'}</div>
                                            <div>
                                                <p class="text-[10px] font-black text-indigo-600 uppercase tracking-widest mb-1">Status: Terkirim</p>
                                                <h5 class="text-slate-900 font-extrabold text-lg">Pekerjaan Anda telah diunggah</h5>
                                            </div>
                                        </div>
                                        <div class="flex gap-3">
                                            ${ass.grade == null ? `<button type="button" class="delete-assignment w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all shadow-sm" data-id="${ass.id}"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>` : ''}
                                            <a href="${task.type === 'file' ? '/storage/'+ass.file : ass.link}" target="_blank" class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all shadow-sm"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg></a>
                                        </div>
                                    </div>
                                    ${gradeHtml}
                                `);
                            } else {
                                if (task.type === "file") {
                                    actionArea.append(`<div class="mb-6"><label class="block text-[10px] font-black text-slate-500 uppercase mb-3 tracking-widest ml-1">Archive (ZIP/PDF)</label><input type="file" name="file" class="w-full text-xs font-bold text-slate-400 file:mr-4 file:py-3.5 file:px-6 file:rounded-2xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 cursor-pointer transition-all"></div>`);
                                } else {
                                    actionArea.append(`<div class="mb-6"><label class="block text-[10px] font-black text-slate-500 uppercase mb-3 tracking-widest ml-1">URL Submission</label><input type="url" name="link" class="w-full px-6 py-4.5 bg-white/5 border border-white/10 rounded-2xl focus:outline-none focus:border-indigo-500 text-sm font-bold text-white" placeholder="https://github.com/..."></div>`);
                                }
                                actionArea.append(`<button type="button" id="submitTaskButton" class="w-full py-4.5 bg-indigo-600 text-white font-black uppercase text-[10px] tracking-[0.2em] rounded-2xl hover:bg-indigo-500 shadow-xl shadow-indigo-500/20 transition-all active:scale-95">Submit Assignment</button>`);
                            }
                        }
                    });
                }
            }
        });
    }

    $(document).ready(function() {
        fetchTaskData();

        $(document).on('click', '#submitTaskButton', function() {
            const btn = $(this);
            const formData = new FormData($('#submit-task-form')[0]);
            btn.prop('disabled', true).html('<div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin mx-auto"></div>');

            $.ajax({
                url: '/api/assigment/post',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function() {
                    toastr.success('Tugas berhasil dikirim!');
                    fetchTaskData();
                },
                error: () => {
                    toastr.error('Terjadi kesalahan pengiriman.');
                    btn.prop('disabled', false).html('Submit Assignment');
                }
            });
        });

        $(document).on('click', '.delete-assignment', function() {
            if(confirm('Hapus kiriman tugas ini?')) {
                $.ajax({
                    url: '/api/assigment/delete/' + $(this).data('id'),
                    method: 'DELETE',
                    success: function() {
                        toastr.success('Tugas dihapus');
                        fetchTaskData();
                    }
                });
            }
        });

        fetch(`/api/student/course/show/${courseId}`)
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    const course = res.data;
                    $('#class-name1').text(course.name);
                    $('#class-link').attr('href', `/student/classroom/course/${course.classroom_id}`);

                    if (course.type === 'link' && course.link) {
                        const isYoutube = course.link.includes('youtube.com') || course.link.includes('youtu.be');
                        const videoId = isYoutube ? (new URL(course.link).searchParams.get('v') || course.link.split('/').pop()) : null;
                        
                        $('#link').removeClass('hidden').html(isYoutube 
                            ? `<div class="video-container shadow-2xl shadow-indigo-100"><iframe src="https://www.youtube.com/embed/${videoId}" allowfullscreen></iframe></div>`
                            : `<div class="bg-white p-5 rounded-[3rem] border border-slate-100 shadow-2xl overflow-hidden"><iframe src="${course.link}" class="w-full h-[700px] rounded-[2rem]" frameborder="0"></iframe></div>`
                        );
                    } else if (course.type === 'document' && course.document) {
                        $('#document').removeClass('hidden');
                        let pdfDoc = null, pageNum = 1;
                        pdfjsLib.getDocument(`/storage/${course.document}`).promise.then(doc => {
                            pdfDoc = doc;
                            $('#total_pages').text(doc.numPages);
                            renderPage(pageNum);
                        });
                        function renderPage(num) {
                            pdfDoc.getPage(num).then(page => {
                                const canvas = document.getElementById('pdf-canvas');
                                const ctx = canvas.getContext('2d');
                                const viewport = page.getViewport({ scale: 1.5 });
                                canvas.height = viewport.height;
                                canvas.width = viewport.width;
                                page.render({ canvasContext: ctx, viewport: viewport });
                                $('#current_page').text(num);
                            });
                        }
                        $('#prev').click(() => { if (pageNum > 1) { pageNum--; renderPage(pageNum); } });
                        $('#next').click(() => { if (pageNum < pdfDoc.numPages) { pageNum++; renderPage(pageNum); } });
                    } else if (course.type === 'text_course') {
                        $('#text').html(`<h1 class="text-4xl font-black text-slate-900 mb-8">${course.name}</h1><div class="text-slate-600 font-medium text-lg">${course.text_course}</div>`);
                    }
                }
            });
    });
</script>
@endsection
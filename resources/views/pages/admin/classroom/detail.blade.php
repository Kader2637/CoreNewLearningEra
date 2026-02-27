@extends('layouts.admin.app')

@section('page_title', 'Intelijen Ruang Kelas')

@section('style')
<style>
    .tab-btn { position: relative; transition: all 0.3s ease; }
    .tab-btn.active { color: #4f46e5; }
    .tab-btn.active::after { content: ''; position: absolute; bottom: -1px; left: 0; right: 0; height: 2px; background: #4f46e5; }
    .chat-container { height: 600px; scrollbar-width: thin; scrollbar-color: #e2e8f0 transparent; }
    .msg-bubble { max-width: 80%; position: relative; }
    .msg-left .bubble-content { background: #f1f5f9; color: #1e293b; border-radius: 1.5rem 1.5rem 1.5rem 0; }
    .msg-right .bubble-content { background: #4f46e5; color: white; border-radius: 1.5rem 1.5rem 0 1.5rem; }
    .banner-overlay { background: linear-gradient(to top, rgba(15, 23, 42, 0.9), transparent); }
    .animate-zoom-in { transform: scale(0.95); opacity: 0; transition: all 0.2s ease-out; }
    .modal-open .animate-zoom-in { transform: scale(1); opacity: 1; }
</style>
@endsection

@section('content')
<div class="mb-20 animate-fade-in text-left">
    <div class="relative h-[400px] rounded-[3rem] overflow-hidden shadow-2xl mb-10 group">
        <img id="class-thumbnail" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="">
        <div class="absolute inset-0 banner-overlay"></div>
        <div class="absolute bottom-10 left-10 right-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="min-w-0">
                <span class="px-4 py-1.5 bg-indigo-600 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-xl mb-4 inline-block shadow-lg">Mode Audit</span>
                <h2 id="title" class="text-4xl md:text-5xl font-black text-white tracking-tighter uppercase leading-none truncate"></h2>
                <div class="flex items-center gap-3 mt-4">
                    <img id="profileUser" class="w-8 h-8 rounded-full border-2 border-white/20 object-cover shrink-0" src="">
                    <p class="text-white/80 font-bold text-xs uppercase tracking-widest truncate">Instruktur Utama: <span id="nameTeacher" class="text-white"></span></p>
                </div>
            </div>
            <div class="shrink-0">
                <a href="/admin/classroom" class="px-8 py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-white hover:text-slate-900 transition-all shadow-lg active:scale-95">Kembali</a>
            </div>
        </div>
    </div>

    <div class="flex border-b border-slate-200 mb-10 overflow-x-auto no-scrollbar">
        <button onclick="showContent('detail')" id="tab-detail" class="tab-btn active px-8 py-5 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 whitespace-nowrap">Ringkasan</button>
        <button onclick="showContent('materi')" id="tab-materi" class="tab-btn px-8 py-5 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 whitespace-nowrap">Kurikulum</button>
        <button onclick="showContent('siswa')" id="tab-siswa" class="tab-btn px-8 py-5 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 whitespace-nowrap">Siswa Terdaftar</button>
        <button onclick="showContent('discussion')" id="tab-discussion" class="tab-btn px-8 py-5 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 whitespace-nowrap">Diskusi Publik</button>
    </div>

    <div id="main-content">
        <div id="detail-content" class="content-pane space-y-6">
            <div class="bg-white p-12 rounded-[3rem] border border-slate-100 shadow-sm">
                <h3 class="text-xs font-black uppercase text-indigo-600 tracking-[0.3em] mb-6 text-left">Informasi Ruang Kelas</h3>
                <p id="description_classroom" class="text-xl text-slate-600 font-medium leading-relaxed italic text-left"></p>
            </div>
        </div>

        <div id="materi-content" class="content-pane hidden">
            <div id="curriculum-list" class="grid grid-cols-1 gap-4"></div>
        </div>

        <div id="siswa-content" class="content-pane hidden">
            <div id="student-list" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6"></div>
        </div>

        <div id="discussion-content" class="content-pane hidden">
            <div class="bg-white rounded-[3rem] border border-slate-100 shadow-xl overflow-hidden flex flex-col">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/50 px-10">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-[10px] font-black uppercase text-slate-900 tracking-widest">Aliran Global</span>
                    </div>
                </div>
                <div id="kotak-pesan" class="chat-container overflow-y-auto p-10 space-y-6 bg-slate-50/30 shadow-inner"></div>
                <form id="form-pesan" class="p-6 bg-white border-t border-slate-100 flex items-center gap-4 px-10">
                    <input type="text" name="message" id="input-pesan" class="flex-1 px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:border-indigo-600 font-medium transition-all" placeholder="Kirim pesan siaran ke kelas ini...">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="classroom_id" value="{{ $id }}">
                    <button type="submit" class="w-14 h-14 bg-indigo-600 text-white rounded-2xl flex items-center justify-center hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all active:scale-90">
                        <i data-feather="send" class="w-5 h-5"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-kick" class="fixed inset-0 z-[1000] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeKickModal()"></div>
    <div class="relative bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl animate-zoom-in p-10 text-center text-left">
        <h3 class="text-xl font-black text-slate-900 mb-2 uppercase tracking-tighter">Cabut Akses?</h3>
        <p class="text-slate-500 font-medium mb-10 text-sm">Siswa ini akan kehilangan akses ke seluruh materi di kelas ini secara instan.</p>
        <form id="form-kick-student-manual">
            <input type="hidden" id="kickIdStudent" name="student_id">
            <div class="flex gap-3">
                <button type="button" onclick="closeKickModal()" class="flex-1 py-4 bg-slate-100 text-slate-600 font-black text-[10px] rounded-2xl uppercase tracking-widest">Batal</button>
                <button type="submit" class="flex-1 py-4 bg-red-500 text-white font-black text-[10px] rounded-2xl uppercase shadow-lg tracking-widest">Konfirmasi</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    function showContent(paneId) {
        $('.content-pane').addClass('hidden');
        $('.tab-btn').removeClass('active');
        $(`#${paneId}-content`).removeClass('hidden').addClass('animate-fade-in');
        $(`#tab-${paneId}`).addClass('active');
        if(paneId === 'discussion') scrollChatBottom();
    }

    window.openKickModal = function(studentId) {
        $('#kickIdStudent').val(studentId);
        $(`#modal-kick`).removeClass('hidden').addClass('flex');
        setTimeout(() => $(`#modal-kick`).addClass('modal-open'), 10);
    };

    window.closeKickModal = function() {
        $('#modal-kick').removeClass('modal-open');
        setTimeout(() => $('#modal-kick').removeClass('flex').addClass('hidden'), 200);
    };

    $('#form-kick-student-manual').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: `/api/kick/student/${$('#kickIdStudent').val()}`,
            method: 'DELETE',
            data: { _token: '{{ csrf_token() }}' },
            success: function() {
                toastr.success('Akses siswa telah dicabut');
                closeKickModal();
                ambilDataSiswa();
            }
        });
    });

    const classId = '{{ $id }}';
    const userId = '{{ auth()->user()->id }}';

    const ambilDataKelas = () => {
        $.ajax({
            url: `/api/student/classroom/show/${classId}`,
            method: 'GET',
            success: function(res) {
                if (res.status === "success") {
                    const data = res.data;
                    $('#title').text(data.name);
                    $('#description_classroom').text(data.description);
                    $('#class-thumbnail').attr('src', `/storage/${data.thumbnail}`);
                    $('#profileUser').attr('src', data.user.profile ? `/${data.user.profile}` : '/user.png');
                    $('#nameTeacher').text(data.user.name);
                    ambilDataMateri();
                    ambilDataSiswa();
                }
            }
        });
    };

    const ambilDataMateri = () => {
        $.ajax({
            url: `/api/student/course/data/${classId}`,
            method: 'GET',
            success: function(res) {
                const list = $('#curriculum-list'); list.empty();
                if (res.data.length > 0) {
                    res.data.forEach(m => {
                        list.append(`
                            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center justify-between group hover:border-indigo-600 transition-all animate-fade-in text-left">
                                <div class="flex items-center gap-5 min-w-0">
                                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center shrink-0">
                                        <i data-feather="book-open" class="w-5 h-5"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <h5 class="text-sm font-black text-slate-900 uppercase tracking-tight truncate">${m.name}</h5>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest truncate">${m.description.substring(0, 50)}...</p>
                                    </div>
                                </div>
                                <a href="/admin/classroom/detail/course/${m.id}" class="px-6 py-2.5 bg-slate-900 text-white rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-md shrink-0">Inspeksi</a>
                            </div>
                        `);
                    });
                    feather.replace();
                } else {
                    list.html(`
                        <div class="col-span-full py-16 text-center bg-white rounded-[3rem] border border-dashed border-slate-200 animate-fade-in">
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.4em]">Materi Kurikulum Belum Diunggah</p>
                        </div>
                    `);
                }
            }
        });
    };

    const ambilDataSiswa = () => {
        $.ajax({
            url: `/api/student/data/classroom/${classId}`,
            method: 'GET',
            success: function(res) {
                const list = $('#student-list'); list.empty();
                if (res.data.length > 0) {
                    res.data.forEach(s => {
                        const img = s.profile ? `/storage/${s.profile}` : '/user.png';
                        list.append(`
                            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm text-center flex flex-col items-center animate-fade-in group min-w-0">
                                <img src="${img}" class="w-20 h-20 rounded-3xl object-cover mb-4 border-4 border-slate-50 shadow-md shrink-0" onerror="this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(s.name)}&background=random'">
                                <h6 class="text-sm font-black text-slate-900 uppercase tracking-tight truncate w-full">${s.name}</h6>
                                <p class="text-[10px] text-slate-400 font-bold uppercase mb-6 truncate w-full px-4">${s.email}</p>
                                <button onclick="openKickModal(${s.id_relation})" class="w-full py-3 bg-red-50 text-red-500 rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all shadow-sm">Cabut Akses</button>
                            </div>
                        `);
                    });
                } else {
                    list.html(`
                        <div class="col-span-full py-24 flex flex-col items-center justify-center bg-white rounded-[3rem] border border-dashed border-slate-200 animate-fade-in w-full">
                            <img src="{{ asset('no-data.png') }}" class="w-32 opacity-20 mb-6 grayscale" onerror="this.style.display='none'">
                            <h4 class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Belum Ada Siswa Terdaftar Di Kelas Ini</h4>
                        </div>
                    `);
                }
            }
        });
    };

    let lastMessageId = 0;
    const scrollChatBottom = () => {
        const box = $('#kotak-pesan');
        box.scrollTop(box.prop('scrollHeight'));
    };

    function fetchMessages() {
        $.ajax({
            url: `/api/forum/discussion/${classId}?last_message_id=${lastMessageId}`,
            method: 'GET',
            success: function(res) {
                if (res.status === "success" && res.data.length > 0) {
                    res.data.forEach(msg => {
                        if ($(`[data-message-id="${msg.id}"]`).length) return;
                        const isMe = msg.user_id == userId;
                        const alignClass = isMe ? 'msg-right flex-row-reverse' : 'msg-left';
                        const img = msg.user_image ? `/storage/${msg.user_image}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(msg.user_name)}&background=random`;
                        $('#kotak-pesan').append(`
                            <div class="msg flex ${alignClass} items-end gap-3 animate-fade-in text-left" data-message-id="${msg.id}">
                                <img src="${img}" class="w-8 h-8 rounded-full object-cover mb-1 border shadow-sm shrink-0">
                                <div class="msg-bubble flex flex-col ${isMe ? 'items-end' : 'items-start'}">
                                    <div class="px-5 py-3 bubble-content shadow-sm">
                                        <p class="text-[9px] font-black uppercase tracking-widest mb-1 opacity-60">${isMe ? 'Anda' : msg.user_name}</p>
                                        <p class="text-sm font-medium">${msg.message}</p>
                                    </div>
                                    <span class="text-[8px] font-bold text-slate-400 mt-1 uppercase mx-2">${new Date(msg.created_at).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'})}</span>
                                </div>
                            </div>
                        `);
                        lastMessageId = msg.id;
                    });
                    scrollChatBottom();
                }
            }
        });
    }

    $('#form-pesan').submit(function(e) {
        e.preventDefault();
        if(!$('#input-pesan').val()) return;
        $.ajax({
            url: '/api/forum/discussion',
            method: 'POST',
            data: $(this).serialize(),
            success: function() { $('#input-pesan').val(''); fetchMessages(); }
        });
    });

    $(document).ready(function() {
        ambilDataKelas();
        setInterval(fetchMessages, 3000);
    });
</script>
@endsection
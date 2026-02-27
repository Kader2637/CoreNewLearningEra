@extends('layouts.student.app')

@section('page_title', 'Detail Kelas')

@section('style')
<style>
    .nav-tab-active { border-bottom: 3px solid #4f46e5; color: #4f46e5; font-weight: 800; }
    .chat-container { height: calc(100vh - 450px); min-height: 500px; }
    .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-blur: 12px; border: 1px solid rgba(241, 245, 249, 1); }
    .curriculum-item:hover { background-color: #f8fafc; transform: translateX(8px); }
</style>
@endsection

@section('content')
<div class="mb-8 overflow-hidden rounded-[2.5rem] bg-white shadow-sm border border-slate-100" data-aos="fade-up">
    <div class="relative h-64 md:h-80 w-full overflow-hidden">
        <img id="class-thumbnail" class="h-full w-full object-cover" alt="Thumbnail">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
        <div class="absolute bottom-8 left-8 right-8">
            <div class="flex items-center gap-3 mb-4">
                <span class="px-3 py-1 bg-indigo-600 text-white font-black text-[9px] uppercase tracking-widest rounded-lg">Course Detail</span>
                <span class="w-1.5 h-1.5 rounded-full bg-white/40"></span>
                <p id="nameTeacher-top" class="text-white/80 text-xs font-bold uppercase tracking-wider"></p>
            </div>
            <h2 id="title" class="text-3xl md:text-4xl font-black text-white tracking-tight leading-tight"></h2>
        </div>
    </div>
</div>

<div class="mb-10 flex border-b border-slate-200 overflow-x-auto no-scrollbar gap-8">
    <button onclick="switchTab('detail')" id="tab-detail" class="pb-4 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-all whitespace-nowrap nav-tab-active">Informasi Umum</button>
    <button onclick="switchTab('materi')" id="tab-materi" class="pb-4 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-all whitespace-nowrap">Kurikulum Materi</button>
    <button onclick="switchTab('siswa')" id="tab-siswa" class="pb-4 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-all whitespace-nowrap">Teman Sekelas</button>
    <button onclick="switchTab('forum')" id="tab-forum" class="pb-4 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-all whitespace-nowrap">Forum Diskusi</button>
</div>

<div id="content-detail" class="tab-content block animate-fade-in">
    <div class="bg-white p-8 md:p-12 rounded-[2.5rem] border border-slate-100 shadow-sm">
        <h3 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-3">
            <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
            Tentang Kelas Ini
        </h3>
        <p id="description_classroom" class="text-slate-600 leading-relaxed text-lg font-medium"></p>
        
        <div class="mt-12 flex items-center gap-4 p-6 bg-slate-50 rounded-3xl border border-slate-100">
            <img id="profile" class="w-14 h-14 rounded-2xl object-cover shadow-md" alt="Mentor">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">Instruktur Kelas</p>
                <p id="nameTeacher" class="text-slate-900 font-extrabold text-lg"></p>
            </div>
        </div>
    </div>
</div>

<div id="content-materi" class="tab-content hidden">
    <div class="space-y-4" id="curriculum-list"></div>
</div>

<div id="content-siswa" class="tab-content hidden">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="student-list"></div>
</div>

<div id="content-forum" class="tab-content hidden">
    <div class="bg-white border border-slate-200 rounded-[2.5rem] overflow-hidden flex flex-col shadow-2xl">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                <h4 class="font-black text-slate-900 text-sm uppercase tracking-widest">Public Discussion</h4>
            </div>
        </div>
        
        <div id="kotak-pesan" class="chat-container overflow-y-auto p-6 md:p-8 space-y-6 bg-[#fcfcfe]"></div>

        <form id="form-pesan" class="p-6 bg-white border-t border-slate-100 flex items-center gap-4">
            <input type="text" name="message" id="input-pesan" class="flex-1 px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 font-medium transition-all" placeholder="Tulis pesan diskusi di sini...">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="classroom_id" value="{{ $id }}">
            <button type="submit" class="w-14 h-14 bg-indigo-600 text-white rounded-2xl flex items-center justify-center hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all active:scale-95">
                <svg class="w-6 h-6 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    const classId = '{{ $id }}';
    const userId = {{ auth()->user()->id }};

    function switchTab(tab) {
        $('.tab-content').addClass('hidden');
        $(`#content-${tab}`).removeClass('hidden');
        $('.nav-item button, [id^="tab-"]').removeClass('nav-tab-active');
        $(`#tab-${tab}`).addClass('nav-tab-active');
    }

    const ambilDataKelas = () => {
        $.ajax({
            url: `/api/student/classroom/show/${classId}`,
            method: 'GET',
            success: function(res) {
                if (res.status === "success") {
                    const data = res.data;
                    $('#title').text(data.name);
                    $('#description_classroom').text(data.description);
                    $('#class-thumbnail').attr('src', `{{ asset('storage') }}/${data.thumbnail}`);
                    $('#nameTeacher, #nameTeacher-top').text(data.user.name);
                    $('#profile').attr('src', data.user.profile ? `/storage/${data.user.profile}` : '/user.png');
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
                const list = $('#curriculum-list');
                list.empty();
                if (res.status && res.data.length > 0) {
                    res.data.forEach((item, index) => {
                        list.append(`
                            <a href="/student/course/detail/${item.id}" class="curriculum-item group block bg-white border border-slate-100 p-6 rounded-3xl transition-all duration-300 shadow-sm flex items-center justify-between">
                                <div class="flex items-center gap-5">
                                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center font-black text-sm">${index + 1}</div>
                                    <div>
                                        <h5 class="text-slate-900 font-extrabold group-hover:text-indigo-600 transition-colors">${item.name}</h5>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Module Unit</p>
                                    </div>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-300 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                </div>
                            </a>`);
                    });
                }
            }
        });
    };

    const ambilDataSiswa = () => {
        $.ajax({
            url: `/api/student/data/classroom/${classId}`,
            method: 'GET',
            success: function(res) {
                const list = $('#student-list');
                list.empty();
                if (res.status && res.data.length > 0) {
                    res.data.forEach(s => {
                        list.append(`
                            <div class="bg-white p-6 rounded-3xl border border-slate-100 flex items-center gap-4 shadow-sm">
                                <img src="${s.profile ? '/storage/'+s.profile : '/user.png'}" class="w-12 h-12 rounded-full object-cover">
                                <div class="overflow-hidden">
                                    <p class="text-slate-900 font-bold truncate">${s.name}</p>
                                    <p class="text-[10px] font-black text-slate-400 uppercase truncate">${s.email}</p>
                                </div>
                            </div>`);
                    });
                }
            }
        });
    };

    // Chat Logic
    const urlAmbilPesan = `/api/forum/discussion/${classId}`;
    const urlKirimPesan = `/api/forum/discussion`;
    let lastMessageId = 0;

    function ambilPesan() {
        const box = $('#kotak-pesan');
        const shouldScroll = box.scrollTop() + box.innerHeight() >= box[0].scrollHeight;
        $.ajax({
            url: `${urlAmbilPesan}?last_message_id=${lastMessageId}`,
            type: 'GET',
            success: function(res) {
                if (res.status === "success" && res.data.length > 0) {
                    res.data.forEach(msg => {
                        if ($(`[data-message-id="${msg.id}"]`).length) return;
                        const isMe = msg.user_id == userId;
                        const align = isMe ? 'flex-row-reverse' : 'flex-row';
                        const bg = isMe ? 'bg-indigo-600 text-white rounded-br-none' : 'bg-slate-100 text-slate-900 rounded-bl-none';
                        const time = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        const img = msg.user_image ? `/storage/${msg.user_image}` : '/user.png';

                        box.append(`
                            <div class="flex ${align} items-end gap-3 animate-fade-in" data-message-id="${msg.id}">
                                <img src="${img}" class="w-8 h-8 rounded-full object-cover mb-1 shadow-sm">
                                <div class="max-w-[75%]">
                                    <div class="px-5 py-3 rounded-2xl ${bg} shadow-sm">
                                        <p class="text-[10px] font-black opacity-60 uppercase tracking-widest mb-1">${isMe ? 'Anda' : msg.user_name}</p>
                                        <p class="text-sm font-medium leading-relaxed">${msg.message}</p>
                                    </div>
                                    <p class="text-[9px] font-bold text-slate-400 mt-1 mx-2">${time}</p>
                                </div>
                            </div>`);
                        lastMessageId = msg.id;
                    });
                    if (shouldScroll) box.scrollTop(box[0].scrollHeight);
                }
            }
        });
    }

    $('#form-pesan').submit(function(e) {
        e.preventDefault();
        const msg = $('#input-pesan').val();
        if(!msg) return;
        $.ajax({
            url: urlKirimPesan,
            type: 'POST',
            data: $(this).serialize(),
            success: function() {
                $('#input-pesan').val('');
                ambilPesan();
            }
        });
    });

    $(document).ready(function() {
        ambilDataKelas();
        setInterval(ambilPesan, 3000);
    });
</script>
@endsection
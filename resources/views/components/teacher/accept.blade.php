<div id="modal-accept-student" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('accept-student')"></div>
    <div class="relative bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl animate-zoom-in">
        <div class="p-10 text-center">
            <div class="w-20 h-20 bg-green-50 text-green-500 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="text-xl font-black text-slate-900 mb-2">Terima Siswa?</h3>
            <p class="text-slate-500 font-medium mb-10">Siswa akan mendapatkan akses penuh ke seluruh materi kelas.</p>
            <form id="form-accept">
                @csrf
                <input type="hidden" id="acceptStudentId">
                <div class="flex gap-3">
                    <button type="button" onclick="closeModal('accept-student')" class="flex-1 py-4 bg-slate-100 text-slate-600 font-black uppercase text-[10px] tracking-widest rounded-2xl">Batal</button>
                    <button id="btn-accept" type="submit" class="flex-1 py-4 bg-indigo-600 text-white font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-indigo-700 shadow-lg flex items-center justify-center gap-2">
                        <span class="btn-text">Terima Siswa</span>
                        <div class="btn-loading hidden w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
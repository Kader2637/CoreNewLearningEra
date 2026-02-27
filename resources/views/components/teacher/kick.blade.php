<div id="modal-kick-student" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('kick-student')"></div>
    <div class="relative bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl animate-zoom-in">
        <div class="p-10 text-center">
            <div class="w-20 h-20 bg-amber-50 text-amber-600 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h3 class="text-xl font-black text-slate-900 mb-2">Keluarkan Siswa?</h3>
            <p class="text-slate-500 font-medium mb-10">Siswa ini tidak akan bisa lagi mengakses materi di kelas ini.</p>
            <form id="form-kick">
                @csrf
                <input type="hidden" id="kickStudentId">
                <div class="flex gap-3">
                    <button type="button" onclick="closeModal('kick-student')" class="flex-1 py-4 bg-slate-100 text-slate-600 font-black uppercase text-[10px] tracking-widest rounded-2xl">Batal</button>
                    <button type="submit" class="flex-1 py-4 bg-slate-900 text-white font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-red-600 shadow-lg">Keluarkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
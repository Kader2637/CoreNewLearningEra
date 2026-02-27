<div id="modal-reject-student" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('reject-student')"></div>
    <div class="relative bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl animate-zoom-in">
        <div class="p-10 text-center">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="text-xl font-black text-slate-900 mb-2">Tolak Permintaan?</h3>
            <p class="text-slate-500 font-medium mb-10">Permintaan gabung siswa ini akan dihapus dari antrean.</p>
            <form id="form-reject">
                @csrf
                <input type="hidden" id="rejectStudentId">
                <div class="flex gap-3">
                    <button type="button" onclick="closeModal('reject-student')" class="flex-1 py-4 bg-slate-100 text-slate-600 font-black uppercase text-[10px] tracking-widest rounded-2xl">Batal</button>
                    <button id="btn-reject" type="submit" class="flex-1 py-4 bg-red-500 text-white font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-red-600 shadow-lg flex items-center justify-center gap-2">
                        <span class="btn-text">Tolak</span>
                        <div class="btn-loading hidden w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
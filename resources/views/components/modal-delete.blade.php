<div id="modal-delete" class="fixed inset-0 z-[1000] hidden items-center justify-center p-4 transition-all duration-300">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('delete')"></div>
    
    <div class="relative bg-white w-full max-w-md rounded-[3rem] shadow-2xl overflow-hidden animate-zoom-in">
        <div class="p-10 text-center">
            <div class="w-24 h-24 bg-rose-50 text-rose-500 rounded-[2rem] flex items-center justify-center mx-auto mb-8 shadow-inner">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </div>

            <h3 class="text-2xl font-black text-slate-900 mb-3 tracking-tight uppercase italic">Terminate Data?</h3>
            <p class="text-slate-500 font-medium mb-10 leading-relaxed">Tindakan ini tidak dapat dibatalkan. Seluruh informasi terkait akan dihapus permanen dari sistem.</p>
            
            <form id="form-delete">
                @csrf
                <input type="hidden" id="deleteClassId" name="id">
                
                <div class="flex gap-4">
                    <button type="button" onclick="closeModal('delete')" class="flex-1 py-4 bg-slate-100 text-slate-600 font-black uppercase text-[10px] tracking-[0.2em] rounded-2xl hover:bg-slate-200 transition-all active:scale-95">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 py-4 bg-rose-500 text-white font-black uppercase text-[10px] tracking-[0.2em] rounded-2xl hover:bg-rose-600 shadow-lg shadow-rose-200 transition-all active:scale-95">
                        Confirm Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
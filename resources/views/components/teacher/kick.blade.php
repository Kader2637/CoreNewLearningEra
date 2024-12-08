<div class="modal fade" id="modal-kick-student" tabindex="-1" aria-labelledby="modalKickLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form id="form-kick" method="POST">
            @csrf
            <input type="hidden" id="deleteClassId">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="modalKickLabel">
                        Keluarkan Siswa
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Apakah Anda yakin ingin mengeluarkan siswa ini dari kelas?</h5>
                </div>
                <div class="modal-footer">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-danger btn-sm text-white font-medium waves-effect" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button style="background-color: #1B3061" type="submit" class="btn text-white btn-create btn-sm">
                            Keluarkan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

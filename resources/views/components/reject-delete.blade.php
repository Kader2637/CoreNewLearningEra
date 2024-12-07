<div class="modal fade" id="modal-reject" tabindex="-1" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-sm" role="document">
        <form id="form-tolak" method="POST">
            @method('POST')
            @csrf
            <input type="hidden" id="RejectClassId">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="exampleModalLabel1">
                        Tolak Kelas
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Apakah anda yakin ingin Menolak Kelas?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white font-medium waves-effect"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                    <button style="background-color: #1B3061" type="submit" class="btn text-white btn-create">
                        Tolak
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

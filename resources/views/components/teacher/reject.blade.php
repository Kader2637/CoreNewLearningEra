<div class="modal fade" id="modal-reject-student" tabindex="-1" aria-labelledby="modalRejectLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form id="form-reject" method="POST">
            @csrf
            <input type="hidden" id="rejectStudentId">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="modalRejectLabel">
                        Tolak Siswa
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Apakah Anda yakin ingin menolak siswa ini dari kelas?</h5>
                </div>
                <div class="modal-footer">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-danger btn-sm text-white font-medium waves-effect"
                            data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button id="btn-reject" style="background-color: #1B3061" type="submit"
                            class="btn text-white btn-create btn-sm">
                            <span class="btn-text">Tolak</span>
                            <span class="btn-loading" style="display: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    viewBox="0 0 24 24">
                                    <rect width="10" height="10" x="1" y="1" fill="currentColor" rx="1">
                                        <animate id="svgSpinnersBlocksShuffle30" fill="freeze" attributeName="x"
                                            begin="0;svgSpinnersBlocksShuffle3b.end" dur="0.2s" values="1;13" />
                                        <animate id="svgSpinnersBlocksShuffle31" fill="freeze" attributeName="y"
                                            begin="svgSpinnersBlocksShuffle38.end" dur="0.2s" values="1;13" />
                                        <animate id="svgSpinnersBlocksShuffle32" fill="freeze" attributeName="x"
                                            begin="svgSpinnersBlocksShuffle39.end" dur="0.2s" values="13;1" />
                                        <animate id="svgSpinnersBlocksShuffle33" fill="freeze" attributeName="y"
                                            begin="svgSpinnersBlocksShuffle3a.end" dur="0.2s" values="13;1" />
                                    </rect>
                                    <rect width="10" height="10" x="1" y="13" fill="currentColor" rx="1">
                                        <animate id="svgSpinnersBlocksShuffle34" fill="freeze" attributeName="y"
                                            begin="svgSpinnersBlocksShuffle30.end" dur="0.2s" values="13;1" />
                                        <animate id="svgSpinnersBlocksShuffle35" fill="freeze" attributeName="x"
                                            begin="svgSpinnersBlocksShuffle31.end" dur="0.2s" values="1;13" />
                                        <animate id="svgSpinnersBlocksShuffle36" fill="freeze" attributeName="y"
                                            begin="svgSpinnersBlocksShuffle32.end" dur="0.2s" values="1;13" />
                                        <animate id="svgSpinnersBlocksShuffle37" fill="freeze" attributeName="x"
                                            begin="svgSpinnersBlocksShuffle33.end" dur="0.2s" values="13;1" />
                                    </rect>
                                    <rect width="10" height="10" x="13" y="13" fill="currentColor"
                                        rx="1">
                                        <animate id="svgSpinnersBlocksShuffle38" fill="freeze" attributeName="x"
                                            begin="svgSpinnersBlocksShuffle34.end" dur="0.2s" values="13;1" />
                                        <animate id="svgSpinnersBlocksShuffle39" fill="freeze" attributeName="y"
                                            begin="svgSpinnersBlocksShuffle35.end" dur="0.2s" values="13;1" />
                                        <animate id="svgSpinnersBlocksShuffle3a" fill="freeze" attributeName="x"
                                            begin="svgSpinnersBlocksShuffle36.end" dur="0.2s" values="1;13" />
                                        <animate id="svgSpinnersBlocksShuffle3b" fill="freeze" attributeName="y"
                                            begin="svgSpinnersBlocksShuffle37.end" dur="0.2s" values="1;13" />
                                    </rect>
                                </svg> Loading...
                            </span>
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

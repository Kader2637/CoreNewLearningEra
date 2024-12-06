@extends('layouts.teacher.app')
@section('content')
    <div class="container-fluid">
        <!-- Modal Buat Kelas Baru -->
        <div class="modal fade" id="createClassModal" tabindex="-1" aria-labelledby="createClassModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- Tambahkan modal-lg untuk memperbesar modal -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createClassModalLabel">Buat Kelas Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createClassForm" enctype="multipart/form-data">
                            <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">

                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                            </div>

                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1 me-2">
                                    <label for="codeClass" class="form-label">Kode Kelas</label>
                                    <input type="text" class="form-control" id="codeClass" name="codeClass"
                                        placeholder="Masukkan kode kelas">
                                </div>
                                <div class="mt-4">
                                    <input type="checkbox" id="autoGenerateCode" value="1" class="me-2 mt-">
                                    <label for="autoGenerateCode">Otomatis</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="namaKelas" class="form-label">Nama Kelas</label>
                                <input type="text" class="form-control" id="namaKelas" name="name"
                                    placeholder="Masukkan nama kelas">
                            </div>

                            <div class="mb-3">
                                <label for="jumlahSiswa" class="form-label">Jumlah Siswa</label>
                                <input type="number" class="form-control" id="jumlahSiswa" name="limit"
                                    placeholder="Masukkan jumlah siswa">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Kelas</label> <br>
                                <input type="radio" name="statusClass" value="private" id="statusPrivate">
                                <label for="statusPrivate" class="me-2">Private</label>
                                <input type="radio" name="statusClass" value="public" id="statusPublic">
                                <label for="statusPublic">Public</label>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsiKelas" class="form-label">Deskripsi Kelas</label>
                                <textarea class="form-control" id="deskripsiKelas" name="description" rows="3"
                                    placeholder="Masukkan deskripsi kelas"></textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Buat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail Kelas -->
        <div class="modal fade" id="detailClassModal" tabindex="-1" aria-labelledby="detailClassModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailClassModalLabel">Detail Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Kode Kelas:</strong> <span id="detailKodeKelas"></span></p>
                        <p><strong>Nama Kelas:</strong> <span id="detailNamaKelas"></span></p>
                        <p><strong>Jumlah Siswa:</strong> <span id="detailJumlahSiswa"></span></p>
                        <p><strong>Deskripsi:</strong> <span id="detailDeskripsi"></span></p>
                        <p><strong>Thumbnail:</strong></p>
                        <img id="detailThumbnail" src="" alt="Thumbnail" width="100%">
                    </div>
                </div>
            </div>
        </div>

        <!-- Header -->
        <div class="d-lg-flex d-block mb-3 pb-3 border-bottom">
            <div class="card-tabs mb-lg-0 mb-3 me-auto">
                <a class="text-black fs-3">Semua kelas</a>
            </div>
            <div>
                <button type="button" class="btn btn-primary rounded" data-bs-toggle="modal"
                    data-bs-target="#createClassModal">
                    Buat Kelas Baru
                </button>
            </div>
        </div>

        <!-- Filter Berdasarkan Kelas -->
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-3">
                    <label for="filterKelas" class="form-label text-black font-w500">Filter Berdasarkan Kelas:</label>
                    <select id="filterKelas" class="form-select">
                        <option value="all">Semua Kelas</option>
                        <option value="kelasA">Kelas A</option>
                        <option value="kelasB">Kelas B</option>
                        <option value="kelasC">Kelas C</option>
                    </select>
                </div>
                <!-- Tabel Data Kelas -->
                <div class="table-responsive card-table rounded table-hover fs-14">
                    <table class="table border-no display mb-4 dataTablesCard project-bx dataTable no-footer"
                        id="example5" role="grid">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>Thumbnail</th>
                                <th>Nama Kelas</th>
                                <th>Kode Kelas</th>
                                <th>Jumlah Siswa</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="classroom-data">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
@endsection
@section('script')
    <!-- Pastikan Toastr CSS dan JS sudah diimpor di bagian head -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            const fetchClassData = () => {
                const authId = '{{ auth()->user()->id }}';
                $.ajax({
                    url: `/api/classroom/teacher/data/${authId}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        let rows = '';
                        response.data.forEach((kelas, index) => {
                            const thumbnailUrl =
                            `{{ asset('storage') }}/${kelas.thumbnail}`;
                            rows += `
                        <tr class="kelas${index + 1}">
                            <td>${index + 1}</td>
                            <td><img src="${thumbnailUrl}" alt="Thumbnail" width="200px"></td>
                            <td>${kelas.codeClass}</td>
                            <td>${kelas.name}</td>
                            <td>Limit Siswa : ${kelas.limit}</td>
                            <td>${kelas.status}</td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-info me-2 detail-btn"
                                        data-kode="${kelas.codeClass}"
                                        data-nama="${kelas.name}"
                                        data-jumlah="${kelas.limit}"
                                        data-deskripsi="${kelas.description}"
                                        data-thumbnail="${kelas.thumbnail}">Detail</button>
                                    <button type="button" class="btn btn-warning me-2">Edit</button>
                                    <button type="button" class="btn btn-secondary">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    `;
                        });
                        $('#classroom-data').html(rows);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data:", error);
                    }
                });
            };

            fetchClassData();

            $('#createClassForm').on('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: '/api/classroom/teacher',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success('Kelas berhasil dibuat!');
                            $('#createClassModal').modal('hide');
                            fetchClassData();
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Terjadi kesalahan: ' + (xhr.responseJSON?.message ||
                            'Silakan coba lagi.'));
                    }
                });
            });
        });
    </script>
    <script>
        document.querySelectorAll('.detail-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('detailKodeKelas').innerText = this.dataset.kode;
                document.getElementById('detailNamaKelas').innerText = this.dataset.nama;
                document.getElementById('detailJumlahSiswa').innerText = this.dataset.jumlah;
                document.getElementById('detailDeskripsi').innerText = this.dataset.deskripsi;
                document.getElementById('detailThumbnail').src = this.dataset.thumbnail;

                const detailModal = new bootstrap.Modal(document.getElementById('detailClassModal'));
                detailModal.show();
            });
        });

        document.getElementById('filterKelas').addEventListener('change', function() {
            const selectedClass = this.value;
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                if (selectedClass === 'all' || row.classList.contains(selectedClass)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });


        document.getElementById('autoGenerateCode').addEventListener('change', function() {
            const kodeKelasInput = document.getElementById('codeClass');
            if (this.checked) {
                kodeKelasInput.value = generateClassCode();
            } else {
                kodeKelasInput.value = '';
            }
        });

        function generateClassCode() {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = '';
            for (let i = 0; i < 6; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }
    </script>
@endsection

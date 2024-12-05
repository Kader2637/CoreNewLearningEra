@extends('layouts.teacher.app')
@section('content')
<div class="container-fluid">
    <!-- Modal Buat Kelas Baru -->
    <div class="modal fade" id="createClassModal" tabindex="-1" aria-labelledby="createClassModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createClassModalLabel">Buat Kelas Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createClassForm">
                        <div class="mb-2">
                            <label for="kodeKelas" class="form-label">Kode Kelas</label>
                            <input type="text" class="form-control" id="kodeKelas" placeholder="Masukkan kode kelas">
                        </div>
                        <div class="mb-2">
                            <label for="namaKelas" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="namaKelas" placeholder="Masukkan nama kelas">
                        </div>
                        <div class="mb-2">
                            <label for="jumlahSiswa" class="form-label">Jumlah Siswa</label>
                            <input type="number" class="form-control" id="jumlahSiswa" placeholder="Masukkan jumlah siswa">
                        </div>
                        <div class="mb-2">
                            <label for="deskripsiKelas" class="form-label">Deskripsi Kelas</label>
                            <textarea class="form-control" id="deskripsiKelas" rows="3" placeholder="Masukkan deskripsi kelas"></textarea>
                        </div>
                        <div class="mb-2">
                            <label for="thumbnail" class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" id="thumbnail">
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
    <div class="modal fade" id="detailClassModal" tabindex="-1" aria-labelledby="detailClassModalLabel" aria-hidden="true">
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
            <button type="button" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#createClassModal">
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
                <table class="table border-no display mb-4 dataTablesCard project-bx dataTable no-footer" id="example5" role="grid">
                    <thead>
                        <tr role="row">
                            <th>Kode Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Jumlah Siswa</th>
                            <th>Thumbnail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="kelasA">
                            <td>#P-0001</td>
                            <td>Kelas A</td>
                            <td>30</td>
                            <td><img src="path/to/thumbnail.jpg" alt="Thumbnail" width="50"></td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-info me-2 detail-btn" 
                                            data-kode="#P-0001" 
                                            data-nama="Kelas A" 
                                            data-jumlah="30" 
                                            data-deskripsi="Deskripsi Kelas A" 
                                            data-thumbnail="path/to/thumbnail.jpg">Detail</button>
                                    <button type="button" class="btn btn-warning me-2">Edit</button>
                                    <button type="button" class="btn btn-secondary">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        <!-- Data lainnya -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>
    document.querySelectorAll('.detail-btn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('detailKodeKelas').innerText = this.dataset.kode;
            document.getElementById('detailNamaKelas').innerText = this.dataset.nama;
            document.getElementById('detailJumlahSiswa').innerText = this.dataset.jumlah;
            document.getElementById('detailDeskripsi').innerText = this.dataset.deskripsi;
            document.getElementById('detailThumbnail').src = this.dataset.thumbnail;

            const detailModal = new bootstrap.Modal(document.getElementById('detailClassModal'));
            detailModal.show();
        });
    });

    document.getElementById('filterKelas').addEventListener('change', function () {
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
</script>
@endsection

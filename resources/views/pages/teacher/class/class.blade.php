@extends('layouts.teacher.app')
@section('content')
    <style>
        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
        }
    </style>


    <div class="container-fluid">
        <div class="modal fade" id="createClassModal" tabindex="-1" aria-labelledby="createClassModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
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
        <div class="modal fade" id="edit-class-modal" tabindex="-1" aria-labelledby="updateClassModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateClassModalLabel">Update Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateClassForm" enctype="multipart/form-data">
                            <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                            <input type="hidden" id="editClassId" name="class_id">
                            @method('PUT')
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail</label> <br>
                                <img src="" id="img-thumbnail-edit" width="400px" class=""
                                    alt="" srcset="">
                                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                            </div>

                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1 me-2">
                                    <label for="codeClass" class="form-label">Kode Kelas</label>
                                    <input type="text" class="form-control" id="codeClass-edit" name="codeClass"
                                        placeholder="Masukkan kode kelas">
                                </div>
                                <div class="mt-4">
                                    <input type="checkbox" id="autoGenerateCode-edit" value="1" class="me-2 mt-">
                                    <label for="autoGenerateCode-edit">Otomatis</label>
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
                                <input type="radio" name="statusClass" value="private" id="statusPrivate-edit">
                                <label for="statusPrivate" class="me-2">Private</label>
                                <input type="radio" name="statusClass" value="public" id="statusPublic-edit">
                                <label for="statusPublic">Public</label>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsiKelas" class="form-label">Deskripsi Kelas</label>
                                <textarea class="form-control" id="deskripsiKelas" name="description" rows="3"
                                    placeholder="Masukkan deskripsi kelas"></textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailClassModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailClassModalLabel">Detail Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>


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

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive card-table rounded table-hover fs-14">
                    <table class="table table-bordered mb-4 dataTablesCard project-bx dataTable no-footer" id="example5"
                        role="grid">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>Thumbnail</th>
                                <th>Nama Kelas</th>
                                <th>Kode Kelas</th>
                                <th>Jumlah Siswa</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="classroom-data">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Script -->
        @include('components.modal-delete')
    @endsection
    @section('script')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#createClassForm').on('submit', function(event) {
                    event.preventDefault();
                    const formData = new FormData(this);

                    for (let [key, value] of formData.entries()) {
                        console.log(key, value);
                    }

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
                            toastr.error('Terjadi kesalahan saat membuat kelas: ' + (xhr
                                .responseJSON?.message || 'Silakan coba lagi.'));
                        }
                    });
                });

                const fetchClassData = () => {
                    const authId = '{{ auth()->user()->id }}';
                    $.ajax({
                        url: `/api/classroom/teacher/data/${authId}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            let rows = '';
                            if (response.data.length > 0) {
                                response.data.forEach((kelas, index) => {
                                    const thumbnailUrl =
                                        `{{ asset('storage') }}/${kelas.thumbnail}`;
                                    const detailButton = kelas.status === 'accept' ?
                                        `<a href="/teacher/classroom/course/${kelas.id}" class="btn btn-info me-2" data-id="${kelas.id}">Detail</a>` :
                                        ``;

                                    rows += `
                        <tr class="kelas${index + 1}">
                            <td>${index + 1}</td>
                            <td><img src="${thumbnailUrl}" alt="Thumbnail" width="200px"></td>
                            <td>${kelas.codeClass}</td>
                            <td>${kelas.name}</td>
                            <td>Limit Siswa: ${kelas.limit}</td>
                            <td>${kelas.status}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    ${detailButton}
                                    <button type="button" class="btn btn-warning me-2 edit-btn" data-id="${kelas.id}" data-code="${kelas.codeClass}" data-name="${kelas.name}" data-statusClass="${kelas.statusClass}" data-limit="${kelas.limit}" data-description="${kelas.description}" data-thumbnail="${kelas.thumbnail}">Edit</button>
                                    <button type="button" class="btn btn-secondary delete-btn" data-id="${kelas.id}" data-code="${kelas.codeClass}" data-name="${kelas.name}" data-limit="${kelas.limit}" data-description="${kelas.description}" data-thumbnail="${kelas.thumbnail}">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    `;
                                });
                                $('#classroom-data').html(rows);
                                $('#no-data-message').hide();
                            } else {
                                $('#classroom-data').html(`
                    <tr>
                        <td colspan="7" class="text-center">
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('no-data.png') }}" width="200px" alt=""> <br>
                            </div>
                            <h3>Data Masih Kosong</h3>
                        </td>
                    </tr>
                `);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching data:", error);
                        }
                    });
                };
                fetchClassData();

                $('#classroom-data').on('click', '.delete-btn', function() {
                    const classId = $(this).data('id');
                    $('#deleteClassId').val(classId);
                    $('#modal-delete').modal('show');
                });

                $('#classroom-data').on('click', '.edit-btn', function() {
                    const classId = $(this).data('id');
                    const codeClass = $(this).data('code');
                    const name = $(this).data('name');
                    const limit = $(this).data('limit');
                    const description = $(this).data('description');
                    const thumbnail = $(this).data('thumbnail');
                    const statusClass = $(this).data('statusclass');
                    const baseUrl = "{{ asset('storage/') }}/" + thumbnail;

                    $('#editClassId').val(classId);
                    $('#updateClassForm #codeClass-edit').val(codeClass);
                    $('#updateClassForm #namaKelas').val(name);
                    $('#updateClassForm #jumlahSiswa').val(limit);
                    $('#updateClassForm #deskripsiKelas').val(description);
                    $('#updateClassForm #thumbnail').val('');
                    $('#updateClassForm #img-thumbnail-edit').attr('src', baseUrl);

                    if (statusClass === 'private') {
                        $('#statusPrivate-edit').prop('checked', true);
                    } else if (statusClass === 'public') {
                        $('#statusPublic-edit').prop('checked', true);
                    }

                    $('#edit-class-modal').modal('show');
                });


                $('#updateClassForm').on('submit', function(event) {
                    event.preventDefault();

                    const classId = $('#editClassId').val();
                    const formData = new FormData(this);

                    $.ajax({
                        url: `/api/classroom/update/${classId}`,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.message === 'Kelas berhasil diupdate!') {
                                toastr.success('Kelas berhasil diperbarui!');
                                $('#edit-class-modal').modal('hide');
                                fetchClassData();
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Terjadi kesalahan saat memperbarui kelas: ' + (xhr
                                .responseJSON?.message || 'Silakan coba lagi.'));
                        }
                    });
                });

                $('#form-delete').on('submit', function(event) {
                    event.preventDefault();
                    const classId = $('#deleteClassId').val();

                    $.ajax({
                        url: `/api/classroom/delete/${classId}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.message === 'success') {
                                toastr.success('Kelas berhasil dihapus!');
                                $('#modal-delete').modal('hide');
                                fetchClassData();
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Terjadi kesalahan saat menghapus kelas.');
                        }
                    });
                });

                $('#classroom-data').on('click', '.detail-btn', function() {
                    const classId = $(this).data('id');
                    $.ajax({
                        url: `/api/classroom/show/${classId}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            const {
                                codeClass,
                                name,
                                limit,
                                description,
                                thumbnail
                            } = response.data;
                            const thumbnailUrl = `{{ asset('storage') }}/${thumbnail}`;
                            $('#detailModal .modal-body').html(`
                            <div>
                                <img src="${thumbnailUrl}" alt="Thumbnail" class="mb-3 w-100">
                            </div>
                            <p><strong>Kode Kelas:</strong> ${codeClass}</p>
                            <p><strong>Nama Kelas:</strong> ${name}</p>
                            <p><strong>Limit Siswa:</strong> ${limit}</p>
                            <p><strong>Deskripsi:</strong> ${description}</p>
                        `);
                            $('#detailModal').modal('show');
                        },
                        error: function(xhr) {
                            toastr.error('Gagal memuat detail kelas.');
                        }
                    });
                });
            });
        </script>

        <script>
            document.getElementById('autoGenerateCode').addEventListener('change', function() {
                const kodeKelasInput = document.getElementById('codeClass');
                if (this.checked) {
                    kodeKelasInput.value = generateClassCode();
                } else {
                    kodeKelasInput.value = '';
                }
            });
            document.getElementById('autoGenerateCode-edit').addEventListener('change', function() {
                const kodeKelasInput = document.getElementById('codeClass-edit');
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

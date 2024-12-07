@extends('layouts.teacher.app')
@section('content')

<div class="d-flex justify-content-between mb-3">
    <h4>Detail Kelas <span id="class-name1"></span></h4>
    <div>
        <a href="{{ route('classroom.teacher') }}" class="btn btn-secondary btn-sm" >Kembali</a>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="class-profile card card-body px-3 pt-3 pb-0">
                <div class="class-header">
                    <div class="class-photo-content">
                        <div class="cover-photo"></div>
                    </div>
                    <div class="class-info">
                        <div class="cover-photo" style="width: 100%; overflow: hidden;">
                            <img src="" id="class-thumbnail" class="img-fluid rounded" alt="Class Thumbnail"
                                style="object-fit: contai; width: 100%; height: 300px;">
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <h4 class="text-center" id="class-name">Loading class name...</h4>
                        <p id="class-description" style="text-align: justify;">Loading description...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <h4>Materi</h4>
        <div>
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addMaterialModal">Tambah Materi</button>
        </div>
    </div>

    <!-- Card Container for Course Materials -->
    <div id="materialCards" class="row mt-4 mb-5"></div>

    <!-- Modal -->
    <div class="modal fade" id="addMaterialModal" tabindex="-1" aria-labelledby="addMaterialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMaterialModalLabel">Tambah Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="materialForm">
                        <div class="mb-3">
                            <input type="hidden" name="classroom_id" value="{{ $id }}">
                            <label for="materialName" class="form-label">Nama Materi</label>
                            <input type="text" class="form-control" id="materialName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="materialDescription" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="materialDescription" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="materialType" class="form-label">Tipe Materi</label>
                            <select class="form-select" id="materialType" name="type" required>
                                <option value="">Pilih Tipe</option>
                                <option value="document">Dokumen</option>
                                <option value="link">Link</option>
                                <option value="text_course">Text Course</option>
                            </select>
                        </div>
                        <div id="additionalInput"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="materialForm">Simpan Materi</button>
                </div>
            </div>
        </div>
    </div>
    @include('components.modal-delete')
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const classId = '{{ $id }}';

        function showAlert(message, type) {
            Swal.fire({
                icon: type,
                title: message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        }

        const fetchClassData = () => {
            $.ajax({
                url: `/api/teacher/classroom/show/${classId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === "success") {
                        const classData = response.data;
                        $('#class-name1').text(classData.name);
                        $('#class-name').text(classData.name);
                        $('#class-description').text(classData.description);
                        const thumbnailUrl = `{{ asset('storage') }}/${classData.thumbnail}`;
                        $('#class-thumbnail').attr('src', thumbnailUrl);
                    }
                },
                error: function(xhr, status, error) {
                    $('#class-name').text('Error loading class data');
                }
            });
        };

        const fetchMaterials = () => {
            $.ajax({
                url: `/api/teacher/course/data/${classId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    const materialCards = $('#materialCards');
                    materialCards.empty();

                    if (response.status === true && response.data.length > 0) {
                        const materials = response.data;

                        materials.forEach(material => {
                            const truncatedDescription = material.description.length > 100 ?
                                material.description.substring(0, 97) + '...' : material
                                .description;

                            const card = `
                        <div class="col-lg-4 mb-3" id="material-${material.id}">
                            <div class="card d-flex flex-column" style="height: 100%;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">${material.name}</h5>
                                    <p class="card-text flex-grow-1">${truncatedDescription}</p>
                                    <div class="d-flex justify-content-end mt-2 gap-2">
                                        <button type="button" class="btn btn-warning btn-sm" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="white" d="m19.71 8.04l-2.34 2.33l-3.75-3.75l2.34-2.33c.39-.39 1.04-.39 1.41 0l2.34 2.34c.39.37.39 1.02 0 1.41M3 17.25L13.06 7.18l3.75 3.75L6.75 21H3zM16.62 5.04l-1.54 1.54l2.34 2.34l1.54-1.54zM15.36 11L13 8.64l-9 9.02V20h2.34z"/></svg>
                                        </button>
                                        <button class="btn btn-danger btn-sm" title="Hapus" onclick="openDeleteModal(${material.id})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="white" d="M18 19a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V7H4V4h4.5l1-1h4l1 1H19v3h-1zM6 7v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V7zm12-1V5h-4l-1-1h-3L9 5H5v1zM8 9h1v10H8zm6 0h1v10h-1z"/></svg>
                                        </button>
                                        <a href="/teacher/course/detail/${material.id}" class="btn btn-info btn-sm" title="Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M9 7V5H4v5h2v1H3V4h7v3zm4 14v-3h1v2h5v-5h-2v-1h3v7zM8 9h7v7H8zm1 1v5h5v-5z"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                            materialCards.append(card);
                        });
                    } else {
                        materialCards.append(`
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('no-data.png') }}" width="200px" alt=""> <br>
                    </div>
                    <h3 class="text-center">Data Masih Kosong</h3>
                `);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        };

        function openDeleteModal(id) {
            $('#deleteClassId').val(id);
            $('#modal-delete').modal('show');
        }

        $('#form-delete').on('submit', function(e) {
            e.preventDefault();
            const id = $('#deleteClassId').val();
            $.ajax({
                url: `/api/teacher/course/delete/${id}`,
                method: 'DELETE',
                success: function(response) {
                    if (response.message === 'success') {
                        $(`#material-${id}`).remove();
                        showAlert("Materi berhasil dihapus", 'success');
                        $('#modal-delete').modal('hide');
                    } else {
                        showAlert("Gagal menghapus materi", 'error');
                    }
                },
                error: function() {
                    showAlert("Terjadi kesalahan saat menghapus materi", 'error');
                }
            });
        });

        $('#materialForm').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: '/api/teacher/course/create',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success === true) {
                        showAlert(response.message, 'success');
                        $('#addMaterialModal').modal('hide');
                        $('#materialForm')[0].reset();
                        fetchMaterials();
                    } else {
                        showAlert(response.message || "Gagal menambahkan materi", 'error');
                    }
                },
                error: function(xhr) {
                    console.error("Error in submission:", xhr);
                    const errors = xhr.responseJSON.errors;
                    if (errors) {
                        let errorMessage = 'Kesalahan validasi:\n';
                        for (const key in errors) {
                            errorMessage += errors[key].join(', ') + '\n';
                        }
                        showAlert(errorMessage, 'error');
                    } else {
                        showAlert('Terjadi kesalahan', 'error');
                    }
                }
            });
        });
        $(document).ready(function() {
            fetchClassData();
            fetchMaterials();

            document.getElementById('materialType').addEventListener('change', function() {
                const additionalInput = document.getElementById('additionalInput');
                additionalInput.innerHTML = '';
                const type = this.value;
                if (type === 'document') {
                    additionalInput.innerHTML = `
                    <div class="mb-3">
                        <label for="materialDocument" class="form-label">Upload Dokumen (PDF)</label>
                        <input type="file" class="form-control" id="materialDocument" name="document" accept=".pdf" required>
                    </div>`;
                } else if (type === 'link') {
                    additionalInput.innerHTML = `
                    <div class="mb-3">
                        <label for="materialLink" class="form-label">URL Link</label>
                        <input type="url" class="form-control" id="materialLink" name="link" required>
                    </div>`;
                } else if (type === 'text_course') {
                    additionalInput.innerHTML = `
                    <div class="mb-3">
                        <label for="materialText" class="form-label">Text Course</label>
                        <textarea class="form-control" id="materialText" name="text_course" rows="3" required></textarea>
                    </div>`;
                }
            });
        });
    </script>
@endsection

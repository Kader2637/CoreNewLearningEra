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

    const ambilDataSiswa = () => {
        $.ajax({
            url: `/api/teacher/data/classroom/${classId}`,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.status) {
                    const daftarSiswa = response.data;
                    const kontainerSiswa = $('#student-list');
                    kontainerSiswa.empty();
                    if (daftarSiswa.length > 0) {
                        daftarSiswa.forEach(siswa => {
                            kontainerSiswa.append(`
                        <div class="col-xl-4 col-xxl-6 col-sm-6">
                            <div class="card contact-bx">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="image-bx me-3 me-lg-2 me-xl-3">
                                            <img src="${siswa.profile || '{{ asset('user.png') }}'}" alt="" class="rounded-circle" width="70">
                                            <span class="active"></span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="fs-20 font-w600 mb-0">
                                                <a href="javascript:void(0)" class="text-black">${siswa.name}</a>
                                            </h6>
                                            <p class="fs-14">${siswa.email}</p>
                                            <div class="d-flex justify-content-end mt-2 gap-2">
                                                <button type="button" class="btn btn-danger btn-sm" title="Keluarkan" data-id="${siswa.id_relation}" onclick="openKickModal(${siswa.id_relation})">
Keluarkan
</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                        });
                    } else {
                        kontainerSiswa.append(`
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('no-data.png') }}" width="200px" alt=""> <br>
                    </div>
                    <h3 class="text-center">Data Masih Kosong</h3>
                `);
                    }
                } else {
                    $('#student-list').append('<p>Error memuat data siswa</p>');
                }
            },
            error: function(xhr, status, error) {
                $('#student-list').append('<p>Error memuat data siswa</p>');
            }
        });
    };

    const ambilDataSiswaPending = () => {
        $.ajax({
            url: `/api/pending/teacher/${classId}`,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                const kontainerSiswaPending = $('#student-pending');
                kontainerSiswaPending.empty();

                if (response.status && response.data.length > 0) {
                    response.data.forEach(siswa => {
                        kontainerSiswaPending.append(`
                <div class="col-xl-4 col-xxl-6 col-sm-6" id="teacher-${siswa.id}">
                    <div class="card contact-bx">
                        <div class="card-body">
                            <div class="media">
                                <div class="image-bx me-3 me-lg-2 me-xl-3">
                                    <img src="${siswa.profile || '{{ asset('user.png') }}'}" alt="" class="rounded-circle" width="70">
                                    <span class="active"></span>
                                </div>
                                <div class="media-body">
                                    <h6 class="fs-20 font-w600 mb-0">
                                        <a href="javascript:void(0)" class="text-black">${siswa.name}</a>
                                    </h6>
                                    <p class="fs-14">${siswa.email}</p>
                                    <div class="d-flex justify-content-end mt-2 gap-2">
                                        <button type="button" class="btn btn-danger btn-sm" title="Tolak" data-id="${siswa.id}">
                                            Tolak
                                        </button>
                                        <button type="button" class="btn btn-info btn-sm" title="Terima" data-id="${siswa.id}">
                                            Terima
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `);
                    });

                    $('.btn-info').on('click', function() {
                        const siswaId = $(this).data('id');
                        $('#acceptStudentId').val(siswaId);
                        $('#modal-accept-student').modal('show');
                    });

                    $('.btn-danger').on('click', function() {
                        const siswaId = $(this).data('id');
                        $('#rejectStudentId').val(siswaId);
                        $('#modal-reject-student').modal('show');
                    });
                } else {
                    kontainerSiswaPending.append(`
            <div class="d-flex justify-content-center">
                <img src="{{ asset('no-data.png') }}" width="200px" alt=""> <br>
            </div>
            <h3 class="text-center">Data Masih Kosong</h3>
            `);
                }
            },
            error: function(xhr, status, error) {
                $('#student-pending').append('<p>Error memuat data siswa</p>');
            }
        });
    };

    $('#form-accept').on('submit', function(e) {
        e.preventDefault();
        const siswaId = $('#acceptStudentId').val();

        $.ajax({
            url: `/api/accept/teacher/${siswaId}`,
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
            },
            success: function(response) {
                if (response.status === 'success') {
                    showAlert(response.message, 'success');
                    $('#modal-accept-student').modal('hide');
                    ambilDataSiswaPending();
                    ambilDataSiswa();
                } else {
                    showAlert(response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                let errorMessage = "Terjadi kesalahan. Silakan coba lagi.";
                try {
                    const errorResponse = JSON.parse(xhr.responseText);
                    if (errorResponse.message) {
                        errorMessage = errorResponse.message;
                    }
                } catch (e) {}
                showAlert(errorMessage, 'error');
            }
        });
    });


    $('#form-reject').on('submit', function(e) {
        e.preventDefault();
        const siswaId = $('#rejectStudentId').val();

        $.ajax({
            url: `/api/reject/teacher/${siswaId}`,
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
            },
            success: function(response) {
                if (response.status) {
                    showAlert("Siswa berhasil ditolak.", 'success');
                    $('#modal-reject-student').modal('hide');
                    ambilDataSiswaPending();
                } else {
                    showAlert("Gagal menolak siswa.", 'error');
                }
            },
            error: function(xhr, status, error) {
                showAlert("Terjadi kesalahan.", 'error');
            }
        });
    });


    const openKickModal = (studentId) => {
        $('#deleteClassId').val(studentId);
        $('#modal-kick-student').modal('show');
    };

    $('#form-kick').submit(function(e) {
        e.preventDefault();
        const studentId = $('#deleteClassId').val();

        $.ajax({
            url: `/api/kick/student/${studentId}`,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                showAlert("Siswa berhasil di Keluarkan", 'success');
                $('#modal-kick-student').modal('hide');
                ambilDataSiswa();
            },
            error: function(xhr, status, error) {
                console.error('Error mengeluarkan siswa:', error);
                showAlert("Gagal mengeluarkan siswa", 'error');
            }
        });
    });


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
        ambilDataSiswa();
        ambilDataSiswaPending();

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

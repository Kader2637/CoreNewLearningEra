@extends('layouts.teacher.app')

@section('content')
    <div class="mb-3 d-flex justify-content-between">
        <h4>Detail Materi dan Tugas <span id="class-name1"></span></h4>
        <div>
            <a id="back-button" href="#" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </div>

    <ul class="nav nav-tabs" id="tabContent" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="materi-tab" data-bs-toggle="pill" href="#materi" role="tab"
                aria-controls="materi" aria-selected="true">Materi</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tugas-tab" data-bs-toggle="pill" href="#tugas" role="tab" aria-controls="tugas"
                aria-selected="false">Tugas</a>
        </li>
    </ul>

    <div class="mt-3 tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="materi" role="tabpanel" aria-labelledby="materi-tab">
            <div id="link" style="display: none;"></div>
            <div id="document" style="display: none; position: relative; width: 100%; overflow: hidden;">
                <div class="mb-5 container-fluid d-flex justify-content-center">
                    <canvas id="pdf-canvas" style="width: 1100px; height: auto;"></canvas>
                </div>
                <div id="pdf-controls"
                    style="position: fixed; top: 50%; right: 20px; transform: translateY(-50%); display: flex; flex-direction: column; align-items: center;">
                    <button id="prev"
                        style="width: 80px; height: 80px; margin-bottom: 10px; background-color: rgba(128, 128, 128, 0.5); color: white; border: none; border-radius: 50%; cursor: pointer; display: none;">
                        <img src="https://img.icons8.com/material-outlined/40/ffffff/chevron-left.png" alt="Previous" />
                    </button>
                    <button id="next"
                        style="width: 80px; height: 80px; background-color: rgba(128, 128, 0.5); color: white; border: none; border-radius: 50%; cursor: pointer; display: none;">
                        <img src="https://img.icons8.com/material-outlined/40/ffffff/chevron-right.png" alt="Next" />
                    </button>
                </div>
            </div>
            <div id="text"></div>
        </div>

        <div class="tab-pane fade" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
            <div class="d-flex justify-content-between mb-4">
                <h4>
                    Data Tugas
                </h4>
                <button class="btn btn-info btn-sm" id="createTask" data-bs-toggle="modal" data-bs-target="#addTaskModal">Tambah
                    Tugas</button>
            </div>
            <div id="tasks-list" class="">
                <p id="loading-message">Loading tasks...</p>
                <div id="tasks-container" class="row"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Tambah Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTaskForm">
                        <input type="hidden" name="course_id" value="{{ $id }}">
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label>Judul tugas</label>
                                <input type="text" class="form-control" id="task-title" name="name"
                                    placeholder="Judul Tugas" required style="border: 1px solid #ddd; border-radius: 4px;">
                            </div>
                            <div class="mb-3 col-6">
                                <label>Deadline</label>
                                <input type="datetime-local" class="form-control" id="task-deadline" name="deadline"
                                    required style="border: 1px solid #ddd;  border-radius: 4px;">
                            </div>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="">Type Pengumpulan</label>
                            <select name="type" id="task-type" class="form-select" required>
                                <option value="" disabled selected>Pilih type pengumpulan tugas</option>
                                <option value="file">File (Dokumen)</option>
                                <option value="link">Link</option>
                            </select>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="" class="mb-1">Deskripsi</label>
                            <textarea name="description" id="task-description" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="addTaskForm">Tambah</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Tugas -->
    <div class="modal fade" id="updateTaskModal" tabindex="-1" aria-labelledby="updateTaskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateTaskModalLabel">Update Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateTaskForm">
                        @method('PUT')
                        <input type="hidden" name="course_id" value="{{ $id }}">
                        <input type="hidden" id="update-task-id" name="task_id">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label>Judul tugas</label>
                                <input type="text" class="form-control" id="update-task-title" name="name"
                                    placeholder="Judul Tugas" required
                                    style="border: 1px solid #ddd; border-radius: 4px;">
                            </div>
                            <div class="col-6 mb-3">
                                <label>Deadline</label>
                                <input type="datetime-local" class="form-control" id="update-task-deadline"
                                    name="deadline" required style="border: 1px solid #ddd; border-radius: 4px;">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="">Type Pengumpulan</label>
                            <select name="type" id="update-task-type" class="form-select" required>
                                <option value="" disabled selected>Pilih type pengumpulan tugas</option>
                                <option value="file">File (Dokumen)</option>
                                <option value="link">Link</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="" class="mb-1">Deskripsi</label>
                            <textarea name="description" id="update-task-description" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="updateTaskForm">Update</button>
                </div>
            </div>
        </div>
    </div>

    @include('components.modal-delete')
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const courseId = {{ $id }};
            const loadingMessage = document.getElementById('loading-message');
            const tasksContainer = $('#tasks-container');

            function fetchTasks() {
                loadingMessage.style.display = 'block';
                tasksContainer.empty();
                $.ajax({
                    url: `/api/task/course/${courseId}`,
                    method: 'GET',
                    success: function(data) {
                        loadingMessage.style.display = 'none';
                        if (data.status === 'success' && data.data.length > 0) {
                            $('#createTask').hide();
                            $.each(data.data, function(index, task) {
                                const taskDescription = task.description ? task.description
                                    .substring(0, 1000) + (task.description.length > 1000 ?
                                        '...' : '') : 'No description available';
                                const taskCard = `
                                    <div class="mb-3 col-12" id="task-${task.id}">
                                        <div class="card shadow-sm border-light rounded-3">
                                            <div class="card-body d-flex flex-column p-3">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="card-title text-uppercase font-weight-bold text-primary">${task.name}</h5>
                                                    <p>
                                                        Deadline : ${task.deadline_format}
                                                    </p>
                                                </div>
                                                <p class="card-text text-muted" style="font-size: 0.9em;">${taskDescription}</p>
                                                <div class="d-flex justify-content-end gap-2 mt-1">
                                                    <button type="button" class="btn btn-warning btn-sm edit-task-btn" data-id="${task.id}" data-name="${task.name}" data-description="${task.description || ''}" data-deadline="${task.deadline || ''}" data-type="${task.type || ''}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                            <path fill="white" d="m19.71 8.04l-2.34 2.33l-3.75-3.75l2.34-2.33c.39-.39 1.04-.39 1.41 0l2.34 2.34c.39.37.39 1.02 0 1.41M3 17.25L13.06 7.18l3.75 3.75L6.75 21H3zM16.62 5.04l-1.54 1.54l2.34 2.34l1.54-1.54zM15.36 11L13 8.64l-9 9.02V20h2.34z"/>
                                                        </svg>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-task-btn" title="Hapus" data-id="${task.id}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                            <path fill="white" d="M18 19a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V7H4V4h4.5l1-1h4l1 1H19v3h-1zM6 7v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V7zm12-1V5h-4l-1-1h-3L9 5H5v1zM8 9h1v10H8zm6 0h1v10h-1z"/>
                                                        </svg>
                                                    </button>
                                                    <a href="/teacher/detailTask/${task.id}" class="btn btn-info btn-sm" title="Detail">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M9 7V5H4v5h2v1H3V4h7v3zm4 14v-3h1v2h5v-5h-2v-1h3v7zM8 9h7v7H8zm1 1v5h5v-5z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                tasksContainer.append(taskCard);
                            });
                        } else {
                            $('#createTask').show();
                            tasksContainer.append('<p>No tasks available.</p>');
                        }
                    },
                    error: function() {
                        loadingMessage.style.display = 'none';
                        tasksContainer.append('<p>Error loading tasks.</p>');
                    }
                });
            }

            function openDeleteModal(taskId) {
                $('#deleteClassId').val(taskId);
                $('#modal-delete').modal('show');
            }

            $('#form-delete').on('submit', function(event) {
                event.preventDefault();
                const taskId = $('#deleteClassId').val();

                $.ajax({
                    url: `/api/task/course/delete/${taskId}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#modal-delete').modal('hide');
                            fetchTasks();
                            showAlert('Data berhasil dihapus!', 'success');
                        } else {
                            showAlert('Gagal menghapus data.', 'danger');
                        }
                    },
                    error: function() {
                        showAlert('Error saat menghapus data.', 'danger');
                    }
                });
            });

            $(document).on('click', '.edit-task-btn', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const description = $(this).data('description');
                const deadline = $(this).data('deadline');
                const type = $(this).data('type');

                $('#update-task-id').val(id);
                $('#update-task-title').val(name);
                $('#update-task-deadline').val(deadline);
                $('#update-task-type').val(type);
                $('#update-task-description').val(description);

                $('#updateTaskModal').modal('show');

                $('#updateTaskForm').off('submit').on('submit', function(event) {
                    event.preventDefault();
                    const formData = new FormData(this);

                    fetch(`/api/task/course/update/${id}`, {
                            method: 'POST',
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                $('#updateTaskModal').modal('hide');
                                fetchTasks();
                                showAlert('Tugas berhasil diperbarui!', 'success');
                            } else {
                                showAlert('Gagal memperbarui tugas.', 'danger');
                            }
                        })
                        .catch(error => {
                            showAlert('Error saat memperbarui tugas.', 'danger');
                        });
                });
            });

            $(document).on('click', '.delete-task-btn', function() {
                const taskId = $(this).data('id');
                openDeleteModal(taskId);
            });

            $('#addTaskForm').on('submit', function(event) {
                event.preventDefault();
                loadingMessage.style.display = 'block';
                const formData = new FormData(this);
                $.ajax({
                    url: '/api/task/course/post',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        loadingMessage.style.display = 'none';
                        if (response.status === 'success') {
                            showAlert('Tugas berhasil ditambahkan!', 'success');
                            $('#addTaskModal').modal('hide');
                            fetchTasks();
                        } else {
                            showAlert(response.message || 'Gagal menambahkan tugas', 'error');
                        }
                    },
                    error: function(xhr) {
                        loadingMessage.style.display = 'none';
                        showAlert(xhr.responseJSON?.message || 'Terjadi kesalahan', 'error');
                    }
                });

                return false;
            });

            fetchTasks();

            fetch(`/api/teacher/course/show/${courseId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const course = data.data;
                        const classNameElement = document.getElementById('class-name1');
                        classNameElement.textContent = course.name;

                        const linkDiv = document.getElementById('link');
                        const documentDiv = document.getElementById('document');
                        const textDiv = document.getElementById('text');
                        const backButton = document.getElementById('back-button');
                        backButton.href = `/teacher/classroom/course/${course.classroom_id}`;

                        if (course.type === 'link' && course.link) {
                            if (course.link.includes('youtube.com') || course.link.includes('youtu.be')) {
                                const videoId = new URL(course.link).searchParams.get('v') || course.link.split(
                                    '/').pop();
                                linkDiv.innerHTML =
                                    `<iframe width="100%" height="600" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
                                linkDiv.style.display = 'block';
                            } else {
                                linkDiv.innerHTML =
                                    `<iframe src="${course.link}" style="width: 100%; height: 800px;" frameborder="0"></iframe>`;
                                linkDiv.style.display = 'block';
                            }
                        } else if (course.type === 'document' && course.document) {
                            documentDiv.style.display = 'block';
                            const pdfUrl = `/storage/${course.document}`;
                            let pdfDoc = null;
                            let pageNum = 1;

                            pdfjsLib.getDocument(pdfUrl).promise.then(doc => {
                                pdfDoc = doc;
                                renderPage(pageNum);
                                document.getElementById('prev').style.display = 'block';
                                document.getElementById('next').style.display = 'block';
                            });

                            function renderPage(num) {
                                pdfDoc.getPage(num).then(page => {
                                    const viewport = page.getViewport({
                                        scale: 1
                                    });
                                    const canvas = document.getElementById('pdf-canvas');
                                    const context = canvas.getContext('2d');
                                    canvas.height = viewport.height;
                                    canvas.width = viewport.width;

                                    const renderContext = {
                                        canvasContext: context,
                                        viewport: viewport
                                    };
                                    page.render(renderContext);
                                });
                            }

                            document.getElementById('prev').addEventListener('click', () => {
                                if (pageNum <= 1) return;
                                pageNum--;
                                renderPage(pageNum);
                            });
                            document.getElementById('next').addEventListener('click', () => {
                                if (pageNum >= pdfDoc.numPages) return;
                                pageNum++;
                                renderPage(pageNum);
                            });
                        } else if (course.type === 'text_course' && course.text_course) {
                            textDiv.innerHTML = `
                                <h3 style="font-size: 1.5em; margin-bottom: 0.5em;">${course.name}</h3>
                                <p style="font-size: 1.2em; color: #555;">${course.description}</p>
                                <div style="font-size: 1em; margin-top: 1em;">${course.text_course}</div>
                            `;
                        }
                    } else {
                        console.error('Error:', data.message);
                        document.getElementById('text').innerText = data.message;
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        });

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
    </script>
@endsection

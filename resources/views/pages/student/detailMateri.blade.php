@extends('layouts.student.app')

@section('content')
    <div class="mb-3 d-flex justify-content-between">
        <h4>Detail Materi <span id="class-name1"></span></h4>

    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs" id="contentTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="materi-tab" data-bs-toggle="tab" data-bs-target="#materi" type="button"
                role="tab" aria-controls="materi" aria-selected="true">Materi</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tugas-tab" data-bs-toggle="tab" data-bs-target="#tugas" type="button"
                role="tab" aria-controls="tugas" aria-selected="false">Tugas</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="mt-3 tab-content" id="contentTabsContent">
        <!-- Tab Materi -->
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
                        style="width: 80px; height: 80px; background-color: rgba(128, 128, 128, 0.5); color: white; border: none; border-radius: 50%; cursor: pointer; display: none;">
                        <img src="https://img.icons8.com/material-outlined/40/ffffff/chevron-right.png" alt="Next" />
                    </button>
                </div>
            </div>
            <div id="text"></div>
        </div>

        <!-- Tab Tugas -->
        <div class="tab-pane fade" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
            <form id="submit-task-form" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="task_course_id" id="task_course_id">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">
                <div class="container mt-5">
                    <div class="card" id="taskCard">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="m-3 card-title" id="taskTitle">Judul Tugas</h5>
                            <div class="p-1 rounded d-flex align-items-center bg-danger" id="taskDeadline">
                                <span class="p-2 text-white badge">Deadline:</span>
                                <span class="p-2 text-white badge" id="deadlineDate"></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text" id="taskDescription"></p>
                        </div>
                    </div>
                </div>
                <div class="container mt-5">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="m-3 card-title">Pengumpulan Tugas</h5>
                            <div class="p-1 rounded d-flex align-items-center bg-success">
                                <span class="p-2 text-white badge">Tambahkan Tugas</span>
                            </div>
                        </div>
                        <div class="card-body" id="assignmentContainer">
                            <div class="mb-3" id="taskSubmissionContainer"></div>
                            <div class="d-flex justify-content-end">

                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="" id="class-link" class="m-3 ml-3 flex-grow-1"></a>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var taskId = "{{ $id }}";

            // Fungsi untuk menampilkan alert menggunakan SweetAlert
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

            // Ambil data tugas saat halaman dimuat
            function fetchTaskData() {
                $.ajax({
                    url: '/api/task/course/' + taskId,
                    method: 'GET',
                    success: function(response) {
                        if (response.status === "success" && response.data.length > 0) {
                            var task = response.data[0];
                            var type = task.type;

                            $('#task_course_id').val(task.id);
                            $('#taskTitle').text(task.name);
                            $('#deadlineDate').text(task.deadline_format);
                            $('#taskDescription').text(task.description);

                            $.ajax({
                                url: '/api/Apiassigment/' + task.id,
                                method: 'GET',
                                success: function(assignmentResponse) {
                                    if (assignmentResponse.status === "success" &&
                                        assignmentResponse.data.length > 0) {
                                        var assignments = assignmentResponse.data;
                                        var assignmentCards = '';

                                        var deadline = new Date(task.deadline);

                                        $.each(assignments, function(index, assignment) {
                                            var createdAt = new Date(assignment
                                                .created_at);
                                            var formattedTime = createdAt
                                                .toLocaleTimeString('id-ID', {
                                                    hour: '2-digit',
                                                    minute: '2-digit'
                                                });

                                            var now = new Date();
                                            var isDeadlinePassed = now >= deadline;
                                            var deadlineMessage = isDeadlinePassed ?
                                                `<span class="text-danger">Tugas sudah ditutup</span>` :
                                                '';

                                            var icon = task.type === 'file' ?
                                                '<i class="fa fa-file" style="font-size: 24px; color: #1e3c72;"></i>' :
                                                '<i class="fa fa-link" style="font-size: 24px; color: #1e3c72;"></i>';

                                            var actionButton = assignment.grade ==
                                                null && !isDeadlinePassed ?
                                                (assignment.grade ?
                                                    `<span class="text-success">Sudah Dinilai</span>` :
                                                    `<span class="delete-assignment btn btn-danger btn-sm" data-id="${assignment.id}" style="cursor: pointer;">Hapus</span>`
                                                    ) :
                                                `<span class="text-success">Sudah Mengumpulkan</span>`;


                                            var detailButton = task.type ===
                                                'file' ?
                                                `<a href="{{ asset('storage/${assignment.file}') }}" class="btn btn-primary btn-sm" target="_blank">Unduh</a>` :
                                                `<a href="${assignment.link}" class="btn btn-primary btn-sm" target="_blank">Detail</a>`;

                                            assignmentCards += `
                                        <div class="mb-3 card assignment-card" data-assignment-id="${assignment.id}" style="display: flex; align-items: center; justify-content: space-between; padding: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                            <div class="d-flex align-items-center">
                                                ${icon}
                                                <div style="margin-left: 15px;">
                                                    <h5>Sudah Mengumpulkan</h5>
                                                    <p>${formattedTime} ${deadlineMessage}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center" style="gap: 10px;">
                                                ${actionButton}
                                                ${!isDeadlinePassed ? detailButton : ''}
                                            </div>
                                        </div>
                                    `;
                                        });

                                        // Pastikan menghapus semua kartu tugas yang ada sebelumnya
                                        $('#taskSubmissionContainer').empty();
                                        // Menambahkan kartu tugas yang baru
                                        $('#taskSubmissionContainer').html(assignmentCards);
                                        $('#submitTaskButton').remove();
                                    } else {
                                        // Jika data kosong, tampilkan form pengiriman tugas
                                        if (type === "file") {
                                            $('#taskSubmissionContainer').append(`
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Upload Tugas</label>
                                            <input class="form-control" name="file" type="file" id="formFile">
                                            <small class="form-text text-muted">* File harus berformat ZIP.</small>
                                        </div>
                                    `);
                                        } else if (type === "link") {
                                            $('#taskSubmissionContainer').append(`
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Link Tugas</label>
                                            <input type="url" class="form-control" name="link" id="exampleFormControlInput1" placeholder="Masukan Disini">
                                            <small class="form-text text-muted">* Masukkan URL yang valid (contoh: https://example.com).</small>
                                        </div>
                                    `);
                                        }

                                        $('#taskSubmissionContainer').append(`
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="w-25 join-button" id="submitTaskButton"
                                            style="background: linear-gradient(90deg, #1e3c72, #2a5298); color: white; font-size: 13px; padding: 13px; border: none; border-radius: 30px; cursor: pointer; transition: transform 0.2s, box-shadow 0.3s; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
                                            Kirim
                                        </button>
                                    </div>
                                `);
                                    }
                                },
                                error: function() {
                                    showAlert(
                                        'Terjadi kesalahan saat memeriksa assignment.',
                                        'error');
                                }
                            });
                        } else {
                            showAlert('Data tidak ditemukan.', 'error');
                        }
                    },
                    error: function() {
                        showAlert('Terjadi kesalahan saat mengambil data tugas.', 'error');
                    }
                });
            }

            // Panggil fungsi fetchTaskData saat halaman dimuat
            fetchTaskData();

            // Konfirmasi dan hapus assignment
            $(document).on('click', '.delete-assignment', function() {
                var assignmentId = $(this).data('id'); // ambil id dari tombol Hapus

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Tugas ini akan dihapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lakukan permintaan untuk menghapus assignment
                        $.ajax({
                            url: '/api/assigment/delete/' + assignmentId,
                            method: 'DELETE',
                            success: function(response) {
                                if (response.status === 'success') {
                                    // Tampilkan notifikasi sukses
                                    showAlert('Tugas berhasil dihapus', 'success');

                                    // Sembunyikan kartu tugas yang dihapus
                                    $(`.assignment-card[data-assignment-id="${assignmentId}"]`)
                                        .hide();

                                    // Panggil ulang fetchTaskData untuk memperbarui tampilan
                                    fetchTaskData
                                (); // Ini akan menampilkan ulang kartu tugas dan form input dengan benar
                                } else {
                                    showAlert('Gagal menghapus tugas', 'error');
                                }
                            },
                            error: function() {
                                showAlert('Terjadi kesalahan saat menghapus tugas',
                                    'error');
                            }
                        });
                    }
                });
            });

            // Submit tugas
            $(document).on('click', '#submitTaskButton', function() {
                var formData = new FormData($('#submit-task-form')[0]);

                $.ajax({
                    url: '/api/assigment/post',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            showAlert('Tugas berhasil dikirim!', 'success');
                            fetchTaskData(); // Memperbarui data setelah tugas dikirim
                        } else {
                            showAlert('Gagal mengirim tugas: ' + response.message, 'error');
                        }
                    },
                    error: function() {
                        showAlert('Terjadi kesalahan saat mengirim tugas.', 'error');
                    }
                });
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const courseId = {{ $id }};
            fetch(`/api/student/course/show/${courseId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const course = data.data;
                        const linkDiv = document.getElementById('link');
                        const documentDiv = document.getElementById('document');
                        const textDiv = document.getElementById('text');
                        const classNameElement = document.getElementById('class-name1');
                        const classLinkElement = document.getElementById('class-link');

                        classNameElement.textContent = course.name;
                        classLinkElement.href = `/student/classroom/course/${course.classroom_id}`;

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
                        } else {
                            textDiv.innerHTML = `<p>Tipe materi tidak dikenali.</p>`;
                        }
                    } else {
                        console.error('Error:', data.message);
                        document.getElementById('text').innerText = data.message;
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>
@endsection

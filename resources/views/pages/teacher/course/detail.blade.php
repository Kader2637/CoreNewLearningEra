@extends('layouts.teacher.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Detail Materi dan Tugas <span id="class-name1"></span></h4>
    <div>
        <a href="{{ route('task.assignmentAssessment') }}" class="btn btn-primary btn-sm mr-2">Tambah Tugas</a>
        <a id="back-button" href="#" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>

<!-- Tabs navigation -->
<ul class="nav nav-tabs" id="tabContent" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="materi-tab" data-bs-toggle="pill" href="#materi" role="tab" aria-controls="materi" aria-selected="true">Materi</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="tugas-tab" data-bs-toggle="pill" href="#tugas" role="tab" aria-controls="tugas" aria-selected="false">Tugas</a>
    </li>
    <li class="nav-item ms-auto">
        <!-- Button Add Tugas -->
        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addTaskModal">Tambah Tugas</button>
    </li>
</ul>

<!-- Tab content -->
<div class="tab-content mt-3" id="v-pills-tabContent">
    <!-- Materi Tab -->
    <div class="tab-pane fade show active" id="materi" role="tabpanel" aria-labelledby="materi-tab">
        <div id="link" style="display: none;"></div>
        <div id="document" style="display: none; position: relative; width: 100%; overflow: hidden;">
            <div class="container-fluid d-flex justify-content-center mb-5">
                <canvas id="pdf-canvas" style="width: 1100px; height: auto;"></canvas>
            </div>
            <div id="pdf-controls" style="position: fixed; top: 50%; right: 20px; transform: translateY(-50%); display: flex; flex-direction: column; align-items: center;">
                <button id="prev" style="width: 80px; height: 80px; margin-bottom: 10px; background-color: rgba(128, 128, 128, 0.5); color: white; border: none; border-radius: 50%; cursor: pointer; display: none;">
                    <img src="https://img.icons8.com/material-outlined/40/ffffff/chevron-left.png" alt="Previous" />
                </button>
                <button id="next" style="width: 80px; height: 80px; background-color: rgba(128, 128, 128, 0.5); color: white; border: none; border-radius: 50%; cursor: pointer; display: none;">
                    <img src="https://img.icons8.com/material-outlined/40/ffffff/chevron-right.png" alt="Next" />
                </button>
            </div>
        </div>
        <div id="text"></div>
    </div>

    <!-- Tugas Tab -->
    <div class="tab-pane fade" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
        <div id="tasks-list">
            <!-- Daftar tugas akan dimuat di sini -->
            <p>Loading tasks...</p>
        </div>
    </div>
</div>
<!-- Modal Add Tugas -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Membuat modal lebih lebar -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addTaskModalLabel">Tambah Tugas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addTaskForm">
            <div class="row">
              <!-- Judul Tugas dan Deadline bersebelahan dengan border dan jarak lebih sedikit -->
              <div class="col-6 mb-3">
                <label>Judul tugas</label>
                <input type="text" class="form-control" id="task-title" placeholder="Judul Tugas" required style="border: 1px solid #ddd; border-radius: 4px;">
              </div>
              <div class="col-6 mb-3">
                <label>Deadline</label>
                <input type="date" class="form-control" id="task-deadline" required style="border: 1px solid #ddd;  border-radius: 4px;">
              </div>
            </div>
            <!-- Deskripsi Tugas dengan border, padding, dan jarak sedikit lebih kecil -->
            <div class="mb-3">
              <textarea class="form-control" id="task-description" rows="3" placeholder="Deskripsi Tugas" required style="border: 1px solid #ddd; padding: 10px; border-radius: 4px; margin-top: 5px;"></textarea>
            </div>
            <!-- Pilih File -->
            <div class="mb-3">
              <input type="file" class="form-control" id="task-file" placeholder="Pilih File" style="border: 1px solid #ddd; padding: 10px; border-radius: 4px;">
            </div>
            <!-- Upload Link -->
            <div class="mb-3">
                <input type="url" class="form-control" id="task-link" placeholder="Upload Link" required style="border: 1px solid #ddd; padding: 10px; border-radius: 4px;">
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const courseId = {{$id}};

        // Fetching course data
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
                    const tasksList = document.getElementById('tasks-list');
                    const backButton = document.getElementById('back-button');
                    backButton.href = `/teacher/classroom/course/${course.classroom_id}`;

                    // Materi
                    if (course.type === 'link' && course.link) {
                        if (course.link.includes('youtube.com') || course.link.includes('youtu.be')) {
                            const videoId = new URL(course.link).searchParams.get('v') || course.link.split('/').pop();
                            linkDiv.innerHTML = `<iframe width="100%" height="600" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
                            linkDiv.style.display = 'block';
                        } else {
                            linkDiv.innerHTML = `<iframe src="${course.link}" style="width: 100%; height: 800px;" frameborder="0"></iframe>`;
                            linkDiv.style.display = 'block';
                        }
                    }
                    else if (course.type === 'document' && course.document) {
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
                                const viewport = page.getViewport({ scale: 1 });
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
                    }
                    // Materi Teks
                    else if (course.type === 'text_course' && course.text_course) {
                        textDiv.innerHTML = `
                            <h3 style="font-size: 1.5em; margin-bottom: 0.5em;">${course.name}</h3>
                            <p style="font-size: 1.2em; color: #555;">${course.description}</p>
                            <div style="font-size: 1em; margin-top: 1em;">${course.text_course}</div>
                        `;
                    }

                    // Tugas
                    if (course.tasks && course.tasks.length > 0) {
                        let tasksHTML = '<ul>';
                        course.tasks.forEach(task => {
                            tasksHTML += `
                                <li>
                                    <a href="/teacher/task/${task.id}" class="btn btn-link">${task.title}</a>
                                </li>
                            `;
                        });
                        tasksHTML += '</ul>';
                        tasksList.innerHTML = tasksHTML;
                    } else {
                        tasksList.innerHTML = '<p>Tidak ada tugas untuk kursus ini.</p>';
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

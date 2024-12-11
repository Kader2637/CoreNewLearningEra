@extends('layouts.student.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Detail Materi <span id="class-name1"></span></h4>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs" id="contentTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="materi-tab" data-bs-toggle="tab" data-bs-target="#materi" type="button" role="tab" aria-controls="materi" aria-selected="true">Materi</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="tugas-tab" data-bs-toggle="tab" data-bs-target="#tugas" type="button" role="tab" aria-controls="tugas" aria-selected="false">Tugas</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pengumpulan-tugas-tab" data-bs-toggle="tab" data-bs-target="#pengumpulan-tugas" type="button" role="tab" aria-controls="pengumpulan-tugas" aria-selected="false">Pengumpulan Tugas</button>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content mt-3" id="contentTabsContent">
    <!-- Tab Materi -->
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

    <!-- Tab Tugas -->
    <div class="tab-pane fade" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-3">Judul Tugas</h5>
                    <div class="d-flex align-items-center bg-danger rounded p-1">
                        <span class="badge text-white p-2">Deadline:</span>
                        <span class="badge text-white p-2">2024-12-12</span>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vehicula ante in volutpat venenatis. Sed malesuada nisi quis diam hendrerit, ac posuere sapien efficitur. Proin non vulputate ante, vel tincidunt neque. Vivamus sollicitudin, nulla in luctus ullamcorper, metus velit varius metus, vel dapibus orci augue vel dui.</p>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <!-- Tab Pengumpulan Tugas -->
    <div class="tab-pane fade" id="pengumpulan-tugas" role="tabpanel" aria-labelledby="pengumpulan-tugas-tab">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center" style="border: 1px solid #ddd; padding: 10px;">
                <div>
                    <h5 style="margin-bottom: 40;">Pengumpulan tugas</h5>
                </div>
                <span class="badge bg-success text-white p-2" style="margin-bottom: 0;">Ditugaskan</span>
            </div>


            <div >
            </div>
            <hr>
            <form>
                <div class="mb-3">
                    <label for="tugasFile" class="form-label">Upload Tugas</label>
                    <input type="file" class="form-control" id="tugasFile" required>
                </div>
                <p>kalau link</p>
                <div class="mb-3">
                    <label for="tugasLink" class="form-label">Upload Tugas</label>
                    <input type="url" class="form-control" id="tugasLink" required>
                </div>
                <div class="mb-3">
                    <label for="tugasDescription" class="form-label">Deskripsi Tugas</label>
                    <textarea class="form-control" id="tugasDescription" rows="4" required></textarea>
                </div>
                <div>
                    <a href="" id="class-link" class="btn btn-primary flex-grow-1 ml-3 m-3">
                        Tambah tugas
                    </a>
                    <a href="" id="class-link" class="btn btn-primary flex-grow-1 ml-3">
                        Tandai sebagai selesai
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const courseId = {{$id}};
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
                    else if (course.type === 'text_course' && course.text_course) {
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

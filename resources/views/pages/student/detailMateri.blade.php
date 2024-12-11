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
            <form id="submit-task-form" action="/api/student/task/submit" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container mt-5">
                    <!-- Tab Tugas -->
                    <div class="container mt-5">
                        <!-- Tab Tugas -->
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="m-3 card-title">Judul Tugas</h5>
                                <div class="p-1 rounded d-flex align-items-center bg-danger">
                                    <span class="p-2 text-white badge">Deadline:</span>
                                    <span class="p-2 text-white badge">2024-12-12</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
                                    vehicula ante in volutpat venenatis. Sed malesuada nisi quis diam hendrerit, ac posuere
                                    sapien efficitur. Proin non vulputate ante, vel tincidunt neque. Vivamus sollicitudin,
                                    nulla in luctus ullamcorper, metus velit varius metus, vel dapibus orci augue vel dui.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-5">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="m-3 card-title">Pengumpulan Tugas</h5>
                                <div class="p-1 rounded d-flex align-items-center bg-success">
                                    <span class="p-2 text-white badge">Tambahkan Tugas</span>
                                    <span class="p-2 text-white badge"></span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload Tugas</label>
                                    <input class="form-control" type="file" id="formFile">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Link Tugas</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Masukan Disini">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi tugas</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div>
                        <a href="" id="class-link" class="m-3 ml-3 btn btn-primary flex-grow-1">
                            Kumpulkan tugas
                        </a>
            </form>
        </div>
    </div>

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

@extends('layouts.admin.app')

@section('content')
<div class="page-title mb-2">
    <div class="row">
        <div class="col-xl-4 col-sm-7 box-col-3">
            <h3>Detail Materi</h3>
        </div>
        <div class="col-5 d-none d-xl-block"></div>
        <div class="col-xl-3 col-sm-5 box-col-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin/classroom">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="m2.25 12l8.955-8.955a1.124 1.124 0 0 1 1.59 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item active">Detail Materi</li>
            </ol>
        </div>
    </div>
</div>
<div class="text-end mb-4">
    <a id="back-button" class="btn btn-primary" href="#" style="margin-top: 20px;">Kembali</a>
</div>
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
                    const backButton = document.getElementById('back-button');
                    const classNameElement = document.getElementById('class-name1'); // Pastikan elemen ini ada di HTML
                    const classLinkElement = document.getElementById('class-link'); // Pastikan elemen ini ada di HTML

                    if (classNameElement) classNameElement.textContent = course.name;
                    if (classLinkElement) classLinkElement.href = `/student/classroom/course/${course.classroom_id}`;

                    // Mengatur href untuk tombol kembali
                    backButton.href = `/admin/classroom/detail/${course.classroom_id}`;

                    if (course.type === 'link' && course.link) {
                        if (course.link.includes('youtube.com') || course.link.includes('youtu.be')) {
                            const videoId = new URL(course.link).searchParams.get('v') || course.link.split('/').pop();
                            linkDiv.innerHTML = `<iframe width="100%" height="600" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
                            linkDiv.style.display = 'block';
                        } else {
                            linkDiv.innerHTML = `<iframe src="${course.link}" style="width: 100%; height: 800px;" frameborder="0"></iframe>`;
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
                    document.getElementById('text').innerText = data.message || 'Terjadi kesalahan.';
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    });
</script>
@endsection

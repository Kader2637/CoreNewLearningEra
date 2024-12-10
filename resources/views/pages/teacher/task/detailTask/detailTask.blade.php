@extends('layouts.teacher.app')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h4>Detail Tugas <span id="task-name">Matematika - Tugas 1</span></h4>
        <div>
            <a href="http://127.0.0.1:8000/teacher/task" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </div>

    <!-- Lampiran Tugas dan Deskripsi -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body px-3 pt-3 pb-0">
                <div class="mb-3">
                    <h5>Lampiran Tugas & Deskripsi</h5>
                    <p>
                        Untuk mendalami materi lebih lanjut, Anda dapat mengunduh lampiran tugas yang berisi soal-soal untuk dikerjakan.
                        <br><br>
                        Tugas ini bertujuan untuk menguji pemahaman siswa dalam materi dasar matematika. Soal-soal yang ada dirancang untuk mengevaluasi kemampuan analitis dan penerapan konsep matematika dalam situasi sehari-hari.
                        <br><br>
                        Pastikan untuk menyelesaikan soal-soal dengan teliti dan mengumpulkan jawaban tepat waktu. Jangan ragu untuk bertanya jika ada soal yang kurang dimengerti.
                        <br><br>
                        Kumpulkan tugas melalui platform ini setelah Anda menyelesaikan soal-soal yang ada. Selamat mengerjakan!
                    </p>
                    <a href="http://127.0.0.1:8000/storage/tasks/task1.pdf" class="btn btn-link" target="_blank">Download Lampiran Tugas</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Jumlah Siswa, Siswa yang Mengumpulkan dan Belum Mengumpulkan -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card card-body">
                <h5>Total Siswa</h5>
                <p id="total-students">30 Siswa</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-body">
                <h5>Siswa yang Mengumpulkan</h5>
                <p id="submitted-students">20 Siswa</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-body">
                <h5>Siswa yang Belum Mengumpulkan</h5>
                <p id="not-submitted-students">10 Siswa</p>
            </div>
        </div>
    </div>

    <!-- Daftar Siswa yang Mengumpulkan -->
    <div id="submitted" class="mt-4" style="background-color: #ffffff; border-radius: 8px; padding: 20px;">
        <h5>Siswa yang Mengumpulkan</h5>
        <p>Berikut adalah daftar siswa yang sudah mengumpulkan tugas. Anda bisa memberikan nilai langsung di sini.</p>
        <table class="table table-bordered" id="submitted-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Nilai</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data Siswa akan ditambahkan melalui JavaScript -->
            </tbody>
        </table>
        <div>
            <button class="btn btn-secondary btn-sm" id="prevBtn">Previous</button>
            <button class="btn btn-secondary btn-sm" id="nextBtn">Next</button>
        </div>
    </div>

    <!-- Daftar Siswa yang Belum Mengumpulkan -->
    <div id="not-submitted" class="mt-4" style="background-color: #ffffff; border-radius: 8px; padding: 20px;">
        <h5>Siswa yang Belum Mengumpulkan</h5>
        <p>Berikut adalah daftar siswa yang belum mengumpulkan tugas. Anda dapat menandai siswa-siswa ini setelah mereka mengumpulkan tugas.</p>
        <table class="table table-bordered" id="not-submitted-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data Siswa akan ditambahkan melalui JavaScript -->
            </tbody>
        </table>
        <div>
            <button class="btn btn-secondary btn-sm" id="prevBtnNotSubmitted">Previous</button>
            <button class="btn btn-secondary btn-sm" id="nextBtnNotSubmitted">Next</button>
        </div>
    </div>
</div>

<script>
    // Data Siswa yang Mengumpulkan
    const submittedStudents = [
        { name: 'Rudi', grade: 80 },
        { name: 'Siti', grade: 85 },
        { name: 'Andi', grade: 90 },
        { name: 'Budi', grade: 78 },
        { name: 'Ana', grade: 88 },
        { name: 'Tina', grade: 75 },
        { name: 'Deni', grade: 92 },
    ];

    // Data Siswa yang Belum Mengumpulkan
    const notSubmittedStudents = [
        { name: 'Juli',  },
        { name: 'Romi', },
    ];

    let currentPageSubmitted = 0;
    let currentPageNotSubmitted = 0;

    function renderTable(tableId, data, startIndex) {
        const tableBody = document.querySelector(`#${tableId} tbody`);
        tableBody.innerHTML = '';
        const endIndex = startIndex + 10;
        const paginatedData = data.slice(startIndex, endIndex);

        paginatedData.forEach((item, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${startIndex + index + 1}</td>
                <td>${item.name}</td>
                ${tableId === 'submitted-table' ? `<td><input type="number" class="form-control" value="${item.grade}" /></td>` : ''}
                <td>
                    <button class="btn btn-primary btn-sm">${tableId === 'submitted-table' ? 'Simpan Nilai' : item.action}</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Initial render
    renderTable('submitted-table', submittedStudents, currentPageSubmitted * 10);
    renderTable('not-submitted-table', notSubmittedStudents, currentPageNotSubmitted * 10);

    // Event Listeners
    document.getElementById('nextBtn').addEventListener('click', () => {
        if ((currentPageSubmitted + 1) * 10 < submittedStudents.length) {
            currentPageSubmitted++;
            renderTable('submitted-table', submittedStudents, currentPageSubmitted * 10);
        }
    });

    document.getElementById('prevBtn').addEventListener('click', () => {
        if (currentPageSubmitted > 0) {
            currentPageSubmitted--;
            renderTable('submitted-table', submittedStudents, currentPageSubmitted * 10);
        }
    });

    document.getElementById('nextBtnNotSubmitted').addEventListener('click', () => {
        if ((currentPageNotSubmitted + 1) * 10 < notSubmittedStudents.length) {
            currentPageNotSubmitted++;
            renderTable('not-submitted-table', notSubmittedStudents, currentPageNotSubmitted * 10);
        }
    });

    document.getElementById('prevBtnNotSubmitted').addEventListener('click', () => {
        if (currentPageNotSubmitted > 0) {
            currentPageNotSubmitted--;
            renderTable('not-submitted-table', notSubmittedStudents, currentPageNotSubmitted * 10);
        }
    });
</script>




@endsection

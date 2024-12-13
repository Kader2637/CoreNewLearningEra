@extends('layouts.admin.app')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-xl-4 col-sm-7 box-col-3">
                <h3>Tugas</h3>
            </div>
            <div class="col-5 d-none d-xl-block">

            </div>
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
                    <li class="breadcrumb-item active">Tugas</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <h4>Detail Tugas <span id="task-name">{{ $taskCourse->name }} </span></h4>
            <div>
                <a href="/admin/classroom/detail/course/{{ $taskCourse->course_id }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
        </div>

        <!-- Lampiran Tugas dan Deskripsi -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-body px-3 pt-3 pb-0">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <h5>Lampiran Tugas &amp; Deskripsi</h5>
                            @php
                                $deadline = \Carbon\Carbon::parse($taskCourse->deadline);
                                $now = \Carbon\Carbon::now();
                            @endphp

                                @if ($now->greaterThan($deadline))
                                    @php
                                        $hoursLate = $deadline->diffInHours($now);
                                        $daysLate = floor($hoursLate / 24);
                                        $remainingHours = $hoursLate % 24;
                                    @endphp
                                    @if ($daysLate > 0)
                                    <p class="text-danger">
                                        Telat {{ $daysLate }} hari {{ $remainingHours }} jam dari sekarang
                                    </p>
                                    @else
                                    <p class="text-danger">
                                        Telat {{ $remainingHours }} jam dari sekarang
                                    </p>
                                    @endif
                                @else
                                <p class="text-success">
                                    Deadline: {{ $deadline->locale('id')->diffForHumans() }}
                                </p>
                                @endif

                        </div>
                        <p>
                            {{ $taskCourse->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Siswa yang Mengumpulkan -->
        <div id="submitted" class="mt-4" style="background-color: #ffffff; border-radius: 8px; padding: 20px;">
            <h5>Siswa yang Mengumpulkan</h5>
            <p>Berikut adalah daftar siswa yang sudah mengumpulkan tugas. Anda bisa memberikan nilai langsung di sini.</p>
            <table class="table table-bordered" id="submitted-table" style="border-color: rgba(0, 0, 0, 0.125);">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody id="submitted-tbody">

                </tbody>
            </table>
        </div>

        <!-- Daftar Siswa yang Belum Mengumpulkan -->
        <div id="not-submitted" class="mt-4" style="background-color: #ffffff; border-radius: 8px; padding: 20px;">
            <h5>Siswa yang Belum Mengumpulkan</h5>
            <p>Berikut adalah daftar siswa yang belum mengumpulkan tugas. Anda dapat menandai siswa-siswa ini setelah mereka
                mengumpulkan tugas.</p>
            <table class="table table-bordered" id="not-submitted-table" style="border-color: rgba(0, 0, 0, 0.125);">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="not-submitted-tbody">

                </tbody>
            </table>
        </div>

    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const taskCourseId = "{{ $taskCourse->id }}";

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

            function loadSubmittedAssignments() {
                const submittedApiUrl = `/api/done/assigment/task/${taskCourseId}`;
                const tbody = $('#submitted-tbody');
                tbody.empty();
                tbody.append('<tr><td colspan="4" class="text-center">Loading...</td></tr>');

                $.ajax({
                    url: submittedApiUrl,
                    method: 'GET',
                    success: function(response) {
                        tbody.empty(); // Clear loading message

                        if (response.data.length === 0) {
                            tbody.append(
                                '<tr><td colspan="4" class="text-center">Tidak Ada Data</td></tr>');
                        } else {
                            response.data.forEach((item, index) => {
                                const row = $('<tr></tr>');

                                row.append(`<td>${index + 1}</td>`);
                                row.append(`<td>${item.name}</td>`);

                                row.append(
                                    `<td><input type="text" name="grade" placeholder="Masukkan Nilai" class="form-control" value="${item.grade !== null ? item.grade : ''}" disabled></td>`
                                );

                                const actionCell = $('');
                                const gradeButton = $(
                                    '');
                                gradeButton.on('click', function() {
                                    const gradeInput = row.find('input[name="grade"]')
                                        .val();
                                    const assignmentId = item.id;

                                    $.ajax({
                                        url: `/api/assigment/grade/${assignmentId}`,
                                        method: 'PATCH',
                                        data: {
                                            grade: gradeInput,
                                        },
                                        success: function(response) {
                                            showAlert(response.message,
                                                'success');
                                            loadSubmittedAssignments();
                                        },
                                        error: function(xhr) {
                                            showAlert(xhr.responseJSON
                                                .message, 'error');
                                        }
                                    });
                                });

                                actionCell.append(gradeButton);
                                row.append(actionCell);
                                tbody.append(row);
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        showAlert('Terjadi kesalahan saat mengambil data tugas yang sudah dinilai',
                            'error');
                    }
                });
            }

            function loadNotSubmittedAssignments() {
                const notSubmittedApiUrl = `/api/not/assigment/task/${taskCourseId}`;
                const tbody = $('#not-submitted-tbody');
                tbody.empty();
                tbody.append('<tr><td colspan="3" class="text-center">Loading...</td></tr>');

                $.ajax({
                    url: notSubmittedApiUrl,
                    method: 'GET',
                    success: function(response) {
                        tbody.empty();

                        if (response.data.length === 0) {
                            tbody.append(
                                '<tr><td colspan="3" class="text-center">Tidak Ada Data</td></tr>');
                        } else {
                            response.data.forEach((item, index) => {
                                const row = $('<tr></tr>');

                                row.append(`<td>${index + 1}</td>`);
                                row.append(`<td>${item.name}</td>`);

                                const actionCell = $('<td class="text-center"></td>');
                                const disabledButton = $(
                                    '<button class="btn btn-secondary" disabled>Belum Mengumpulkan</button>'
                                );
                                actionCell.append(disabledButton);

                                row.append(actionCell);
                                tbody.append(row);
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        showAlert('Terjadi kesalahan saat mengambil data tugas yang belum dikumpulkan',
                            'error');
                    }
                });
            }

            loadSubmittedAssignments();
            loadNotSubmittedAssignments();
        });
    </script>
@endsection

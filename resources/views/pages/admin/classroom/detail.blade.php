@extends('layouts.admin.app')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-xl-4 col-sm-7 box-col-3">
                <h3>Detail Kelas</h3>
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
                    <li class="breadcrumb-item active">Detail kelas</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="courses__details-thumb mb-4">
                <img id="class-thumbnail" class="w-100 rounded" alt="Class Thumbnail"
                    style="max-height: 500px; object-fit: cover;">
            </div>
            <div class="courses__details-content">
                <h2 class="title text-center" id="title"></h2>
                <div class="courses__details-meta text-center mb-3">
                    <ul class="list-wrap list-inline">
                        <li class="author-two list-inline-item">
                            <img id="profileUser" class="rounded-circle" alt="Profile Image"
                                style="width: 40px; height: 40px;" src="">
                            By <a href="#" id="nameTeacher"></a>
                        </li>
                    </ul>
                </div>
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="detail-tab" data-bs-toggle="tab"
                            data-bs-target="#detail-tab-pane" type="button" role="tab" aria-controls="detail-tab-pane"
                            aria-selected="true">Detail</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="materi-tab" data-bs-toggle="tab" data-bs-target="#materi-tab-pane"
                            type="button" role="tab" aria-controls="materi-tab-pane"
                            aria-selected="false">Materi</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="siswa-tab" data-bs-toggle="tab" data-bs-target="#siswa-tab-pane"
                            type="button" role="tab" aria-controls="siswa-tab-pane"
                            aria-selected="false">Siswa</button>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="detail-tab-pane" role="tabpanel" aria-labelledby="detail-tab"
                        tabindex="0">
                        <div class="courses__overview-wrap">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="title">Deskripsi Kelas</h3>
                                    <p id="description_classroom" class="text-muted mt-2"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="materi-tab-pane" role="tabpanel" aria-labelledby="materi-tab"
                        tabindex="0">
                        <div class="courses__curriculum-wrap">
                            <h3 class="title">Materi</h3>
                            <ul class="curriculum-list list-unstyled" id="curriculum-list">
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="siswa-tab-pane" role="tabpanel" aria-labelledby="siswa-tab"
                        tabindex="0">
                        <h3 class="title">Siswa</h3>
                        <div class="row" id="student-list">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const classId = '{{ $id }}';

        const ambilDataKelas = () => {
            $.ajax({
                url: `/api/student/classroom/show/${classId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === "success") {
                        const dataKelas = response.data;
                        $('#title').text(dataKelas.name);
                        $('#description_classroom').text(dataKelas.description);

                        const courseThumbnail = dataKelas.thumbnail ?
                            `/storage/${dataKelas.thumbnail}` : '/user.png';
                        $('#class-thumbnail').attr('src', courseThumbnail);

                        const authorImage = dataKelas.user.profile ? `/${dataKelas.user.profile}` :
                            '/user.png';
                        $('#profileUser').attr('src', authorImage);

                        $('#nameTeacher').text(dataKelas.user.name);
                        ambilDataMateri();
                        ambilDataSiswa();
                    } else {
                        $('#class-name').text('Data kelas tidak ditemukan');
                    }
                },
                error: function(xhr, status, error) {
                    $('#class-name').text('Error memuat data kelas');
                }
            });
        };

        const ambilDataMateri = () => {
            $.ajax({
                url: `/api/student/course/data/${classId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    const kontainerMateri = $('#curriculum-list');
                    kontainerMateri.empty();

                    if (response.status && response.data.length > 0) {
                        const daftarMateri = response.data;
                        daftarMateri.forEach(item => {
                            const shortDescription = item.description.length > 80 ?
                                item.description.substring(0, 80) + '...' :
                                item.description;

                            kontainerMateri.append(`
                        <li class="mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M14 9.9V8.2q.825-.35 1.688-.525T17.5 7.5q.65 0 1.275.1T20 7.85v1.6q-.6-.225-1.213-.337T17.5 9q-.95 0-1.825.238T14 9.9m0 5.5v-1.7q.825-.35 1.688-.525T17.5 13q.65 0 1.275.1t1.225.25v1.6q-.6-.225-1.213-.338T17.5 14.5q-.95 0-1.825.225T14 15.4m0-2.75v-1.7q.825-.35 1.688-.525t1.812-.175q.65 0 1.275.1T20 10.6v1.6q-.6-.225-1.213-.338T17.5 11.75q-.95 0-1.825.238T14 12.65m-1 4.4q1.1-.525 2.213-.788T17.5 16q.9 0 1.763.15T21 16.6V6.7q-.825-.35-1.713-.525T17.5 6q-1.175 0-2.325.3T13 7.2zM12 20q-1.2-.95-2.6-1.475T6.5 18q-1.05 0-2.062.275T2.5 19.05q-.525.275-1.012-.025T1 18.15V6.1q0-.275.138-.525T1.55 5.2q1.175-.575 2.413-.888T6.5 4q1.45 0 2.838.375T12 5.5q1.275-.75 2.663-1.125T17.5 4q1.3 0 2.538.313t2.412.887q.275.125.413.375T23 6.1v12.05q0 .575-.487.875t-1.013.025q-.925-.5-1.937-.775T17.5 18q-1.5 0-2.9.525T12 20"/></svg>
                                    <div>
                                        <h5 class="card-title mb-0">
                                            <a href="/admin/classroom/detail/course/${item.id}" class="text-decoration-none text-primary">${item.name}</a>
                                        </h5>
                                        <p class="card-text text-muted">${shortDescription}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    `);
                        });
                    } else {
                        kontainerMateri.append('<li>Tidak ada materi ditemukan</li>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#curriculum-list').append('<li>Error memuat data materi</li>');
                }
            });
        };

        const ambilDataSiswa = () => {
            $.ajax({
                url: `/api/student/data/classroom/${classId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        const daftarSiswa = response.data;
                        const kontainerSiswa = $('#student-list');
                        kontainerSiswa.empty();
                        if (daftarSiswa.length > 0) {
                            daftarSiswa.forEach(siswa => {
                                kontainerSiswa.append(`
                                <div class="col-xl-3 col-xxl-5 col-sm-6">
                                    <div class="card contact-bx">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="image-bx me-3">
                                                    <img src="${siswa.profile || '{{ asset('user.png') }}'}" alt="" class="rounded-circle" width="70">
                                                </div>
                                                <div class="">
                                                    <h6 class="fs-20 font-w600 mb-0">
                                                        <a href="javascript:void(0)" class="text-black">${siswa.name}</a>
                                                    </h6>
                                                    <p class="fs-14 mb-0">${siswa.email}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                            });
                        } else {
                            kontainerSiswa.append('<p>Tidak ada siswa ditemukan</p>');
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

        $(document).ready(function() {
            ambilDataKelas();
        });
    </script>
@endsection

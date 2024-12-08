@extends('layouts.student.app')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="courses__details-thumb">
                    <img id="class-thumbnail" alt="">
                </div>
                <div class="courses__details-content">
                    <h2 class="title" id="title"></h2>
                    <div class="courses__details-meta">
                        <ul class="list-wrap">
                            <li class="author-two">
                                <img id="profile" class="rounded-circle" alt="img">
                                By
                                <a href="#" id="nameTeacher"></a>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" id="detail-tab" data-bs-toggle="tab"
                                data-bs-target="#detail-tab-pane" type="button" role="tab"
                                aria-controls="detail-tab-pane" aria-selected="true">Detail</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="materi-tab" data-bs-toggle="tab"
                                data-bs-target="#materi-tab-pane" type="button" role="tab"
                                aria-controls="materi-tab-pane" aria-selected="false">Materi</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="siswa-tab" data-bs-toggle="tab"
                                data-bs-target="#siswa-tab-pane" type="button" role="tab"
                                aria-controls="siswa-tab-pane" aria-selected="false">Siswa</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="detail-tab-pane" role="tabpanel"
                            aria-labelledby="detail-tab" tabindex="0">
                            <div class="courses__overview-wrap">
                                <h3 class="title">Deskripsi Kelas</h3>
                                <p id="description_classroom"></p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="materi-tab-pane" role="tabpanel" aria-labelledby="materi-tab"
                            tabindex="0">
                            <div class="courses__curriculum-wrap">
                                <h3 class="title">Materi</h3>
                                <ul class="curriculum-list" id="curriculum-list">
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
    </div>
</section>
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
                    const thumbnailUrl = `{{ asset('storage') }}/${dataKelas.thumbnail}`;
                    $('#class-thumbnail').attr('src', thumbnailUrl);
                    const authorImage = dataKelas.user.profile ? `/storage/${dataKelas.user.profile}` : '/user.png';
                    $('#profile').attr('src', authorImage);
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
                if (response.status) {
                    const daftarMateri = response.data;
                    const kontainerMateri = $('#curriculum-list');
                    kontainerMateri.empty();
                    if (daftarMateri.length > 0) {
                        daftarMateri.forEach(item => {
                            kontainerMateri.append(`<li><a href="/student/course/detail/${item.id}">${item.name}</a></li>`);
                        });
                    } else {
                        kontainerMateri.append('<li>Tidak ada materi ditemukan</li>');
                    }
                } else {
                    $('#curriculum-list').append('<li>Tidak ada materi ditemukan</li>');
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

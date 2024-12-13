@extends('layouts.admin.app')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-xl-4 col-sm-7 box-col-3">
                <h3>Kelas</h3>
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
                    <li class="breadcrumb-item active">Kelas</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="mt-4 row" id="classroom-container"></div>

        <div id="no-data" class="d-none">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('no-data.png') }}" width="200px" alt=""> <br>
            </div>
            <h3 class="text-center">Data Masih Kosong</h3>
        </div>

        <div id="loading" class="">
            <div class="d-flex justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" />
                    <rect width="2" height="7" x="11" y="6" fill="currentColor" rx="1">
                        <animateTransform attributeName="transform" dur="9s" repeatCount="indefinite" type="rotate"
                            values="0 12 12;360 12 12" />
                    </rect>
                    <rect width="2" height="9" x="11" y="11" fill="currentColor" rx="1">
                        <animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate"
                            values="0 12 12;360 12 12" />
                    </rect>
                </svg>
            </div>
            <h4 class="mt-2 text-center">
                Loading...
            </h4>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#loading').removeClass('d-none');
            $.ajax({
                url: '/api/classroom/admin',
                type: 'GET',
                success: function(response) {
                    $('#loading').addClass('d-none');
                    if (response.data.length === 0) {
                        $('#no-data').removeClass('d-none');
                    } else {
                        response.data.forEach(function(course) {
                            const defaultImage =
                                "{{ asset('user.png') }}";

                            const courseThumbnail = course.thumbnail ?
                                `/storage/${course.thumbnail}` : '/user.png';
                            const authorImage = course.profile ? `/storage/${course.profile}` :
                                '/user.png';
                            const courseDescription = course.description.length > 80 ?
                                course.description.substring(0, 80) + '...' : course
                                .description;

                            $('#classroom-container').append(`
                            <div class="col-xxl-3 col-xl-5 col-lg-6 col-12">
                                <div class="shadow-sm card border-light">
                                    <div class="card-body">
                                        <div class="mb-3 d-flex justify-content-between align-items-center">
                                            <h3 class="mb-0 f-w-600">${course.name}</h3>
<div>
        <span class="badge bg-primary me-1">${course.statusClass || 'Status Kelas'}</span>
<span class="badge bg-secondary">
    ${course.status === 'accept' ? 'Terima' :
      course.status === 'reject' ? 'Ditolak' :
      course.status === 'pending' ? 'Menunggu' :
      'Status'}
</span>
    </div>                                        </div>
                                        <div class="mb-3 d-flex align-items-center">
                                            <img class="img-20 me-2 rounded-circle" src="${authorImage}"  title="">
                                            <div class="flex-grow-1">
                                                <p class="mb-0 font-weight-bold">${course.user_name}</p>
                                            </div>
                                        </div>
                                        <img src="${courseThumbnail}" class="mb-3 img-fluid w-100" alt="${course.name}" style="max-height:150px;object-fit:cover">
                                        <p class="text-muted">${courseDescription}</p>
                                        <div class="row details">
                                            <div class="col-6">
                                                <span class="font-weight-bold">Total User:</span>
                                            </div>
                                            <div class="col-6 font-secondary">${course.total_user}</div>
                                            <div class="col-6">
                                                <span class="font-weight-bold">Limit:</span>
                                            </div>
                                            <div class="col-6 font-secondary">${course.limit}</div>
                                        </div>
                                        <div class="mt-3">
                                            <a href="/admin/classroom/detail/${course.id}" class="btn btn-primary w-100">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                        });
                    }
                },
                error: function(xhr) {
                    $('#loading').addClass('d-none');
                    console.error('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    </script>
@endsection

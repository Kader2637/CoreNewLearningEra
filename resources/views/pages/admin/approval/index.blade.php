@extends('layouts.admin.app')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-xl-4 col-sm-7 box-col-3">
                <h3>Approval</h3>
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
                    <li class="breadcrumb-item active">Approval</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="alert-container"></div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Guru Sedang Menunggu Approval</h4>
                </div>
                <div class="table-responsive custom-scrollbar">
                    <table class="table" id="data-table">
                        <thead>
                            <tr class="border-bottom-primary">
                                <th scope="col" class="text-center">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col" class="text-center">Jenis Kelamin</th>
                                <th scope="col" class="text-center">No Telephone</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div id="alert-container"></div>
            <div class="">
                <div class="mb-4">
                    <h4>Data Kelas Sedang Menunggu Approval</h4>
                </div>
                <div>
                    <div id="project-container" class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.loader')
    @include('components.reject-delete')
    @include('components.accept-delete')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            function fetchData() {
                $('#loader').show();

                $.ajax({
                    url: '/api/teacher/pending',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#loader').hide();
                        let tbody = $('#data-table tbody');
                        tbody.empty();

                        if (response.status === "success" && Array.isArray(response.data)) {
                            if (response.data.length === 0) {
                                tbody.append(`
                                        <tr>
                                            <td colspan="6" class="text-center">Data masih kosong</td>
                                        </tr>
                                    `);
                            } else {
                                $.each(response.data, function(index, item) {
                                    let profileImage = `{{ asset('storage/${item.image}') }}` ||
                                        '{{ asset('user.png') }}';

                                    tbody.append(`
                                            <tr>
                                                <td class="text-center" scope="row">${index + 1}</td>
                                                <td>
                                                    <img class="img-30 me-2" src="${profileImage}" alt="profile">
                                                    ${item.name}
                                                </td>
                                                <td class="text-center">${item.gender}</td>
                                                <td class="text-center">${item.no_telephone}</td>
                                                <td class="text-center">${item.email}</td>
                                                <td class="d-flex justify-content-center">
                                                    <div class="d-flex gap-2">
                                                        <a href="/admin/teacher/detail/${item.id}" class="btn btn-success btn-sm">Detail</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        `);
                                });

                            }
                        } else {
                            tbody.append(`
                                    <tr>
                                        <td colspan="6" class="text-center">Data masih kosong</td>
                                    </tr>
                                `);
                            showAlert('Data masih kosong.', 'info');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loader').hide();
                        showAlert('Kesalahan saat mengambil data.', 'danger');
                    }
                });
            }




            fetchData();
        });

        function fetchClassroomData() {
            $.ajax({
                url: '/api/approval/classroom',
                method: 'GET',
                success: function(response) {
                    if (response.status === "success") {
                        if (response.data.length === 0) {
                            $('#project-container').html(`
                        <div class="col-12 d-flex flex-column align-items-center justify-content-center text-center">
                            <img src="{{ asset('no-data.png') }}" width="200px" alt="">
                            <h3>Data Masih Kosong</h3>
                        </div>
                    `);
                        } else {
                            $('#project-container').empty();
                            response.data.forEach(function(item) {
                                const profileImageUrl = item.profile ?
                                    `{{ asset('') }}/${item.profile}` :
                                    '{{ asset('user.png') }}';

                                const thumbnailUrl = item.thumbnail ?
                                    `{{ asset('storage') }}/${item.thumbnail}` :
                                    '{{ asset('user.png') }}';

                                const projectBox = `
                            <div class="col-xl-5 col-xxl-3 col-lg-8 col-12">
    <div class="card shadow-sm border-light">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="f-w-600 mb-0">${item.name}</h3>
    <div>
        <span class="badge bg-primary me-1">${item.statusClass || 'Status Kelas'}</span>
<span class="badge bg-secondary">
    ${item.status === 'accept' ? 'Terima' :
      item.status === 'reject' ? 'Ditolak' :
      item.status === 'pending' ? 'Menunggu' :
      'Status'}
</span>    </div>
</div>
            <div class="d-flex align-items-center mb-3">
                <img class="img-20 me-2 rounded-circle" src="${profileImageUrl}" alt="User Avatar" title="">
                <div class="flex-grow-1">
                    <p class="mb-0 font-weight-bold">${item.user}</p>
                </div>
            </div>
            <img src="${thumbnailUrl}" class="img-fluid mb-3" alt="${item.name} Thumbnail">
            <p class="text-muted">${item.description}</p>
            <div class="row details">
                <div class="col-6">
                    <span class="font-weight-bold">Limit Siswa:</span>
                </div>
                <div class="col-6 font-secondary">${item.limit}</div>
            </div>
           <div class="mt-3">
    <div class="row">
        <div class="col-4 mt-2">
            <a href="/admin/classroom/detail/${item.id}" class="btn btn-primary w-100">
                <i class="fas fa-info-circle me-2"></i>
            </a>
        </div>
        <div class="col-4 mt-2">
            <button class="btn btn-danger w-100 reject-button" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#modal-reject">
                <i class="fas fa-times me-2"></i>
            </button>
        </div>
        <div class="col-4 mt-2">
            <button class="btn btn-info w-100 accept-button" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#modal-accept">
                <i class="fas fa-check me-2"></i>
            </button>
        </div>
    </div>
</div>

        </div>
    </div>
</div>
                        `;
                                $('#project-container').append(projectBox);
                            });
                        }
                    }
                },
                error: function() {
                    $('#project-container').html(`
                <div class="col-12 d-flex flex-column align-items-center justify-content-center text-center">
                    <img src="{{ asset('no-data.png') }}" width="200px" alt="">
                    <h3>Terjadi kesalahan saat memuat data.</h3>
                </div>
            `);
                }
            });
        }

        fetchClassroomData();

        $(document).on('click', '.reject-button', function() {

            const classId = $(this).data('id');
            $('#RejectClassId').val(classId);
        });
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

        $('#form-tolak').on('submit', function(e) {
            e.preventDefault();
            const classId = $('#RejectClassId').val();
            $.ajax({
                url: `/api/rejectClass/${classId}`,
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    showAlert('Kelas berhasil ditolak', 'success');
                    $('#modal-reject').modal('hide');
                    fetchClassroomData();
                },
                error: function() {
                    toastr.error('Terjadi kesalahan saat menolak kelas.');
                }
            });
        });

        $(document).on('click', '.accept-button', function() {

            const classId = $(this).data('id');
            $('#AcceptClassId').val(classId);
        });
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

        $('#form-accept').on('submit', function(e) {
            e.preventDefault();
            const classId = $('#AcceptClassId').val();
            $.ajax({
                url: `/api/acceptClass/${classId}`,
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#modal-accept').modal('hide');
                    showAlert('Kelas berhasil diterima', 'success');
                    fetchClassroomData();
                },
                error: function() {
                    toastr.error('Terjadi kesalahan saat menerima kelas.');
                }
            });
        });
    </script>
@endsection

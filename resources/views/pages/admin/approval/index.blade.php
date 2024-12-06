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
    </div>
    @include('layouts.admin.loader')
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
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
                                    let profileImage = item.image || '{{ asset('user.png') }}';

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
                                                    <button class="btn btn-info btn-sm accept-button" data-id="${item.id}">Terima</button>
                                                    <button class="btn btn-danger btn-sm reject-button" data-id="${item.id}">Tolak</button>
                                                    <button class="btn btn-success btn-sm">View</button>
                                                </div>
                                            </td>
                                        </tr>
                                    `);
                                });

                                $('.accept-button').off('click').on('click', function() {
                                    const userId = $(this).data('id');
                                    acceptUser(userId);
                                });

                                $('.reject-button').off('click').on('click', function() {
                                    const userId = $(this).data('id');
                                    rejectUser(userId);
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

            function acceptUser(userId) {
                $('#loader').show();

                $.ajax({
                    url: `/api/accept/${userId}`,
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        $('#loader').hide();
                        showAlert('User berhasil diterima', 'success');

                        fetchData();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loader').hide();
                        showAlert('Kesalahan saat menerima pengguna.', 'danger');
                    }
                });
            }

            function rejectUser(userId) {
                $('#loader').show();

                $.ajax({
                    url: `/api/reject/${userId}`,
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        $('#loader').hide();
                        showAlert('User berhasil ditolak', 'success');

                        fetchData();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loader').hide();
                        showAlert('Kesalahan saat menolak pengguna.', 'danger');
                    }
                });
            }

            fetchData();
        });
    </script>
@endsection

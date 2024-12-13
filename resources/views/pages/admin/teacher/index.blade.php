@extends('layouts.admin.app')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-xl-4 col-sm-7 box-col-3">
                <h3>Teacher</h3>
            </div>
            <div class="col-5 d-none d-xl-block">

            </div>
            <div class="col-xl-3 col-sm-5 box-col-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/admin/teacher">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="m2.25 12l8.955-8.955a1.124 1.124 0 0 1 1.59 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Teacher</li>
                </ol>
            </div>
        </div>
    </div>
    <div id="teacher-container" class="row">
    </div>

<div class="text-center" id="loading-message" style="display: none;">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z"/><rect width="2" height="7" x="11" y="6" fill="currentColor" rx="1"><animateTransform attributeName="transform" dur="9s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></rect><rect width="2" height="9" x="11" y="11" fill="currentColor" rx="1"><animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></rect></svg>
    <h3>Loading...</h3>
</div>
@include('components.modal-delete')
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        const loadingMessage = $('#loading-message');
        loadingMessage.show();

        function fetchData() {
            $.ajax({
                url: '/api/teacher',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    loadingMessage.hide();
                    if (response.status === 'success') {
                        const container = $('#teacher-container');
                        container.empty();
                        if (Array.isArray(response.data) && response.data.length === 0) {
                            $('#no-data-message').show();
                        } else {
                            $('#no-data-message').hide();
                            response.data.forEach(teacher => {
                                const teacherCard = `
                                    <div class="col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
                                        <div class="card social-profile">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img">
                                                        <img src="{{ asset('storage/${teacher.image}') }}" width="75px" style="object-fit: cover" alt="profile" />
                                                    </div>
                                                </div>
                                                <div class="social-details">
                                                    <h5 class="mb-1">
                                                        <a href="#">${teacher.name}</a>
                                                    </h5>
                                                    <span class="f-light">${teacher.email}</span>
                                                    <div class="mt-4">
                                                        <div class="row">
                                                            <div class="col">
                                                                <a href="/admin/teacher/detail/${teacher.id}" class="btn btn-info w-100">
                                                                    Detail
                                                                </a>
                                                            </div>
                                                            <div class="col">
                                                                <button class="btn btn-danger w-100 delete-button" data-id="${teacher.id}" data-bs-toggle="modal" data-bs-target="#modal-delete">
                                                                    Hapus
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                container.append(teacherCard);
                            });
                        }
                    } else {
                        console.error('Error fetching data');
                    }
                },
                error: function(xhr, status, error) {
                    loadingMessage.hide();
                    console.error('AJAX Error: ', status, error);
                }
            });
        }

        fetchData();

        $('#modal-delete').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const userId = button.data('id');
            const form = $('#form-delete');
            $('#deleteClassId').val(userId);

            form.off('submit').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: `/api/user/delete/${userId}`,
                    type: 'DELETE',
                    data: form.serialize(),
                    success: function(response) {
                        toastr.success('Pengguna berhasil dihapus!');
                        fetchData();
                        $('#modal-delete').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Terjadi kesalahan saat menghapus pengguna.');
                        console.error('Error deleting user: ', status, error);
                    }
                });
            });
        });
    });
</script>
@endsection

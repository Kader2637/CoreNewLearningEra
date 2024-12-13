@extends('layouts.student.app')

@section('content')
    <div class="d-flex justify-content-between mb-3 mt-3">
        <h4>Bergabung Kelas</h4>
    </div>
    <div class="row" id="classroom-list">
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function loadClassrooms() {
            const userId = {{ auth()->user()->id }};

            $.ajax({
                url: `/api/join/classroom/${userId}`,
                type: 'GET',
                success: function(response) {
                    let classrooms = response.data;
                    $('#classroom-list').empty();

                    if (classrooms.length === 0) {
                        const noDataHtml = `
                            <div id="no-data" class="text-center">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('no-data.png') }}" width="200px" alt=""> <br>
                                </div>
                                <h3>belum ada kelas</h3>
                            </div>
                        `;
                        $('#classroom-list').append(noDataHtml);
                    } else {
                        $.each(classrooms, function(index, classroom) {
                            const classroomThumbnail = classroom.thumbnail ?
                                `/storage/${classroom.thumbnail}` : '/user.png';
                            const userImage = classroom.user_image ?
                                `/assets/img/users/${classroom.user_image}` : '/user.png';
                                const courseDescription = classroom.description.length > 80 ? classroom.description.substring(0, 80) + '...' : classroom.description;

                            let classroomHtml = `
                            <div class="col-xl-5 col-12">
                                <div class="courses__item courses__item-two shine__animate-item">
                                    <div class="courses__item-thumb courses__item-thumb-two">
                                        <a href="javascript:void(0)" class="shine__animate-link">
                                            <img src="${classroomThumbnail}" alt="img">
                                        </a>
                                    </div>
                                    <div class="courses__item-content courses__item-content-two">
                                        <h5 class="title"><a href="javascript:void(0)">${classroom.name}</a></h5>
                                            <p class="course-description">${courseDescription}</p>
                                        <div class="courses__item-content-bottom">
                                            <div class="author-two">
                                                <a href="javascript(void:0)">
                                                    <img src="${userImage}" alt="img">
                                                    ${classroom.user_name}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="courses__item-bottom-two">
                                        <div class="">
                                            <button class="w-100 join-button"
                                                data-id="${classroom.id}"
                                                style="background: linear-gradient(90deg, #1e3c72, #2a5298); color: white; font-size: 13px; padding: 13px; border: none; border-radius: 30px; cursor: pointer; transition: transform 0.2s, box-shadow 0.3s; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
                                                Bergabung
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                            $('#classroom-list').append(classroomHtml);
                        });

                        $('.join-button').on('click', function() {
                            const classroomId = $(this).data('id');
                            Swal.fire({
                                title: 'Mendaftar Kelas',
                                text: 'Apakah Anda yakin ingin mendaftar di kelas ini? Anda akan menunggu konfirmasi dari pemilik kelas.',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#1B3061',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Mendaftar',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: `/api/Apiclassroom/join/${classroomId}`,
                                        type: 'POST',
                                        data: {
                                            user_id: userId,
                                            _token: $('input[name="_token"]').val()
                                        },
                                        success: function(response) {
                                            showAlert(response.message, 'success');
                                        },
                                        error: function(xhr) {
                                            console.error('Error:', xhr);
                                            showAlert(xhr.responseJSON.message ||
                                                'Terjadi kesalahan saat bergabung di kelas.',
                                                'error');
                                        }
                                    });
                                }
                            });
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan, coba lagi nanti.', 'error');
                }
            });
        }

        function showAlert(message, type) {
            Swal.fire({
                icon: type,
                title: message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });
        }

        $(document).ready(function() {
            loadClassrooms();
        });
    </script>
@endsection

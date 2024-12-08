@extends('layouts.student.app')
@section('content')
    <div class="col">
        <div class="dashboard__count-wrap">
            <div class="d-flex justify-content-between mb-3">
                <h4>Kelas</h4>
                <div>
                    <button class="btn btn-secondary btn-sm" id="joinClassButton">Bergabung ke kelas</button>
                </div>
            </div>
            <div class="row" id="courses-container">
                <div class="row-12">
                    <div id="no-data" class="text-center" style="display: none;">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('no-data.png') }}" width="200px" alt=""> <br>
                        </div>
                        <h3>Anda belum mempunyai kelas</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function loadClassroomData(userId) {
            $.ajax({
                url: `/api/student/classroom/data/${userId}`,
                method: 'GET',
                success: function(response) {
                    $('#courses-container').find('.course-item').remove();

                    if (response.status === "success" && response.StudentClassroomRelations.length === 0) {
                        $('#no-data').show();
                    } else {
                        $('#no-data').hide();

                        response.StudentClassroomRelations.forEach(relation => {
                            const course = relation.course;
                            const user = relation.user;

                            const courseThumbnail = course.thumbnail ? `/storage/${course.thumbnail}` : '/assets/user.png';
                            const authorImage = user.profile ? `/storage/${user.profile}` : '/user.png';
                            const courseDescription = course.description.length > 80 ? course.description.substring(0, 80) + '...' : course.description;

                            const courseHtml = `
                            <div class="col-xl-5 col-md-6 course-item">
                                <div class="courses__item courses__item-two shine__animate-item">
                                    <div class="courses__item-thumb courses__item-thumb-two">
                                        <a href="/student/classroom/course/${course.id}" class="shine__animate-link">
                                            <img src="${courseThumbnail}" alt="img">
                                        </a>
                                    </div>
                                    <div class="courses__item-content courses__item-content-two">
                                        <h5 class="title">
                                            <a href="/student/classroom/course/${course.id}">${course.name}</a>
                                        </h5>
                                        <p class="course-description">${courseDescription}</p>
                                        <div class="courses__item-content-bottom">
                                            <div class="author-two">
                                                <a href="javascript:void(0)">
                                                    <img src="${authorImage}" alt="img">${course.teacher}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="courses__item-bottom-two">
                                        <ul class="list-wrap">
                                            <li><i class="flaticon-book"></i>${course.limit} Students Limit</li>
                                            <li><i class="flaticon-mortarboard"></i>${course.total_user} Students</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>`;

                            $('#courses-container').append(courseHtml);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }

        $(document).ready(function() {
            const userId = {{ auth()->user()->id }};
            loadClassroomData(userId);
        });

        document.getElementById('joinClassButton').addEventListener('click', function() {
            const joinButton = document.getElementById('joinClassButton');
            joinButton.disabled = true;

            Swal.fire({
                title: 'Masukkan Kode Kelas',
                input: 'text',
                inputLabel: 'Kode kelas',
                inputPlaceholder: 'Masukkan kode kelas',
                showCancelButton: true,
                confirmButtonText: 'Bergabung',
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Kode kelas tidak boleh kosong!';
                    }
                },
                position: 'top',
                toast: false,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                didOpen: () => {
                    Swal.getPopup().style.top = '20px';
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const classCode = result.value;
                    const userId = @json(auth()->user()->id);

                    fetch('/api/classroom/join', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            user_id: userId,
                            classroom_code: classCode,
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        joinButton.disabled = false;

                        if (data.message === 'Bergabung dengan kelas berhasil.') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Bergabung',
                                text: 'Anda telah bergabung dengan kelas menggunakan kode: ' + classCode,
                                position: 'top',
                                toast: false,
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            });

                            loadClassroomData(userId);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Bergabung',
                                text: data.message,
                                position: 'top',
                                toast: false,
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            });
                        }
                    })
                    .catch(error => {
                        joinButton.disabled = false;

                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal mengirim data. Coba lagi nanti.',
                            position: 'top',
                            toast: false,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        });
                    });
                } else {
                    joinButton.disabled = false;
                }
            });
        });
    </script>

@endsection

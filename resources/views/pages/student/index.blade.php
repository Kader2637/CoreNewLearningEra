@extends('layouts.student.app')
@section('content')
    <div class="col">
        <div class="dashboard__count-wrap">
            <div class="dashboard__content-title">
                <h4 class="title">Dashboard</h4>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Bagian kiri -->
                                <div class="col-12 col-md-8">
                                    <div class="flex-wrap gap-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ asset('logoCopy.png') }}" width="70px" alt="Logo" />
                                        </div>
                                        <h4 class="mt-2 text-center mt-md-4">
                                            Selamat datang {{ auth()->user()->name }}
                                        </h4>
                                    </div>
                                </div>
                                <!-- Bagian kanan -->
                                <div class="col-12 col-md-4">
                                    <p class="mt-2 text-end text-success mt-md-0">
                                        Kelas yang diikuti: <span id="count">0</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="mt-4 progress__courses-wrap">
        <div class="dashboard__content-title">
            <h4 class="title">Kelas</h4>
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

                            const courseThumbnail = course.thumbnail ? `/storage/${course.thumbnail}` :
                                '/assets/user.png';
                            const authorImage = user.profile ? `/storage/${user.profile}` : '/user.png';
                            const courseDescription = course.description.length > 80 ? course
                                .description.substring(0, 80) + '...' : course.description;

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

        function fetchCount(userId) {
            $.ajax({
                url: `/api/count/student/${userId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#count').text(response.count);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX call failed:', textStatus, errorThrown);
                    showAlert('Kesalahan saat mengambil data.', 'danger');
                }
            });
        }
        $(document).ready(function() {
            const userId = {{ auth()->user()->id }};
            loadClassroomData(userId);
            fetchCount(userId);
        });
    </script>
@endsection

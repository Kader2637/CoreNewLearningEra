@extends('layouts.teacher.app')
@section('content')
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card fun">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body me-3">
                            <h2 class="num-text text-black font-w600" id="countTeacher"></h2>
                            <span class="fs-14">Total Guru</span>
                        </div>
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M34.4221 13.9831C34.3342 13.721 34.1756 13.4884 33.9639 13.3108C33.7521 13.1332 33.4954 13.0175 33.2221 12.9766L23.6491 11.5141L19.3531 2.36408C19.232 2.10638 19.04 1.88849 18.7996 1.73587C18.5592 1.58325 18.2803 1.5022 17.9956 1.5022C17.7108 1.5022 17.432 1.58325 17.1916 1.73587C16.9512 1.88849 16.7592 2.10638 16.6381 2.36408L12.3421 11.5141L2.76908 12.9766C2.49641 13.0181 2.24048 13.1341 2.02943 13.3117C1.81837 13.4892 1.66036 13.7215 1.57277 13.9831C1.48517 14.2446 1.47139 14.5253 1.53293 14.7941C1.59447 15.063 1.72895 15.3097 1.92158 15.5071L8.89808 22.6501L7.24808 32.7571C7.20306 33.0345 7.23685 33.3189 7.34561 33.578C7.45437 33.8371 7.63373 34.0605 7.86325 34.2226C8.09277 34.3847 8.36321 34.4791 8.64377 34.495C8.92432 34.5109 9.20371 34.4477 9.45008 34.3126L18.0001 29.5906L26.5501 34.3126C26.7965 34.4489 27.0762 34.5131 27.3573 34.4978C27.6385 34.4826 27.9097 34.3885 28.1399 34.2264C28.37 34.0643 28.55 33.8406 28.659 33.5811C28.7681 33.3215 28.8019 33.0365 28.7566 32.7586L27.1066 22.6516L34.0786 15.5071C34.2703 15.3091 34.4038 15.0622 34.4644 14.7933C34.525 14.5245 34.5103 14.2441 34.4221 13.9831Z"
                                fill="#2953E8" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card fun">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body me-3">
                            <h2 class="num-text text-black font-w600" id="countClassroom"></h2>
                            <span class="fs-14">Total Kelas</span>
                        </div>
                        <svg width="46" height="46" viewBox="0 0 46 46" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M34.4998 1.91666H11.4998C8.95911 1.9197 6.52332 2.93035 4.72676 4.72691C2.93019 6.52348 1.91955 8.95927 1.9165 11.5V26.8333C1.91929 29.0417 2.68334 31.1816 4.07988 32.8924C5.47642 34.6031 7.42004 35.7801 9.58317 36.225V42.1667C9.58312 42.5137 9.67727 42.8542 9.85558 43.1518C10.0339 43.4495 10.2897 43.6932 10.5956 43.8569C10.9016 44.0206 11.2462 44.0982 11.5928 44.0814C11.9394 44.0645 12.2749 43.9539 12.5636 43.7613L23.5748 36.4167H34.4998C37.0406 36.4136 39.4764 35.403 41.2729 33.6064C43.0695 31.8098 44.0801 29.374 44.0832 26.8333V11.5C44.0801 8.95927 43.0695 6.52348 41.2729 4.72691C39.4764 2.93035 37.0406 1.9197 34.4998 1.91666ZM30.6665 24.9167H15.3332C14.8248 24.9167 14.3373 24.7147 13.9779 24.3553C13.6184 23.9958 13.4165 23.5083 13.4165 23C13.4165 22.4917 13.6184 22.0041 13.9779 21.6447C14.3373 21.2853 14.8248 21.0833 15.3332 21.0833H30.6665C31.1748 21.0833 31.6623 21.2853 32.0218 21.6447C32.3812 22.0041 32.5832 22.4917 32.5832 23C32.5832 23.5083 32.3812 23.9958 32.0218 24.3553C31.6623 24.7147 31.1748 24.9167 30.6665 24.9167ZM34.4998 17.25H11.4998C10.9915 17.25 10.504 17.0481 10.1446 16.6886C9.78511 16.3292 9.58317 15.8417 9.58317 15.3333C9.58317 14.825 9.78511 14.3375 10.1446 13.978C10.504 13.6186 10.9915 13.4167 11.4998 13.4167H34.4998C35.0082 13.4167 35.4957 13.6186 35.8551 13.978C36.2146 14.3375 36.4165 14.825 36.4165 15.3333C36.4165 15.8417 36.2146 16.3292 35.8551 16.6886C35.4957 17.0481 35.0082 17.25 34.4998 17.25Z"
                                fill="#2953E8" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3 class="mb-4">
        Kelas saya
    </h3>
    <div class="row mt-3" id="data-teacher">
    </div>
    <div id="no-data-message" style="display: none;">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('no-data.png') }}" width="200px" alt="">
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
@endsection
@section('script')
    <script>
        const fetchClassData = () => {
            const authId = '{{ auth()->user()->id }}';
            $('#loading').show();
            $('#data-teacher').hide();

            $.ajax({
                url: `/api/my/classroom/teacher/data/${authId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#loading').hide();
                    let rows = '';
                    if (response.data.length > 0) {
                        response.data.forEach((kelas) => {
                            const thumbnailUrl = `{{ asset('storage') }}/${kelas.thumbnail}`;

                            const truncatedDescription = kelas.description.length > 70 ?
                                kelas.description.substring(0, 70) + '...' :
                                kelas.description;

                            rows += `
                                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                        <div class="card courses__item shine__animate-item">
                                            <a href="#" class="shine__animate-link">
                                                <img src="${thumbnailUrl}" alt="${kelas.name}" class="card-img-top"  style="object-fit:cover"/>
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="#" class="text-dark">${kelas.name}</a>
                                                </h5>
                                                <p>
                                                    ${truncatedDescription}
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <a href="/teacher/classroom/course/${kelas.id}" class="btn btn-primary w-100">
                                                        Masuk
                                                        <i class="flaticon-arrow-right ms-2"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                        });
                        $('#data-teacher').html(rows).show();
                        $('#no-data-message').hide();
                    } else {
                        $('#data-teacher').hide();
                        $('#no-data-message').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                    $('#loading').hide();
                }
            });
        };

        function fetchCount() {
            const authId = '{{ auth()->user()->id }}';
            $.ajax({
                url: `/api/count/statistika/${authId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#countTeacher').text(response.countTeacher);
                    $('#countClassroom').text(response.countClassroom);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX call failed:', textStatus, errorThrown);
                    showAlert('Kesalahan saat mengambil data.', 'danger');
                }
            });
        }

        $(document).ready(function() {
            fetchClassData();
            fetchCount();
        });
    </script>
@endsection

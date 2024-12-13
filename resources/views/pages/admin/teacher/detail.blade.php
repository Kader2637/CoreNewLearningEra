@extends('layouts.admin.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-xl-4 col-sm-7 box-col-3">
                <h3>Detail Teacher</h3>
            </div>
            <div class="col-5 d-none d-xl-block">
            </div>
            @if ($user->status == 'pending')
                <div class="col-xl-3 d-flex justify-content-end col-sm-5 box-col-4">
                    <div class="d-flex gap-2">
                        <button class="btn btn-danger w-100 reject-button-user" data-id="{{ $user->id }}">
                            Tolak
                        </button>
                        <button class="btn btn-info w-100 accept-button-user" data-id="{{ $user->id }}">
                            Terima
                        </button>
                    </div>
                </div>
            @elseif ($user->status == 'accept')
                <div class="col-xl-3 d-flex justify-content-end col-sm-5 box-col-4">
                    <a href="/admin/teacher" class="btn btn-secondary">Kembali</a>
                </div>
            @else
                <div class="col-xl-3 d-flex justify-content-end col-sm-5 box-col-4">
                    <a href="/admin/teacher" class="btn btn-secondary">Kembali</a>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-center bg-info">
                <div class="profile-img-style">
                    <div class="text-end px-3 mt-2">
                        @if ($user->status == 'accept')
                            Status User : Diterima
                        @elseif ($user->status == 'pending')
                            Status User : Menunggu
                        @else
                            Status User : Ditolak
                        @endif
                    </div>
                    <img class="img-thumbnail rounded-circle mb-0" src="{{ asset('storage/' . $user->image) }}"
                        style="width: 100px; height: 100px; object-fit: cover; margin: 20px auto;" alt="Teacher">
                    <div class="card-body bg-info text-white">
                        <h5 class="mt-0 user-name text-white">{{ $user->name }}</h5>
                        <h6 class="text-white">{{ $user->role }}</h6>
                        <div class="row mt-3">
                            <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-start">
                                            <h6 class="text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2zm-2 0l-8 5l-8-5zm0 12H4V8l8 5l8-5z" />
                                                </svg>
                                                Email
                                            </h6><span>{{ $user->email }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-start">
                                            <h6 class="text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                                                </svg> Jenis kelamin
                                            </h6><span>{{ $user->gender }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                <div class="user-designation">
                                    <div class="title"><a target="_blank" href="#"></a></div>
                                    <div class="desc"></div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-start">
                                            <h6 class="text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M16 3h1v5h-1zm-1 2h-2V4h2V3h-3v3h2v1h-2v1h3zm3-2v5h1V6h2V3zm2 2h-1V4h1zm0 10.5c-1.25 0-2.45-.2-3.57-.57a.98.98 0 0 0-1.01.24l-2.2 2.2a15.05 15.05 0 0 1-6.59-6.59l2.2-2.21c.27-.26.35-.65.24-1A11.4 11.4 0 0 1 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1c0 9.39 7.61 17 17 17c.55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1M5.03 5h1.5c.07.88.22 1.75.46 2.59L5.79 8.8c-.41-1.21-.67-2.48-.76-3.8M19 18.97c-1.32-.09-2.59-.35-3.8-.75l1.2-1.2c.85.24 1.71.39 2.59.45v1.5z" />
                                                </svg> No Telephone
                                            </h6><span>{{ $user->no_telephone }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-start">
                                            <h6 class="text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7M7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9" />
                                                    <circle cx="12" cy="9" r="2.5" fill="currentColor" />
                                                </svg>
                                                Alamat
                                            </h6><span>
                                                {{ $user->address }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h5 class="text-dark">
        Kelas Saya
    </h5>
    <div class="row mt-3" id="data-teacher">
    </div>
    <div id="no-data-message">

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
            const authId = '{{ $user->id }}';
            $('#loading').show();

            $.ajax({
                url: `/api/classroom/teacher/data/${authId}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    let rows = '';
                    if (response.data.length > 0) {
                        response.data.forEach((kelas, index) => {
                            const thumbnailUrl = `{{ asset('storage') }}/${kelas.thumbnail}`;

                            let statusText;
                            switch (kelas.status) {
                                case 'pending':
                                    statusText = 'Menunggu';
                                    break;
                                case 'reject':
                                    statusText = 'Ditolak';
                                    break;
                                case 'accept':
                                    statusText = 'Disetujui';
                                    break;
                                default:
                                    statusText = 'Tidak Diketahui';
                            }

                            const shortDescription = kelas.description.length > 188 ?
                                kelas.description.substring(0, 188) + '...' :
                                kelas.description;

                            rows += `
                    <div class="col-xxl-4 col-lg-4 box-col-33 col-md-6">
                        <div class="project-box">
                            <div class="d-flex justify-content-between">
                                <h3 class="f-w-600">${kelas.name}</h3>
                                <p>Kode Kelas : ${kelas.codeClass}</p>
                            </div>
                            <p>${shortDescription}</p>
                            <div class="row details">
                                <div class="col-6"><span>Limit siswa</span></div>
                                <div class="col-6 font-secondary">${kelas.limit}</div>
                                <div class="col-6"><span>Total siswa</span></div>
                                <div class="col-6 font-secondary">${kelas.total_user}</div>
                                <div class="col-6"><span>Status kelas</span></div>
                                <div class="col-6 font-secondary">${kelas.statusClass}</div>
                                <div class="col-6"><span>Status</span></div>
                                <div class="col-6 font-secondary">${statusText}</div>
                            </div>
                            <div class="mt-3">
                                <a href="/admin/classroom/detail/${kelas.id}" class="btn btn-info me-2 w-100" data-id="${kelas.id}">Detail</a>
                        </div>
                    </div>
                </div>
                    `;
                        });
                        $('#data-teacher').html(rows);
                        $('#no-data-message').hide();
                    } else {
                        $('#no-data-message').html(`
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('no-data.png') }}" width="200px" alt=""> <br>
                    </div>
                    <h3 class="text-center">Data Masih Kosong</h3>
                `);
                    }
                    $('#loading').hide();
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                    $('#loading').hide();
                }
            });
        };

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
        $('.accept-button-user').off('click').on('click', function() {
            const userId = $(this).data('id');
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menerima pengguna ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, terima!',
                cancelButtonText: 'Tidak, batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    acceptUser(userId);
                }
            });
        });

        $('.reject-button-user').off('click').on('click', function() {
            const userId = $(this).data('id');
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menolak pengguna ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, tolak!',
                cancelButtonText: 'Tidak, batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    rejectUser(userId);
                }
            });
        });

        function acceptUser(userId) {
            $('#loader').show();

            $.ajax({
                url: `/api/accept/${userId}`,
                method: 'POST',
                dataType: 'json',
                success: function(response) {
                    showAlert('User berhasil diterima', 'success');
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
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
                    showAlert('User berhasil ditolak', 'success');
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showAlert('Kesalahan saat menolak pengguna.', 'danger');
                }
            });
        }

        $(document).ready(function() {


            fetchClassData();
        });
    </script>
@endsection

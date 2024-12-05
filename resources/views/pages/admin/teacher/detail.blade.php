@extends('layouts.admin.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-xl-4 col-sm-7 box-col-3">
                <h3>Detail Teacher</h3>
            </div>
            <div class="col-5 d-none d-xl-block">

            </div>
            <div class="col-xl-3 d-flex justify-content-end col-sm-5 box-col-4">
                <div class="d-flex gap-2">
                    <button class="btn btn-danger">
                        Tolak
                    </button>

                    <button class="btn btn-success">
                        Terima
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-center bg-info">
                <div class="profile-img-style">
                    <img class="img-thumbnail rounded-circle mb-0" src="{{ asset('assets/img/others/kader.png') }}"
                        style="width: 100px; height: 100px; object-fit: cover; margin: 20px auto;" alt="Teacher">
                    <div class="card-body bg-info text-white">
                        <h5 class="mt-0 user-name">Abdul Kader</h5>
                        <h6>Teacher</h6>
                        <div class="row">
                            <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ttl-info text-start">
                                            <h6>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2zm-2 0l-8 5l-8-5zm0 12H4V8l8 5l8-5z" />
                                                </svg>
                                                Email
                                            </h6><span>abdulkader0126@gmail.com</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-start">
                                            <h6>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20a2 2 0 0 0 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 16H5V10h14zM9 14H7v-2h2zm4 0h-2v-2h2zm4 0h-2v-2h2zm-8 4H7v-2h2zm4 0h-2v-2h2zm4 0h-2v-2h2z" />
                                                </svg> Tanggal Lahir
                                            </h6><span>01 January 2006</span>
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
                                            <h6>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M16 3h1v5h-1zm-1 2h-2V4h2V3h-3v3h2v1h-2v1h3zm3-2v5h1V6h2V3zm2 2h-1V4h1zm0 10.5c-1.25 0-2.45-.2-3.57-.57a.98.98 0 0 0-1.01.24l-2.2 2.2a15.05 15.05 0 0 1-6.59-6.59l2.2-2.21c.27-.26.35-.65.24-1A11.4 11.4 0 0 1 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1c0 9.39 7.61 17 17 17c.55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1M5.03 5h1.5c.07.88.22 1.75.46 2.59L5.79 8.8c-.41-1.21-.67-2.48-.76-3.8M19 18.97c-1.32-.09-2.59-.35-3.8-.75l1.2-1.2c.85.24 1.71.39 2.59.45v1.5z" />
                                                </svg> No Telephone
                                            </h6><span>India +91
                                                08927278273823</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ttl-info text-start">
                                            <h6>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7M7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9" />
                                                    <circle cx="12" cy="9" r="2.5" fill="currentColor" />
                                                </svg>
                                                Alamat
                                            </h6><span>
                                                Jawa timur Probolinggo</span>
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
    <div class="row mt-3">
        <div class="col-xxl-4 col-lg-4 box-col-33 col-md-6">
            <div class="project-box">
                <h3 class="f-w-600">Pemrograman </h3>
                <div class="d-flex"><img class="img-20 me-2 rounded-circle" src="{{ asset('assets/img/others/kader.png') }}"
                        alt="" data-original-title="" title="">
                    <div class="flex-grow-1">
                        <p class="mb-0">abdulkader0126@gmail.com</p>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt rerum, necessitatibus sed corrupti
                    dolor maxime.</p>
                <div class="row details">
                    <div class="col-6"><span>Materi </span></div>
                    <div class="col-6 font-secondary">12 </div>
                    <div class="col-6"> <span>Student</span></div>
                    <div class="col-6 font-secondary">5</div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-info w-100">Detail</button>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-lg-4 box-col-33 col-md-6">
            <div class="project-box">
                <h3 class="f-w-600">Pemrograman </h3>
                <div class="d-flex"><img class="img-20 me-2 rounded-circle" src="{{ asset('assets/img/others/kader.png') }}"
                        alt="" data-original-title="" title="">
                    <div class="flex-grow-1">
                        <p class="mb-0">abdulkader0126@gmail.com</p>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt rerum, necessitatibus sed corrupti
                    dolor maxime.</p>
                <div class="row details">
                    <div class="col-6"><span>Materi </span></div>
                    <div class="col-6 font-secondary">12 </div>
                    <div class="col-6"> <span>Student</span></div>
                    <div class="col-6 font-secondary">5</div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-info w-100">Detail</button>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-lg-4 box-col-33 col-md-6">
            <div class="project-box">
                <h3 class="f-w-600">Pemrograman </h3>
                <div class="d-flex"><img class="img-20 me-2 rounded-circle"
                        src="{{ asset('assets/img/others/kader.png') }}" alt="" data-original-title=""
                        title="">
                    <div class="flex-grow-1">
                        <p class="mb-0">abdulkader0126@gmail.com</p>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt rerum, necessitatibus sed corrupti
                    dolor maxime.</p>
                <div class="row details">
                    <div class="col-6"><span>Materi </span></div>
                    <div class="col-6 font-secondary">12 </div>
                    <div class="col-6"> <span>Student</span></div>
                    <div class="col-6 font-secondary">5</div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-info w-100">Detail</button>
                </div>
            </div>
        </div>
    </div>
@endsection

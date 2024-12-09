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
        <div class="row project-cards">
            <div class="col-md-12 project-list">
                <div class="card">
                    <div class="row">
                        <div class="p-0 col-md-6">
                            <ul class="nav nav-tabs border-tab d-flex" id="top-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab"
                                        href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i
                                            data-feather="target"></i>All</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab"
                                        href="#top-profile" role="tab" aria-controls="top-profile"
                                        aria-selected="false"><i data-feather="info"></i>Menunggu Approval</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab"
                                        href="#top-contact" role="tab" aria-controls="top-contact"
                                        aria-selected="false"><i data-feather="check-circle"></i>Ditolak</a>
                                </li>
                            </ul>
                        </div>
                        <div class="p-0 col-md-6">
                            <div class="mb-0 form-group me-0"></div><a class="btn btn-primary" href="#"> <i
                                    data-feather="plus-square"> </i>Tambah Kelas</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-home" role="tabpanel"
                                aria-labelledby="top-home-tab">
                                <div class="row">
                                    <div class="col-xxl-4 col-lg-4 box-col-33 col-md-6">
                                        <div class="project-box">
                                            <h3 class="f-w-600">Pemrograman </h3><span class="badge badge-primary">Admin</span>
                                            <div class="d-flex"><img class="img-20 me-2 rounded-circle"
                                                    src="{{ asset('assets/img/others/kader.png') }}" alt="" data-original-title=""
                                                    title="">
                                                <div class="flex-grow-1">
                                                    <p class="mb-0">abdulkader0126@gmail.com</p>
                                                </div>
                                            </div>
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt rerum, necessitatibus sed corrupti dolor maxime.</p>
                                            <div class="row details">
                                                <div class="col-6"><span>Materi </span></div>
                                                <div class="col-6 font-secondary">12 </div>
                                                <div class="col-6"> <span>Student</span></div>
                                                <div class="col-6 font-secondary">5</div>
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
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt rerum, necessitatibus sed corrupti dolor maxime.</p>
                                            <div class="row details">
                                                <div class="col-6"><span>Materi </span></div>
                                                <div class="col-6 font-secondary">12 </div>
                                                <div class="col-6"> <span>Student</span></div>
                                                <div class="col-6 font-secondary">5</div>
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
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt rerum, necessitatibus sed corrupti dolor maxime.</p>
                                            <div class="row details">
                                                <div class="col-6"><span>Materi </span></div>
                                                <div class="col-6 font-secondary">12 </div>
                                                <div class="col-6"> <span>Student</span></div>
                                                <div class="col-6 font-secondary">5</div>
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
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt rerum, necessitatibus sed corrupti dolor maxime.</p>
                                            <div class="row details">
                                                <div class="col-6"><span>Materi </span></div>
                                                <div class="col-6 font-secondary">12 </div>
                                                <div class="col-6"> <span>Student</span></div>
                                                <div class="col-6 font-secondary">5</div>
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
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt rerum, necessitatibus sed corrupti dolor maxime.</p>
                                            <div class="row details">
                                                <div class="col-6"><span>Materi </span></div>
                                                <div class="col-6 font-secondary">12 </div>
                                                <div class="col-6"> <span>Student</span></div>
                                                <div class="col-6 font-secondary">5</div>
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
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt rerum, necessitatibus sed corrupti dolor maxime.</p>
                                            <div class="row details">
                                                <div class="col-6"><span>Materi </span></div>
                                                <div class="col-6 font-secondary">12 </div>
                                                <div class="col-6"> <span>Student</span></div>
                                                <div class="col-6 font-secondary">5</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-profile" role="tabpanel"
                                aria-labelledby="profile-top-tab">
                                <div class="row">
                                    <div class="col-xxl-4 col-lg-4 box-col-33 col-md-6">
                                        <div class="project-box">
                                            <h3 class="f-w-600">Pemrograman </h3><span class="badge badge-warning">Menunggu</span>
                                            <div class="d-flex"><img class="img-20 me-2 rounded-circle"
                                                    src="{{ asset('assets/img/others/kader.png') }}" alt="" data-original-title=""
                                                    title="">
                                                <div class="flex-grow-1">
                                                    <p class="mb-0">abdulkader0126@gmail.com</p>
                                                </div>
                                            </div>
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt rerum, necessitatibus sed corrupti dolor maxime.</p>
                                            <div class="row details">
                                                <div class="col-6"><span>Materi </span></div>
                                                <div class="col-6 font-secondary">12 </div>
                                                <div class="col-6"> <span>Student</span></div>
                                                <div class="col-6 font-secondary">5</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-lg-4 box-col-33 col-md-6">
                                        <div class="project-box">
                                            <h3 class="f-w-600">Pemrograman </h3><span class="badge badge-warning">Menunggu</span>
                                            <div class="d-flex"><img class="img-20 me-2 rounded-circle"
                                                    src="{{ asset('assets/img/others/kader.png') }}" alt="" data-original-title=""
                                                    title="">
                                                <div class="flex-grow-1">
                                                    <p class="mb-0">abdulkader0126@gmail.com</p>
                                                </div>
                                            </div>
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt rerum, necessitatibus sed corrupti dolor maxime.</p>
                                            <div class="row details">
                                                <div class="col-6"><span>Materi </span></div>
                                                <div class="col-6 font-secondary">12 </div>
                                                <div class="col-6"> <span>Student</span></div>
                                                <div class="col-6 font-secondary">5</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-lg-4 box-col-33 col-md-6">
                                        <div class="project-box">
                                            <h3 class="f-w-600">Pemrograman </h3><span class="badge badge-warning">Menunggu</span>
                                            <div class="d-flex"><img class="img-20 me-2 rounded-circle"
                                                    src="{{ asset('assets/img/others/kader.png') }}" alt="" data-original-title=""
                                                    title="">
                                                <div class="flex-grow-1">
                                                    <p class="mb-0">abdulkader0126@gmail.com</p>
                                                </div>
                                            </div>
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt rerum, necessitatibus sed corrupti dolor maxime.</p>
                                            <div class="row details">
                                                <div class="col-6"><span>Materi </span></div>
                                                <div class="col-6 font-secondary">12 </div>
                                                <div class="col-6"> <span>Student</span></div>
                                                <div class="col-6 font-secondary">5</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-contact" role="tabpanel"
                                aria-labelledby="contact-top-tab">
                                <div class="row">
                                    <div class="col-xxl-4 col-lg-4 box-col-33 col-md-6">
                                        <div class="project-box">
                                            <h3 class="f-w-600">Pemrograman </h3><span class="badge badge-secondary">Ditolak</span>
                                            <div class="d-flex"><img class="img-20 me-2 rounded-circle"
                                                    src="{{ asset('assets/img/others/kader.png') }}" alt="" data-original-title=""
                                                    title="">
                                                <div class="flex-grow-1">
                                                    <p class="mb-0">abdulkader0126@gmail.com</p>
                                                </div>
                                            </div>
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt rerum, necessitatibus sed corrupti dolor maxime.</p>
                                            <div class="row details">
                                                <div class="col-6"><span>Materi </span></div>
                                                <div class="col-6 font-secondary">12 </div>
                                                <div class="col-6"> <span>Student</span></div>
                                                <div class="col-6 font-secondary">5</div>
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
    </div>
@endsection

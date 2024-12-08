@extends('layouts.teacher.app')
@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h4>Detail Kelas <span id="class-name1"></span></h4>
        <div>
            <a href="{{ route('classroom.teacher') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="class-profile card card-body px-3 pt-3 pb-0">
                <div class="class-header">
                    <div class="class-photo-content">
                        <div class="cover-photo"></div>
                    </div>
                    <div class="class-info">
                        <div class="cover-photo" style="width: 100%; overflow: hidden;">
                            <img src="" id="class-thumbnail" class="img-fluid rounded" alt="Class Thumbnail"
                                style="object-fit: contai; width: 100%; height: 300px;">
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <h4 class="text-center" id="class-name">Loading class name...</h4>
                        <p id="class-description" style="text-align: justify;">Loading description...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <div class="">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a href="#course" data-bs-toggle="tab" class="nav-link active show">Materi</a>
                </li>
                <li class="nav-item"><a href="#student" data-bs-toggle="tab" class="nav-link">Siswa</a>
                </li>
                <li class="nav-item"><a href="#approval" data-bs-toggle="tab" class="nav-link">Approval</a>
                </li>
            </ul>
        </div>
        <div>
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addMaterialModal">Tambah
                Materi</button>
        </div>
    </div>
    <div class="tab-content">
        <div id="course" class="tab-pane fade active show">
            <div id="materialCards" class="row mt-4 mb-5"></div>
        </div>
        <div id="student" class="tab-pane fade">
            <div class="row mt-4 mb-5" id="student-list">
            </div>
        </div>
        <div id="approval" class="tab-pane fade">
            <div class="row mt-4 mb-5" id="student-pending">

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addMaterialModal" tabindex="-1" aria-labelledby="addMaterialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMaterialModalLabel">Tambah Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="materialForm">
                        <div class="mb-3">
                            <input type="hidden" name="classroom_id" value="{{ $id }}">
                            <label for="materialName" class="form-label">Nama Materi</label>
                            <input type="text" class="form-control" id="materialName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="materialDescription" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="materialDescription" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="materialType" class="form-label">Tipe Materi</label>
                            <select class="form-select" id="materialType" name="type" required>
                                <option value="">Pilih Tipe</option>
                                <option value="document">Dokumen</option>
                                <option value="link">Link</option>
                                <option value="text_course">Text Course</option>
                            </select>
                        </div>
                        <div id="additionalInput"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="materialForm">Simpan Materi</button>
                </div>
            </div>
        </div>
    </div>
    @include('components.modal-delete')
    @include('components.teacher.kick')
    @include('components.teacher.accept')
    @include('components.teacher.reject')
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('pages.teacher.course.ajaxCourseindex')
@endsection

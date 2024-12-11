@extends('layouts.admin.app')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-xl-4 col-sm-7 box-col-3">
            <h3>Tugas</h3>
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
                <li class="breadcrumb-item active">Tugas</li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h4>Detail Tugas <span id="task-name">{{ $taskCourse->name }} </span></h4>
        <div>
            <a href="/teacher/course/detail/{{ $taskCourse->course_id }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </div>

    <!-- Lampiran Tugas dan Deskripsi -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body px-3 pt-3 pb-0">
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <h5>Lampiran Tugas &amp; Deskripsi</h5>
                        <p>
                            Deadline: {{ \Carbon\Carbon::parse($taskCourse->deadline)->locale('id')->diffForHumans() }}
                        </p>

                    </div>
                    <p>
                        {{ $taskCourse->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Siswa yang Mengumpulkan -->
    <div id="submitted" class="mt-4" style="background-color: #ffffff; border-radius: 8px; padding: 20px;">
        <h5>Siswa yang Mengumpulkan</h5>
        <p>Berikut adalah daftar siswa yang sudah mengumpulkan tugas. Anda bisa memberikan nilai langsung di sini.</p>
        <table class="table table-bordered" id="submitted-table" style="border-color: rgba(0, 0, 0, 0.125);">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Nilai</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Rudi</td>
                    <td><input type="number" class="form-control" value="80"></td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">Sudah Dinilai</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Siti</td>
                    <td><input type="number" class="form-control" value="85"></td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">Sudah Dinilai</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Andi</td>
                    <td><input type="number" class="form-control" value="90"></td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">Sudah Dinilai</button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Budi</td>
                    <td><input type="number" class="form-control" value="78"></td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">Sudah Dinilai</button>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Ana</td>
                    <td><input type="number" class="form-control" value="88"></td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">Sudah Dinilai</button>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Tina</td>
                    <td><input type="number" class="form-control" value="75"></td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">Sudah Dinilai</button>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Deni</td>
                    <td><input type="number" class="form-control" value="92"></td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">Sudah Dinilai</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            <button class="btn btn-secondary btn-sm" id="prevBtn">Kembali</button>
            <button class="btn btn-secondary btn-sm" id="nextBtn">Lanjut</button>
        </div>
    </div>

    <!-- Daftar Siswa yang Belum Mengumpulkan -->
    <div id="not-submitted" class="mt-4" style="background-color: #ffffff; border-radius: 8px; padding: 20px;">
        <h5>Siswa yang Belum Mengumpulkan</h5>
        <p>Berikut adalah daftar siswa yang belum mengumpulkan tugas. Anda dapat menandai siswa-siswa ini setelah mereka mengumpulkan tugas.</p>
        <table class="table table-bordered" id="not-submitted-table" style="border-color: rgba(0, 0, 0, 0.125);">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Juli</td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">Belum Dinilai</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Romi</td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">Belum Dinilai</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            <button class="btn btn-secondary btn-sm" id="prevBtnNotSubmitted">Kembali</button>
            <button class="btn btn-secondary btn-sm" id="nextBtnNotSubmitted">Lanjut</button>
        </div>
    </div>

</div>
@endsection

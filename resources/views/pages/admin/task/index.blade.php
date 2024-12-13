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
    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTaskModalLabel">Buat Tugas Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createTaskForm" enctype="multipart/form-data">
                        <input type="hidden" value="3" name="user_id">

                        <div class="mb-3">
                            <label for="taskTitle" class="form-label">Judul Tugas</label>
                            <input type="text" class="form-control" id="taskTitle" name="title" placeholder="Masukkan judul tugas">
                        </div>

                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">Deskripsi Tugas</label>
                            <textarea class="form-control" id="taskDescription" name="description" rows="3" placeholder="Masukkan deskripsi tugas"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="taskDueDate" class="form-label">Tanggal Deadline</label>
                            <input type="date" class="form-control" id="taskDueDate" name="due_date">
                        </div>

                        <div class="mb-3">
                            <label for="taskFile" class="form-label">File Lampiran</label>
                            <input type="file" class="form-control" id="taskFile" name="file">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Buat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Edit Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateTaskForm" enctype="multipart/form-data">
                        <input type="hidden" value="3" name="user_id">
                        <input type="hidden" id="editTaskId" name="task_id">
                        <input type="hidden" name="_method" value="PUT">

                        <div class="mb-3">
                            <label for="taskTitle" class="form-label">Judul Tugas</label>
                            <input type="text" class="form-control" id="taskTitle" name="title" placeholder="Masukkan judul tugas">
                        </div>

                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">Deskripsi Tugas</label>
                            <textarea class="form-control" id="taskDescription" name="description" rows="3" placeholder="Masukkan deskripsi tugas"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="taskDueDate" class="form-label">Tanggal Deadline</label>
                            <input type="date" class="form-control" id="taskDueDate" name="due_date">
                        </div>

                        <div class="mb-3">
                            <label for="taskFile" class="form-label">File Lampiran</label>
                            <input type="file" class="form-control" id="taskFile" name="file">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="d-lg-flex d-block mb-3 pb-3 border-bottom" style="margin-top: 20px;"> <!-- Menambahkan margin-top -->
        <div class="card-tabs mb-lg-0 mb-3 me-auto">
            <a class="text-black fs-3">Semua Tugas</a>
        </div>
        <div>
            <button type="button" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#createTaskModal">
                Buat Tugas Baru
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="filterTask" class="form-label text-black font-w500">Filter Berdasarkan Tugas:</label>
                <select id="filterTask" class="form-select">
                    <option value="all">Semua Tugas</option>
                    <option value="taskA">Tugas A</option>
                    <option value="taskB">Tugas B</option>
                    <option value="taskC">Tugas C</option>
                </select>
            </div>

            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table table-hover table-bordered text-nowrap" style="white-space: nowrap; table-layout: auto; width: 100%; background-color: white;">
                    <thead>
                        <tr>
                            <th style="padding: 15px;">No</th>
                            <th style="padding: 15px;">Nama Materi</th>
                            <th style="padding: 15px;">Judul Tugas</th>
                            <th style="padding: 15px;">Tanggal Deadline</th>
                            <th style="padding: 15px;">Lampiran</th>
                            <th style="padding: 15px;">Status</th>
                            <th style="padding: 15px;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 15px;">1</td>
                            <td style="padding: 15px;">Tugas Matematika</td>
                            <td style="padding: 15px;">Tugas Matematika</td>
                            <td style="padding: 15px;">2024-12-15</td>
                            <td style="padding: 15px;"><a href="#">Download File</a></td>
                            <td style="padding: 15px;"><span class="badge bg-success">Aktif</span></td>
                            <td style="padding: 15px;" class="text-center">
                                <a href="{{ route('admin.detailTask') }}" class="btn btn-info btn-sm">Detail</a>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTaskModal">Edit</button>
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

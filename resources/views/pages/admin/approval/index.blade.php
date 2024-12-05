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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Guru Sedang Menunggu Approval</h4>
                </div>
                <div class="table-responsive custom-scrollbar">
                    <table class="table">
                        <thead>
                            <tr class="border-bottom-primary">
                                <th scope="col" class="text-center">Id</th>
                                <th scope="col" class="text-center">Nama</th>
                                <th scope="col" class="text-center">Jenis Kelamin</th>
                                <th scope="col" class="text-center">No Telephone</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-bottom-secondary">
                                <td class="text-center" scope="row">1</td>
                                <td class="text-center"> <img class="img-30 me-2" src="{{ asset('assets/img/others/kader.png') }}" alt="profile">
                                    Abdul Kader
                                </td>
                                <td class="text-center">Laki-Laki</td>
                                <td class="text-center">09876543223</td>
                                <td class="text-center">abdulkader0126@gmail.com</td>
                                <td class="d-flex justify-content-center">
                                    <div class="d-fle gap-2">
                                        <button class="btn btn-info btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="currentColor" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5m0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5"/></svg>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="currentColor" d="M21 19.1H3V5h18zM21 3H3c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2"/><path fill="currentColor" d="M14.59 8L12 10.59L9.41 8L8 9.41L10.59 12L8 14.59L9.41 16L12 13.41L14.59 16L16 14.59L13.41 12L16 9.41z"/></svg>                                        </button>
                                        <button class="btn btn-success btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="currentColor" d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2m0 16H5V5h14zM17.99 9l-1.41-1.42l-6.59 6.59l-2.58-2.57l-1.42 1.41l4 3.99z"/></svg>                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

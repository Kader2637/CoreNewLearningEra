@extends('layouts.student.app')
@section('content')
    <div class="container">
        <h1>Isi materi di sini</h1>
        <a href="{{ route('course') }}" class="btn btn-info">Kembali</a>
        <a href="{{ route('diskusi') }}" class="btn btn-info">Diskusi room</a>
    </div>
@endsection

<?php

use Illuminate\Support\Facades\Route;

Route::get('/register/student', function () {
    return view('auth.StudentRegis');
});

Route::get('/register/teacher', function () {
    return view('auth.TeacherRegis');
});

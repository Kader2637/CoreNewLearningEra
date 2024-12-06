<?php

use Illuminate\Support\Facades\Route;

Route::get('/register/student', function () {
    return view('auth.StudentRegis');
});

Route::get('/register/teacher', function () {
    return view('auth.TeacherRegis');
});

Route::prefix('student')->group(function () {

    Route::get('/dashboard', function () {
        return view('pages.student.index');
    });

    Route::get('/clasroom', function () {
        return view('pages.student.class');
    });

});


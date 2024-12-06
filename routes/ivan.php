<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

Route::get('/register/student', function () {
    return view('auth.StudentRegis');
});

Route::get('/register/teacher', function () {
    return view('auth.TeacherRegis');
})->name('register/teacher');


Route::prefix('student')->middleware([CheckRole::class . ':student'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.student.index');
    })->name('student/dashboard');

    Route::get('/classroom', function () {
        return view('pages.student.class');
    })->name('student/classroom');
});

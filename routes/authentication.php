<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

// login
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware(CheckRole::class);

Route::post('/post/login' , [LoginController::class , 'login']);


Route::get('/testlogin', function () {
    return view('test');
});

// register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/register/student', function () {
    return view('auth.StudentRegis');
})->name('student.register');

Route::get('/register/teacher', function () {
    return view('auth.TeacherRegis');
})->name('teacher.register');

// logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

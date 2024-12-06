<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.LandingPage.index');
});

Route::get('/teacher', function () {
    return view('pages.teacher.dashboard.index');
})->name('teacher');
Route::get('/classroom', function () {
    return view('pages.LandingPage.classroom.index');
});
Route::get('/testlogin', function () {
    return view('test');
});

Route::get('/class', function () {
    return view('pages.teacher.class.class');
});

Route::get('/detail', function () {
    return view('pages.teacher.detailClass.detailClass');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware(CheckRole::class);

Route::post('/post/login' , [LoginController::class , 'login']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


require_once __DIR__ . '/kader.php';
require_once __DIR__ . '/erik.php';
require_once __DIR__ . '/ivan.php';

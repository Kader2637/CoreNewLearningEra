<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.LandingPage.index');
});

Route::get('/teacher', function () {
    return view('pages.teacher.dashboard.index');
});
Route::get('/classroom', function () {
    return view('pages.LandingPage.classroom.index');
});
Route::get('/testlogin', function () {
    return view('test');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


require_once __DIR__ . '/kader.php';
require_once __DIR__ . '/erik.php';
require_once __DIR__ . '/ivan.php';

<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.LandingPage.index');
});


Route::get('/classroom', function () {
    return view('pages.LandingPage.classroom.index');
});
Route::get('/testlogin', function () {
    return view('test');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware(CheckRole::class);

Route::post('/post/login' , [LoginController::class , 'login']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::prefix('teacher')->group(function () {
    Route::get('/', function () {
        return view('pages.teacher.dashboard.index');
    })->name('teacher');

    Route::prefix('classroom')->group(function () {
        Route::get('/', function () {
            return view('pages.teacher.class.class');
        })->name('classroom.teacher');

        Route::get('/detail', function () {
            return view('pages.teacher.detailClass.detailClass');
        })->name('classroom.detail');
    });
});

require_once __DIR__ . '/kader.php';
require_once __DIR__ . '/erik.php';
require_once __DIR__ . '/ivan.php';

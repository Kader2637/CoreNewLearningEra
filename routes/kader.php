<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;


Route::get('/about', function () {
    return view('pages.LandingPage.about.index');
});
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::prefix('admin')->middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard.index');
    })->name('admin.dashboard');

    Route::get('/classroom', function () {
        return view('pages.admin.classroom.index');
    })->name('admin.classroom');

    Route::get('/teacher', function () {
        return view('pages.admin.teacher.index');
    })->name('admin.teacher');

    Route::get('/teacher/detail', function () {
        return view('pages.admin.teacher.detail');
    })->name('admin.teacher.detail');

    Route::get('/approval', function () {
        return view('pages.admin.approval.index');
    })->name('admin.approval');
});

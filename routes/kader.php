<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/about', function () {
    return view('pages.LandingPage.about.index');
});
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard.index');
    });

    Route::get('/classroom', function () {
        return view('pages.admin.classroom.index');
    });

    Route::get('/teacher', function () {
        return view('pages.admin.teacher.index');
    });

    Route::get('/teacher/detail', function () {
        return view('pages.admin.teacher.detail');
    });

    Route::get('/approval', function () {
        return view('pages.admin.approval.index');
    });
});


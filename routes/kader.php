<?php

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
});

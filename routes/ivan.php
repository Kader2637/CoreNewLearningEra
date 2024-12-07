<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;




Route::prefix('student')->middleware([CheckRole::class . ':student'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.student.index');
    })->name('student/dashboard');

    Route::get('/classroom', function () {
        return view('pages.student.class');
    })->name('student/classroom');

    Route::get('/course', function () {
        return view('pages.student.course');
    })->name('course');
});

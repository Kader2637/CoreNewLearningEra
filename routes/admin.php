<?php

use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\TaskCourseController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard.index');
    })->name('admin.dashboard');

    Route::get('/classroom', function () {
        return view('pages.admin.classroom.index');
    })->name('admin.classroom');
    Route::get('/classroom/detail/{id}', [ClassroomController::class , 'detailClassroom']);
    Route::get('/classroom/detail/course/{id}', [ClassroomController::class , 'detailCourse']);

    Route::get('/teacher', function () {
        return view('pages.admin.teacher.index');
    })->name('admin.teacher');

    Route::get('/teacher/detail', function () {
        return view('pages.admin.teacher.detail');
    })->name('admin.teacher.detail');

    Route::get('/approval', function () {
        return view('pages.admin.approval.index');
    })->name('admin.approval');

    Route::get('/task', function () {
        return view('pages.admin.task.index');
    })->name('admin.task');

    Route::get('/detailTask/{taskCourse}', [TaskCourseController::class, 'show'])->name('admin.detailTask');

});

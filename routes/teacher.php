<?php

use App\Http\Controllers\Api\CourseTeacherController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::prefix('teacher')->middleware(['auth', CheckRole::class . ':teacher'])->group(function () {
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

    Route::get('/task', function () {
        return view('pages.teacher.task.assignmentAssessment');
    })->name('task.assignmentAssessment');

    Route::get('/detailTask', function() {
        return view('pages.teacher.task.detailTask.detailTask');
    })->name('task.detailTask');
});

Route::middleware(['auth', CheckRole::class . ':teacher'])->group(function () {
    Route::get('/teacher/classroom/course/{id}', [CourseTeacherController::class, 'show']);
    Route::get('/teacher/course/detail/{id}', [CourseTeacherController::class, 'showPage']);
});

<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/Apiregister/teacher' , [LoginController::class , 'registerTeacher']);
Route::post('/Apiregister/student' , [LoginController::class , 'registerStudent']);
Route::post('/ApiLogout', [LoginController::class, 'ApiLogout'])->middleware('auth:api');

// approval user
Route::post('/accept/{id}', [LoginController::class, 'accept']);
Route::post('/reject/{id}', [LoginController::class, 'reject']);


// teacher
Route::get('/teacher/pending' , [UserController::class , 'teacher']);

// classroom
Route::post('/classroom/teacher', [ClassroomController::class, 'store']);
Route::get('/classroom/teacher/data/{id}', [ClassroomController::class, 'classroomTeacher']);
Route::get('/classroom/show/{classroom}', [ClassroomController::class, 'show']);
Route::delete('/classroom/delete/{classroom}', [ClassroomController::class, 'destroy']);
Route::put('/classroom/update/{classroom}', [ClassroomController::class, 'update']);

// admin approval class
Route::get('approval/classroom' , [AdminController::class , 'approvalClass']);
Route::post('/acceptClass/{id}', [AdminController::class, 'acceptClass']);
Route::post('/rejectClass/{id}', [AdminController::class, 'rejectClass']);

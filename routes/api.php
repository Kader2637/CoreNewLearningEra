<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/ApiLogin' , [LoginController::class , 'login']);
Route::post('/Apiregister/teacher' , [LoginController::class , 'registerTeacher']);
Route::post('/ApiLogout', [LoginController::class, 'ApiLogout'])->middleware('auth:api');

// approval
Route::post('/accept/{id}', [LoginController::class, 'accept']);
Route::post('/reject/{id}', [LoginController::class, 'reject']);


// teacher
Route::get('/teacher/pending' , [UserController::class , 'teacher']);

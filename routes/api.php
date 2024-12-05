<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/ApiLogin' , [LoginController::class , 'login']);

Route::post('/Apiregister/teacher' , [LoginController::class , 'registerTeacher']);
Route::post('/ApiLogout', [LoginController::class, 'ApiLogout'])->middleware('auth:api');

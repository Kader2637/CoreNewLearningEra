<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


require_once __DIR__ . '/kader.php';
require_once __DIR__ . '/erik.php';
require_once __DIR__ . '/ivan.php';

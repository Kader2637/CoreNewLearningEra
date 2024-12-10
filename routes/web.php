<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::get('/test', [App\Http\Controllers\HomeController::class, 'testEmail']);

require_once __DIR__ . '/kader.php';
require_once __DIR__ . '/erik.php';
require_once __DIR__ . '/ivan.php';
require_once __DIR__ . '/admin.php';
require_once __DIR__ . '/teacher.php';
require_once __DIR__ . '/student.php';
require_once __DIR__ . '/authentication.php';
require_once __DIR__ . '/landing.php';

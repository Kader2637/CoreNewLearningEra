<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CourseTeacherController;
use App\Http\Controllers\Api\StudentCourseController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AssigmentAsesmentTaskController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\ClassroomTeacherController;
use App\Http\Controllers\Api\CourseTeacherController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\StudentClassroomRelationController;
use App\Http\Controllers\Api\StudentCourseController;
use App\Http\Controllers\Api\TaskCourseController;
use App\Http\Controllers\ForumDiscussionController;
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
Route::get('classroom/admin' , [ClassroomController::class , 'classroomAdmin']);

// Classroom teacher
Route::get('/teacher/classroom/show/{classroom}' , [ClassroomTeacherController::class , 'show']);
Route::get('/teacher/data/classroom/{id}' , [ClassroomController::class , 'studentCourse']);
Route::get('/teacher' , [UserController::class , 'teacherAll']);
Route::delete('/user/delete/{user}' , [UserController::class , 'destroy']);

// Course Teacher
Route::post('/teacher/course/create', [CourseController::class, 'store']);
Route::get('/teacher/course/data/{id}', [CourseTeacherController::class, 'courseClass']);
Route::delete('/teacher/course/delete/{course}', [CourseController::class, 'destroy']);
Route::get('/teacher/course/show/{course}' , [CourseController::class , 'show']);


// student classroom
Route::get('/student/classroom/data/{id}' , [StudentClassroomRelationController::class  , 'index']);
Route::post('/classroom/join', [StudentClassroomRelationController::class, 'store']);
Route::get('/join/classroom/{id}', [ClassroomController::class, 'classroomStudent']);
Route::post('/Apiclassroom/join/{id}', [StudentClassroomRelationController::class, 'joinclass']);
Route::get('/student/classroom/show/{classroom}' , [StudentCourseController::class , 'showstudent']);
Route::get('/student/data/classroom/{id}' , [StudentCourseController::class , 'studentCourse']);


// student course
Route::get('/student/course/data/{id}', [StudentCourseController::class, 'courseClass']);
Route::get('/student/course/show/{course}' , [CourseController::class , 'show']);

// kick student classroom
Route::delete('/kick/student/{studentClassroomRelation}', [StudentClassroomRelationController::class, 'destroy']);

// pending approval classroom teacher
Route::get('/pending/teacher/{id}' , [ClassroomTeacherController::class , 'pendingStudent']);
Route::post('/accept/teacher/{user_id}' , [ClassroomTeacherController::class , 'accept']);
Route::post('/reject/teacher/{user_id}' , [ClassroomTeacherController::class , 'reject']);

// landing page
Route::get('/classroom' , [ClassroomController::class , 'index']);

// forum diskusi
Route::get('/forum/discussion/{id}' , [ForumDiscussionController::class , 'index']);
Route::post('/forum/discussion' , [ForumDiscussionController::class , 'store']);
Route::delete('/forum/discussion/delete/{id}' , [ForumDiscussionController::class , 'destroy']);


// Task course
Route::get('/task/course/{id}' , [TaskCourseController::class , 'index']);
Route::post('/task/course/post' , [TaskCourseController::class , 'store']);
Route::put('/task/course/update/{taskCourse}' ,[TaskCourseController::class , 'update']);
Route::delete('/task/course/delete/{taskCourse}' , [TaskCourseController::class , 'destroy']);

// Assigment Asesment Task
Route::post('/assigment/post' , [AssigmentAsesmentTaskController::class , 'store']);
Route::put('/assigment/update/{taskCourse}' ,[AssigmentAsesmentTaskController::class , 'update']);
Route::delete('/assigment/delete/{taskCourse}' , [AssigmentAsesmentTaskController::class , 'destroy']);

// Statistika
Route::get('/countTeacher', [AdminController::class ,'countTeacher']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 */

//user or student api routes
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::get('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:api');
Route::get('/student', [App\Http\Controllers\Api\AuthController::class, 'student'])->middleware('auth:api');


//-------------------------------------Admin-------------------------------
//admin api routes
Route::post('/admin/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::get('/admin/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:api');
Route::get('/admin', [App\Http\Controllers\Api\AuthController::class, 'admin'])->middleware('auth:api');

//view all students
Route::get('/admin/list/student', [App\Http\Controllers\Api\Student\StudentController::class, 'index'])->middleware('auth:api');
//create student
Route::post('/admin/store/student', [App\Http\Controllers\Api\Student\StudentController::class, 'store'])->middleware('auth:api');
//update student
Route::post('/admin/update/student/{id}', [App\Http\Controllers\Api\Student\StudentController::class, 'update'])->middleware('auth:api');

//create course
Route::post('/admin/store/course', [App\Http\Controllers\Api\Course\CourseController::class, 'store'])->middleware('auth:api');
//view all courses
Route::get('/admin/list/course', [App\Http\Controllers\Api\Course\CourseController::class, 'index'])->middleware('auth:api');


//-------------------------------------Student-------------------------------
//register course
Route::post('/student/register/course', [App\Http\Controllers\Api\RegisterCourse\RegisterCourseController::class, 'store'])->middleware('auth:api');
//drop course
Route::get('/student/drop/course/{id}', [App\Http\Controllers\Api\RegisterCourse\RegisterCourseController::class, 'drop'])->middleware('auth:api');
//specific student view courses
Route::get('/student/list/course/{id}', [App\Http\Controllers\Api\RegisterCourse\RegisterCourseController::class, 'show'])->middleware('auth:api');

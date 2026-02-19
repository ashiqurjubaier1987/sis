<?php
/*
 * Created on Thu May 29 2025
 *
 * Author: Ashiqur Jubaier
 * Email: ashiqurjubaier@gmail.com
 * Copyright (c) 2025 NASTech BD Solutions
 *
 * Version: 1.0.0
 *
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\RoleController;
use App\Http\Controllers\API\V1\SubjectController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\PermissionController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });
    Route::apiResource('user', UserController::class);
    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('role', RoleController::class);
    Route::apiResource('permission', PermissionController::class);
});
Route::put('subjects/changeStatus/{subject}', SubjectController::class .'@changeStatus');
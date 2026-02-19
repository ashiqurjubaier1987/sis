<?php
/*
 * Created on Tue May 20 2025
 *
 * Author: Ashiqur Jubaier
 * Email: ashiqurjubaier@gmail.com
 * Copyright (c) 2025 NASTech BD Solutions
 *
 * Version: 1.0.0
 *
 */


use Illuminate\Support\Facades\Route;

Route::get('clear-all', function () {
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('clear-compiled');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    dd('All Cached Cleared');
});

Route::get('/', function () {
    // dd(phpinfo());
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/', [App\Http\Controllers\WEB\Auth\RegisterController::class, 'showRegistrationForm'])->name('/');
    Route::post('/register', [App\Http\Controllers\WEB\Auth\RegisterController::class, 'store'])->name('student.register');
    Route::post('/check-unique-field', [App\Http\Controllers\WEB\Auth\RegisterController::class, 'checkUniqueField'])->name('student.checkUniqueField');

    Route::post('/otp/send', [App\Http\Controllers\WEB\Auth\OtpController::class, 'sendOtp'])->name('otp.send'); //->middleware('throttle:3,1');
    Route::post('/otp/verify', [App\Http\Controllers\WEB\Auth\OtpController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('/otp/reset', [App\Http\Controllers\WEB\Auth\OtpController::class, 'resetOtp'])->name('otp.reset');

    Route::get('/login', [App\Http\Controllers\WEB\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\WEB\Auth\LoginController::class, 'login']);

    Route::get('/password-request', [App\Http\Controllers\WEB\Auth\AuthController::class, 'showForgetPasswordForm'])->name('password.request');
    Route::post('/password-process', [App\Http\Controllers\WEB\Auth\AuthController::class, 'forgotPasswordProcess'])->name('password.process');
    Route::get('/reset-password', [App\Http\Controllers\WEB\Auth\AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [App\Http\Controllers\WEB\Auth\AuthController::class, 'resetPasswordProcess'])->name('password.update');

    /*  Route::get('/password/reset/{token}', function () {
        abort(404);
    })->name('password.reset'); */
});

Route::middleware('auth')->group(function () {
    /* Auth Route */

    Route::get('/logout', [App\Http\Controllers\WEB\Auth\AuthController::class, 'logout'])->name('logout');
    // Route::post('/password-request', [App\Http\Controllers\WEB\Auth\AuthController::class, 'passwordRequest'])->name('password.request');
    /* Auth Route */

    /* Dashboard Route */
    Route::get('/dashboard', [App\Http\Controllers\WEB\DashboardController::class, 'index'])->name('dashboard');
    /* Dashboard Route */

    /* Subject Routes */
    Route::group(['prefix' => 'subjects'], function () {
        Route::get('/', [App\Http\Controllers\WEB\SubjectController::class, 'index'])->name('subjects.index');
        Route::get('/create', [App\Http\Controllers\WEB\SubjectController::class, 'create'])->name('subjects.create');
        Route::post('/', [App\Http\Controllers\WEB\SubjectController::class, 'store'])->name('subjects.store');
        Route::get('/{id}', [App\Http\Controllers\WEB\SubjectController::class, 'show'])->name('subjects.show');
        Route::get('/{id}/edit', [App\Http\Controllers\WEB\SubjectController::class, 'edit'])->name('subjects.edit');
        Route::put('/{id}', [App\Http\Controllers\WEB\SubjectController::class, 'update'])->name('subjects.update');
        Route::delete('/{id}', [App\Http\Controllers\WEB\SubjectController::class, 'destroy'])->name('subjects.destroy');
    });
    /* Subject Routes */
});

// Other web routes can be added here

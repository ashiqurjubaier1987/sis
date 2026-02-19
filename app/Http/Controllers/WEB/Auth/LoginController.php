<?php
/*
 * Created on Sun Feb 08 2026
 *
 * Author: Ashiqur Jubaier
 * Email: ashiqurjubaier@gmail.com
 * Copyright (c) 2026 NASTech BD Solutions
 *
 * Version: 1.0.0
 *
 */

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        //Throttle key:login + IP
        $throttleKey = Str::lower($request->login) . '|' . $request->ip();

        //Max 5 attempts
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw ValidationException::withMessages([
                'login' =>  'Too many login attemps. Please try again in a minute'
            ]);
        }

        // Attempt login
        if (Auth::attempt($request->credentials(),$request->boolean('remember'))) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        // Failed attempt
        RateLimiter::hit($throttleKey, 60);

        throw ValidationException::withMessages([
            'login' => 'Invalid email/phone or password.',
        ]);
    }
}

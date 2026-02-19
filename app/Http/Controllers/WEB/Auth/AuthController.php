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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use App\Support\Settings;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /* ------------FORGOT PASSWORD------------ */
    public function showForgetPasswordForm()
    {
        $mode = Settings::get('login_mode');
        return view('auth.forgot-password', compact('mode'));
    }

    public function forgotPasswordProcess(ForgotPasswordRequest $request)
    {

        $login_cred =  $request->credentials();

        if ($login_cred['login_mode'] === 'email') {
            return $this->sendEmailReset($login_cred['email']);
        }

        if ($login_cred['login_mode'] === 'phone') {
            $user = User::where($login_cred['login_mode'], $login_cred['phone'])->orderBy('id', 'Desc')->first();
            return $this->sendEmailReset($user->email);
        }
    }

    protected function sendEmailReset(string $email)
    {
        $status = Password::sendResetLink(['email' => $email]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Password reset link sent to your email.')
            : back()->withErrors(['login' => __($status)]);
    }

    public function showResetPasswordForm(Request $request)
    {
        return view('auth.reset-password', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    public function resetPasswordProcess(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'confirmed', 'min:4'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password reset successfully.')
            : back()->withErrors(['email' => __($status)]);
    }
    /* ------------FORGOT PASSWORD------------ */


    /* ------------LOG OUT------------ */
    public function logout(Request $request)
    {
        // Perform logout logic here
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully.');;
    }
}

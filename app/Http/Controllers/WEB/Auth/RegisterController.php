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
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\PhoneNormalizer;
use App\Support\Settings;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        Settings::clearCache();
        $enable_otp_registration = Settings::get('enable_otp_registration');
        return view('auth.register', compact('enable_otp_registration'));
    }

    public function store(RegisterRequest $request)
    {
        if (Settings::get('enable_otp_registration') === 'true') {
            if (session('phone_verified') !== $request->phone) {
                return redirect()->back()->withErrors(['phone' => 'Phone number not verified'])->withInput();
            }
        }
        try {
            // Check for existing users
            if (User::where('email', $request->email)->exists()) {
                return redirect()->back()->withErrors(['error' => 'Email already exists'])->withInput();
            }
            if ($request->phone && User::where('phone', $request->phone)->exists()) {
                return redirect()->back()->withErrors(['error' => 'Phone already exists'])->withInput();
            }
            if ($request->photo_id_number && User::where('photo_id_number', $request->photo_id_number)->exists()) {
                return redirect()->back()->withErrors(['error' => 'Photo ID already exists'])->withInput();
            }

            $fields = [
                'name' => '',
                'email' => Str::lower($request->email),
                'phone' => $request->phone,
                'photo_id_number' => $request->photo_id_number,
                'password' => Hash::make($request->password),
            ];
            if (Settings::get('enable_otp_registration') === 'true') {
                $field['phone_verified_at'] = now();
            }

            // Create a new user
            $user = User::create($fields);

            // User login after registration
            Auth::login($user);

            session()->forget('phone_verified');

            return redirect('/dashboard')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Registration error: ' . $e->getMessage());
            // Redirect back with error message
            return redirect()->back()->withErrors(['error' => 'An error occurred during registration'])->withInput();
        }
    }

    public function checkUniqueField(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');

        if (!in_array($field, ['email', 'phone', 'photo_id_number'])) {
            return response()->json(['error' => 'Invalid field'], 400);
        }

        // Normalize phone before checking
        if ($field === 'phone') {
            $value = PhoneNormalizer::normalize($value);
        }

        $exists = User::where($field, $value)->exists();

        return response()->json(['exists' => $exists]);
    }
}

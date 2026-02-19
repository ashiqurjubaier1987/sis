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
use App\Http\Requests\V1\PhoneNumberValidator;
use App\Http\Requests\Auth\SendOtpRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Models\Otp;
use Illuminate\Support\Facades\Hash;
use App\Services\SmsService;
use App\Support\Settings;

class OtpController extends Controller
{
    public function sendOtp(PhoneNumberValidator $request)
    {
        if (Settings::get('enable_otp_registration')==='false') {
            abort(403);
        }

        $existingOtp = Otp::where('phone', $request->phone)
            ->where('expires_at', '>', now())
            ->first();

        if ($existingOtp) {
            return response()->json([
                'success' => true,
                'message' => 'OTP already sent. Please wait before retrying.',
            ], 429);
        }
        // Logic to send OTP to the user's phone number
        $otp = rand(100000, 999999);

        Otp::updateOrCreate(
            ['phone' => $request->phone],
            [
                'otp_code' => ($otp),
                'expires_at' => now()->addMinutes(5),
            ]
        );

        // SmsService::send($request->phone, "Your OTP is {$otp}");

        return response()->json([
            // 'step' => 'otp_sent',
            'success' => true,
            'message' => 'OTP sent successfully',
        ]);
    }

    public function verifyOtp(PhoneNumberValidator $request)
    {
        $request->validate([
            'otp_code' => 'required|string|size:6',
        ]);

        $otpRecord = Otp::where('phone', $request->phone)
            ->where('expires_at', '>', now())
            ->first();

        // if (!$otpRecord || !Hash::check($request->otp_code, $otpRecord->otp_code)) {
        if (!$otpRecord || $otpRecord->otp_code !== $request->otp_code) {
            return response()->json([
                'step' => 'otp_verification_failed',
                'message' => 'Invalid or expired OTP',
            ], 422);
        }

        // OTP is valid
        $otpRecord->delete(); // Invalidate the OTP after successful verification

        session(['phone_verified' => $request->phone]); // Store verified phone in session

        return response()->json([
            'step' => 'otp_verified',
            'success' => true,
            'message' => 'OTP verified successfully',
        ]);
    }

    public function resetOtp()
    {
        session()->forget('phone_verified');

        return response()->json([
            'success' => true
        ]);
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\v1\PhoneNumberValidator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Register a new user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(PhoneNumberValidator $request)
    {

        try {
            // Validate the request
            $fields = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|unique:users,phone',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Create a new user
            $user = User::create($fields);

            // Generate a new token for the user
            $token = $user->createToken($user->name)->plainTextToken;

            $responseData = [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ];

            return Response::api($responseData, 'Registration successful', 201, true);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Registration error: ' . $e->getMessage());
            // Return a JSON response with the error message

            return Response::api(null, 'An error occurred during registration', 422, false);
        }
    }

    /**
     * Login a user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {

            // Validate the request
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $request->email)->first();

            // Check if the user exists
            if (!$user) {
                return Response::api(null, 'User not found with this credentials', 404, false);
            }

            // Check if the user is soft deleted
            // if ($user->trashed()) {
            //     return response()->json([
            //         'message' => 'User revoked',
            //     ], 404);
            // }

            // Check if the user is active
            // if (!$user->is_active) {
            //     return response()->json([
            //         'message' => 'User is inactive',
            //     ], 403);
            // }

            // Check if the password is hashed and correct
            if (!Hash::check($request->password, $user->password)) {
                return Response::api(null, 'Invalid credentials', 401, false);
            }

            $token = $user->createToken($user->name)->plainTextToken;

            $responseData = [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ];

            return Response::api($responseData, 'Login successful', 200, true);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Login validation error: ' . $e->getMessage());
            // Return a JSON response with the error message
            return Response::api(null, 'An error occurred during login', 422, false);
        }
    }

    /**
     * Logout a user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            // Revoke the user's All token
            $request->user()->tokens()->delete();
            return Response::api(null, 'Logout Successful', 200, true);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Logout error: ' . $e->getMessage());
            // Return a JSON response with the error message
            return Response::api(null, 'An error occurred during logout', 422, false);
        }
    }

    /**
     * Delete a user account
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // public function destroy(Request $request, User $user)
    // {
    //     try {
    //         // Soft delete the user
    //         $request->user->delete();

    //         // Revoke all tokens (if using Sanctum)
    //         $request->user->tokens()->delete();
    //         return Response::api(null, 'Account deleted successfully', 200, true);
    //     } catch (\Exception $e) {
    //         // Log the error message
    //         Log::error('Account deletion error: ' . $e->getMessage());
    //         // Return a JSON response with the error message
    //         return Response::api(null, 'An error occurred during account deletion' , 422, false);
    //     }
    // }
}

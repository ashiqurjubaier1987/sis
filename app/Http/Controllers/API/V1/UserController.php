<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Http\Requests\v1\PhoneNumberValidator;
use Illuminate\Validation\Rules\Password;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Fetch all users from the database
            $users = User::all();

            // Return the users as a JSON response
            return Response::api($users, 'Users fetched successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error fetching users: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while fetching users', 500, false);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PhoneNumberValidator $request)
    {
        try {
            // Validate the request data
            $fields = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|unique:users,phone',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Create a new user in the database
            $user = User::create($fields);

            // Return the created user as a JSON response
            return Response::api($user, 'User created successfully', 201, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error creating user: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while creating the user', 500, false);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Fetch the user by ID from the database
            $user = User::findOrFail($id);
            $user->load('roles');

            // Return the user as a JSON response
            return Response::api($user, 'User fetched successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error fetching user: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while fetching the user details', 500, false);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PhoneNumberValidator $request, string $id)
    {
        // try {
            // Validate the request data
            $fields = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:users,email,' . $id,
                'phone' => 'sometimes|string|unique:users,phone,' . $id,
                'password' => 'sometimes|string|min:8|confirmed',
            ]);

            // Find the user by ID
            $user = User::findOrFail($id);

            // Update the user in the database
            $user->update($fields);

            // Return the updated user as a JSON response
            return Response::api($user, 'User updated successfully', 200, true);
        // } catch (\Exception $e) {
        //     // Handle any exceptions that may occur
        //     Log::error('Error updating user: ' . $e->getMessage());
        //     return Response::api(null, 'An error occurred while updating the user', 500, false);
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        try {
            // Soft delete the user
            $request->user->delete();

            // Revoke all tokens (if using Sanctum)
            $request->user->tokens()->delete();
            return Response::api(null, 'Account deleted successfully', 200, true);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Account deletion error: ' . $e->getMessage());
            // Return a JSON response with the error message
            return Response::api(null, 'An error occurred during account deletion' , 422, false);
        }
    }
}

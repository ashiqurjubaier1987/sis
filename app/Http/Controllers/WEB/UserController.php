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

namespace App\Http\Controllers\WEB;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Get all permissions from the database
            $permissions = Permission::all();

            // Return the permissions as a JSON response
            return Response::api($permissions, 'Permissions fetched successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error fetching permissions: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while fetching permissions', 500, false);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $fields = $request->validate([
                'name' => 'required|string|min:3|max:255|unique:permissions,name',
                'guard_name' => 'required|string|min:3|max:255',
            ]);

            // Create a new permission in the database
            $permission = Permission::create($fields);

            // Return the created permission as a JSON response
            return Response::api($permission, 'Permission created successfully', 201, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error creating permission: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while creating the permission', 500, false);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Fetch the permission by ID from the database
            $permission = Permission::findOrFail($id);

            // Return the permission as a JSON response
            return Response::api($permission, 'Permission fetched successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error fetching permission: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while fetching the permission details', 500, false);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Validate the request data
            $fields = $request->validate([
                'name' => 'required|string|min:3|max:255|unique:permissions,name,' . $id,
                'guard_name' => 'string|min:3|max:255',
            ]);

            // Find the permission by ID
            $permission = Permission::findOrFail($id);

            // Update the permission in the database
            $permission->update($fields);

            // Return the updated permission as a JSON response
            return Response::api($permission, 'Permission updated successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error updating permission: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while updating the permission', 500, false);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the permission by ID
            $permission = Permission::findOrFail($id);

            // Delete the permission from the database
            $permission->delete();

            // Return a success response
            return Response::api(null, 'Permission deleted successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error deleting permission: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while deleting the permission', 500, false);
        }
    }
}

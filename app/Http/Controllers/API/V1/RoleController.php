<?php
/*
 * Created on Sat May 24 2025
 *
 * Author: Ashiqur Jubaier
 * Email: ashiqurjubaier@gmail.com
 * Copyright (c) 2025 NASTech BD Solutions
 *
 * Version: 1.0.0
 *
 */

namespace App\Http\Controllers\API\V1;

// use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Get all roles and their permissions from the database
            $roles = Role::with('permissions')->withTrashed()->get();
            $permissions = Permission::pluck('name', 'id');

            $responseData = [
                'roles' => $roles,
                'permissions' => $permissions,
            ];

            // Return the subjects as a JSON response
            return Response::api($responseData, 'Roles fetched successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error fetching subjects: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while fetching roles', 500, false);
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
                'name' => 'required|string|min:3|max:255|unique:roles,name',
                'guard_name' => 'required|string|min:3|max:255',
                'permissions' => 'sometimes|array',
                'permissions.*' => 'exists:permissions,id'
            ]);

            // Check if the role already exists
            $existingRole = Role::withTrashed()->where('name', $fields['name'])->exists();
            if ($existingRole) {
                // If the role already exists, return an error response
                return Response::api(null, 'Role already exists', 409, false);
            }
            DB::beginTransaction();
            // Start a database transaction
            $role = Role::create($fields);

            // If permissions are provided, sync them with the role
            if ($request->has('permissions')) {
                $permissions = $request->input('permissions');
                $role->syncPermissions($permissions);
                app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
            }
            DB::commit();

            // Return the created role as a JSON response
            return Response::api($role, 'Role created successfully', 201, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error creating role: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while creating the role', 500, false);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Find the role by ID
            $role = Role::findById($id);
            $role->load('permissions');

            // Return the role as a JSON response
            return Response::api($role, 'Role fetched successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error fetching role: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while fetching a role details', 500, false);
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
                'name' => 'required|string|min:3|max:255',
                'guard_name' => 'string|min:3|max:255',
                'permissions' => 'sometimes|array',
                'permissions.*' => 'exists:permissions,id'
            ]);

            // Find the role by ID
            $role = Role::findById($id);

            // Check if the role already exists with a different ID
            $existingRole = Role::withTrashed()->where('name', $fields['name'])
                ->where('id', '!=', $id)
                ->exists();
            if ($existingRole) {
                // If the role already exists, return an error response
                return Response::api(null, 'Role with this name already exists', 409, false);
            }

            // Start a database transaction
            DB::beginTransaction();

            // Update the role in the database
            $role->update($fields);

            // If permissions are provided, sync them with the role
            if ($request->has('permissions')) {
                $permissions = $request->input('permissions');
                $role->syncPermissions($permissions);
                app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
            }

            DB::commit();

            // Return the updated role as a JSON response
            return Response::api($role, 'Role updated successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error updating role: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while updating the role', 500, false);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the role by ID
            $role = Role::findById($id);

            // Start a database transaction
            DB::beginTransaction();
            // Delete the role from the database
            $role->delete();

            // Commit the transaction
            DB::commit();

            // Return a success message
            return Response::api(null, 'Role deleted successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error deleting role: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while deleting the role', 500, false);
        }
    }
}

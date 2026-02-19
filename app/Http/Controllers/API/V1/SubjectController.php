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

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\V1\StoreSubjectRequest;
use App\Http\Requests\V1\UpdateSubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Get all subjects from the database
            $subjects = Subject::all();

            // Return the subjects as a JSON response
            return Response::api($subjects, 'Subjects fetched successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error fetching subjects: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while fetching subjects', 500, false);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        try {
            // Create a new subject in the database
            $subject = Subject::create($request->validated());

            // Return the created subject as a JSON response
            return Response::api($subject, 'Subject created successfully', 201, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error creating subject: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while creating the subject', 500, false);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {   
        try {
            // Return the subject as a JSON response
            return Response::api($subject, 'Subject fetched successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error fetching subject: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while fetching the subject', 500, false);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        try {
            // Update the subject in the database
            $subject->update($request->validated());

            // Return the updated subject as a JSON response
            return Response::api($subject, 'Subject updated successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error updating subject: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while updating the subject', 500, false);
        }
    }

    /**
     * Change the delete status of resource from storage.
     */
    public function changeStatus(Request $request, Subject $subject)
    {
        // Validate the request data
        $request->validate([
            'is_active' => 'required|boolean',
        ]);
        try {
            // Update the subject's status in the database
            $subject->update($request->only('is_active'));
        
            // Return a success message
            return Response::api($subject, 'Subject status updated successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error updating subject status: ' . $e->getMessage());
            Return Response::api(null, 'An error occurred while updating the status', 500, false);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        try {
            // Delete the subject from the database
            $subject->delete();

            // Return a success message
            return Response::api(null, 'Subject deleted successfully', 200, true);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error deleting subject: ' . $e->getMessage());
            return Response::api(null, 'An error occurred while deleting the subject', 500, false);
        }
    }
}

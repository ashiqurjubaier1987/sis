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
use App\Http\Requests\V1\StoreSubjectRequest;
use App\Http\Requests\V1\UpdateSubjectRequest;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use App\Services\SubjectQueryService;
use App\Exports\SubjectExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;



class SubjectController extends Controller
{
    protected $service;

    public function __construct(SubjectQueryService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Subjects';
        return view('admin.subject.index', compact('title'));
    }

    /*
    |--------------------------------------------------------------------------
    | DATA — AJAX endpoint for search, filter, sort, paginate
    |--------------------------------------------------------------------------
    */
    public function data(Request $request)
    {
        $query = Subject::query()->whereNull('deleted_at');

        // 🔍 Search
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // 🎯 Filter by status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        // 🔃 Sorting (safe against SQL injection)
        $allowedSortFields = ['id', 'name', 'code', 'created_at'];
        $sortField = in_array($request->get('sort_field'), $allowedSortFields)
            ? $request->get('sort_field')
            : 'id';
        $sortOrder = in_array($request->get('sort_order'), ['asc', 'desc'])
            ? $request->get('sort_order')
            : 'desc';

        $query->orderBy($sortField, $sortOrder);

        // 📄 Pagination
        $perPage = in_array((int) $request->get('per_page'), [10, 25, 50, 100])
            ? (int) $request->get('per_page')
            : 10;

        $subjects = $query->paginate($perPage);

        return response()->json([
            'data'         => $subjects->items(),
            'current_page' => $subjects->currentPage(),
            'last_page'    => $subjects->lastPage(),
            'total'        => $subjects->total(),
            'per_page'     => $subjects->perPage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Subject';
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Ready to create subject.',
        // ]);
        return view('admin.subject.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:subjects,name',
            'code'        => 'required|string|max:50|unique:subjects,code',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
        ]);

        try {
            $subject = Subject::create([
                'name'        => $validated['name'],
                'code'        => strtoupper(trim($validated['code'])),
                'description' => $validated['description'] ?? null,
                'is_active'   => $validated['is_active'] ?? true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Subject created successfully.',
                'data'    => $subject,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Subject store error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create subject. Please try again.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::whereNull('deleted_at')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $subject,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subject = Subject::whereNull('deleted_at')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $subject,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subject = Subject::whereNull('deleted_at')->findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:subjects,name,' . $id,
            'code'        => 'required|string|max:50|unique:subjects,code,' . $id,
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
        ]);

        try {
            $subject->update([
                'name'        => $validated['name'],
                'code'        => strtoupper(trim($validated['code'])),
                'description' => $validated['description'] ?? null,
                'is_active'   => $validated['is_active'] ?? $subject->is_active,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Subject updated successfully.',
                'data'    => $subject->fresh(),
            ]);
        } catch (\Exception $e) {
            Log::error('Subject update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update subject. Please try again.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::whereNull('deleted_at')->findOrFail($id);

        try {
            $subject->delete(); // SoftDeletes: sets deleted_at

            return response()->json([
                'success' => true,
                'message' => 'Subject deleted successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error('Subject destroy error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete subject. Please try again.',
            ], 500);
        }
    }

    /**
     * Export the specified resource.
     */
    public function export(Request $request)
    {
        $type     = strtolower($request->get('type', 'xlsx'));
        $fileName = 'subjects_' . date('Ymd_His');

        // Build filtered query (reuse same filters as data())
        $query = Subject::query()->whereNull('deleted_at');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->has('is_active') && $request->is_active !== '') {
            $query->where('is_active', $request->is_active);
        }

        $subjects = $query->orderBy('id', 'desc')->get();

        // PDF Export
        if ($type === 'pdf') {
            $pdf = Pdf::loadView('admin.subject.export_pdf', compact('subjects'))
                ->setPaper('a4', 'landscape');
            return $pdf->download($fileName . '.pdf');
        }

        // Excel / CSV Export via Maatwebsite
        $exportType = $type === 'csv' ? \Maatwebsite\Excel\Excel::CSV : \Maatwebsite\Excel\Excel::XLSX;
        return Excel::download(new SubjectExport($subjects), $fileName . '.' . $type, $exportType);
    }
}

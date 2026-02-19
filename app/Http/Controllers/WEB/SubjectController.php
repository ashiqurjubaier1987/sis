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
    public function index(Request $request)
    {
        $query = $this->filter($request);

        $subjects = $query
            ->paginate(10)
            ->withQueryString();

        return view('admin.subject.index', compact('subjects'));
    }

    private function filter(Request $request)
    {
        $query = \App\Models\Subject::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'id');
        $sortDir = $request->get('sort_dir', 'desc');

        $allowedSorts = ['id', 'name', 'code', 'created_at'];

        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'id';
        }

        $query->orderBy($sortBy, $sortDir);

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd('WEB Subject Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        dd('WEB Subject Store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        dd('WEB Subject Show ' . $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        dd('WEB Subject Edit ' . $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        dd('WEB Subject Update ' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        dd('WEB Subject Destroy ' . $id);
    }

    /**
     * Export the specified resource.
     */
    /* public function export(Request $request)
    {
        $type = $request->type ?? 'csv';
        $fileName = 'subjects_' . date('Ymd_His');

        if ($type === 'csv') {
            return Excel::download(new SubjectExport, $fileName . '.csv');
        }

        return Excel::download(new SubjectExport, $fileName . '.xlsx');
    } */
}

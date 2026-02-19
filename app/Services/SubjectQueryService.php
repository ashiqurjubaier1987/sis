<?php

namespace App\Services;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class SubjectQueryService extends BaseQueryService
{
    protected array $allowedFilters = ['status'];
    protected array $allowedSorts = [
        0 => 'id',
        1 => 'name',
        2 => 'code',
        3 => 'status',
        4 => 'created_at',
    ];
    protected array $searchableColumns = ['name','code'];

    protected function baseQuery(): Builder
    {
        return Subject::query()->select(['id','name','code','is_active','created_at']);
    }

    public function handle($request)
    {
        $cacheKey = 'subjects_'.md5(json_encode($request->all()));

        return Cache::remember($cacheKey, 30, function() use ($request) {
            return parent::handle($request);
        });
    }
}

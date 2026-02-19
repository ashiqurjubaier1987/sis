<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseQueryService
{
    protected Builder $query;

    protected array $allowedFilters = [];
    protected array $allowedSorts = [];
    protected array $searchableColumns = [];

    abstract protected function baseQuery(): Builder;

    public function handle($request)
    {
        $this->query = $this->baseQuery();

        $this->applyFilters($request);
        $this->applySearch($request);
        $this->applySorting($request);

        return $this->query;
    }

    protected function applyFilters($request)
    {
        foreach ($this->allowedFilters as $column) {
            if ($request->filled($column)) {
                $this->query->where($column, $request->$column);
            }
        }
    }

    protected function applySearch($request)
    {
        if ($request->filled('search.value') && count($this->searchableColumns)) {
            $search = $request->input('search.value');

            $this->query->where(function ($q) use ($search) {
                foreach ($this->searchableColumns as $column) {
                    $q->orWhere($column, 'like', "%{$search}%");
                }
            });
        }
    }

    protected function applySorting($request)
    {
        $columnIndex = $request->input('order.0.column');
        $direction = $request->input('order.0.dir', 'asc');

        if (isset($this->allowedSorts[$columnIndex])) {
            $column = $this->allowedSorts[$columnIndex];
            $this->query->orderBy($column, $direction);
        }
    }
}

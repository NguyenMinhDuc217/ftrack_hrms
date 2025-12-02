<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class BaseFilter
{
    protected $builder;
    protected $request;
    protected ?Model $model = null;
    protected $currentColumn;
    protected $tableColumns = [];

    public function __construct(Request $request, ?Model $model = null)
    {
        $this->request = $request;
        $this->model = $model;
    }

    abstract protected function allowedFilters(): array; // Nhận từ lớp con


    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        $filters = $this->filters();

        foreach ($filters as $key => $value) {
            if (filled($value)) {
                $this->applyFilter($key, $value);
            }
        }

        return $this->builder;
    }

    protected function filters(): array
    {
        return $this->request->only(array_keys($this->allowedFilters()));
    }

    protected function applyFilter(string $key, $value): void
    {
        $method = $this->allowedFilters()[$key] ?? null;

        if ($method && method_exists($this, $method)) {
            $this->{$method}($value);
        }
    }
}
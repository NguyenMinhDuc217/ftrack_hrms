<?php

namespace App\Filters;

use App\Models\User;
use Carbon\Carbon;

class UserFilter extends BaseFilter
{
    public function __construct($request)
    {
        parent::__construct($request, new User());
    }

    protected function allowedFilters(): array
    {
        $searchable = $this->model->searchable();

        $filters = [];
        foreach ($searchable as $column) {
            $filters[$column] = $column; // key = method name
        }
        return $filters;
    }

    protected function search($keyword)
    {
        $this->builder->where(function ($q) use ($keyword) {
            $q->where('username', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%")
                ->orWhere('first_name', 'like', "%{$keyword}%")
                ->orWhere('last_name', 'like', "%{$keyword}%");
        });
    }

    protected function username($value)
    {
        $this->builder->where('username', 'like', "%{$value}%");
    }

    protected function email($value)
    {
        $this->builder->where('email', 'like', "%{$value}%");
    }

    protected function phone_number($value)
    {
        $this->builder->where('phone_number', 'like', "%{$value}%");
    }

    protected function first_name($value)
    {
        $this->builder->where('first_name', 'like', "%{$value}%");
    }

    protected function last_name($value)
    {
        $this->builder->where('last_name', 'like', "%{$value}%");
    }

    protected function gender($value)
    {
        $this->builder->where('gender', $value);
    }

    protected function hire_date($value)
    {
        $this->builder->whereDate('hire_date', $value);
    }

    protected function department_id($value)
    {
        $this->builder->where('department_id', (int)$value);
    }

    protected function manager_id($value)
    {
        $this->builder->where('manager_id', (int)$value);
    }

    protected function employment_type($value)
    {
        $this->builder->where('employment_type', $value);
    }

    protected function status($value)
    {
        $this->builder->where('status', $value);
    }

    protected function hireDateFrom($date)
    {
        $this->builder->whereDate('hire_date', '>=', $date);
    }

    protected function hireDateTo($date)
    {
        $this->builder->whereDate('hire_date', '<=', $date);
    }

    protected function managerName($name)
    {
        $this->builder->whereHas('manager', function ($q) use ($name) {
            $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$name}%"]);
        });
    }
}

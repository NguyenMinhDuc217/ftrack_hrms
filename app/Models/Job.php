<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';

    protected $table = 'jobs_hrms';

    protected $fillable = [
        'title',
        'department_id',
        'province_code',
        'employment_type',
        'headcount',
        'description_md',
        'requirements_md',
        'min_salary',
        'max_salary',
        'currency',
        'org_id',
        'status',
    ];

    public function searchable(): array
    {
        return [
            'title',
            'department_id',
            'province_code',
            'employment_type',
            'headcount',
            'description_md',
            'requirements_md',
            'min_salary',
            'max_salary',
            'currency',
            'org_id',
            'status',
        ];
    }

    protected $primaryKey = 'job_id';

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}

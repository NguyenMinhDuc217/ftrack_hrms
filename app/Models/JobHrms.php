<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobHrms extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';

    protected $table = 'jobs_hrms';

    protected $fillable = [
        'job_id',
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

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');
    }

    public function area_application()
    {
        return $this->hasMany(AreaApplication::class, 'job_id', 'job_id');
    }
}

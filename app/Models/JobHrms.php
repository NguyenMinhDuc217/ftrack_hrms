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
        'name',
        'image_ids',
        'profession_id',
        'employment_type',
        'description_md',
        'requirements_md',
        'min_salary',
        'max_salary',
        'currency',
        'org_id',
        'start_date',
        'end_date',
        'experience',
        'status',
    ];

    public function searchable(): array
    {
        return [
            'name',
            'profession_id',
            'province_id',
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

    protected $casts = [
        'image_ids' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('start_date', '<=', today())
            ->where('end_date', '>=', today())
            ->where('status', 1)
            ->where('deleted_at', null);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id')->where('status', 'active')->where('deleted_at', null);
    }

    public function job_area()
    {
        return $this->hasMany(JobArea::class, 'job_id', 'job_id')->where('status', 'active')->where('deleted_at', null);
    }

    public function images()
    {
        if (empty($this->image_ids)) {
            return collect();
        }

        return Image::whereIn('id', $this->image_ids)
            ->where('status', 1)
            ->where('deleted_at', null)
            ->get();
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id')->where('status', 'active')->where('deleted_at', null);
    }
}

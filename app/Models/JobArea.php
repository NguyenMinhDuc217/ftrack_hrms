<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobArea extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';

    protected $table = 'job_areas';

    protected $fillable = [
        'job_area_id',
        'job_id',
        'province_id',
        'ward_id',
        'headcount',
        'status',
    ];

    protected $primaryKey = 'job_area_id';

    public function job()
    {
        return $this->belongsTo(JobHrms::class, 'job_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    // public function ward()
    // {
    //     return $this->belongsTo(Ward::class, 'ward_id');
    // }
}

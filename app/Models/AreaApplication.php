<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaApplication extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';

    protected $table = 'area_application';

    protected $fillable = [
        'job_id',
        'province_code',
        'ward_code',
        'status',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');
    }

    public function job()
    {
        return $this->belongsTo(JobHrms::class, 'job_id');
    }
}

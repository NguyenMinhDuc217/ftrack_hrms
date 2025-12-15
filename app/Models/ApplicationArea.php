<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationArea extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';

    protected $table = 'application_areas';

    protected $fillable = [
        'application_id',
        'job_area_id',
        'status',
    ];

    protected $primaryKey = ['application_id', 'job_area_id'];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }

    public function job_area()
    {
        return $this->belongsTo(JobArea::class, 'job_area_id');
    }
}

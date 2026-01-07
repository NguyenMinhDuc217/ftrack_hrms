<?php

namespace App\Models;

use App\Enums\GeneralStatus;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationArea extends Pivot
{
    use SoftDeletes;

    protected $guard_name = 'web';

    protected $table = 'application_areas';

    protected $fillable = [
        'application_id',
        'job_area_id',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => GeneralStatus::class,
        ];
    }

    public $incrementing = false;
    protected $primaryKey = null;
    // protected $primaryKey = ['application_id', 'job_area_id'];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }

    public function job_area()
    {
        return $this->belongsTo(JobArea::class, 'job_area_id');
    }
}

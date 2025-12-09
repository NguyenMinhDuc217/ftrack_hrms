<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvExperience extends Model
{
    use HasFactory;

    protected $table = 'cv_experiences';

    // protected $fillable = [
    //     'cv_profile_id',
    //     'company_name',
    //     'position',
    //     'start_date',
    //     'end_date',
    //     'is_current',
    //     'description',
    // ];
    protected $guarded = [];

    protected $casts = [
        'is_current' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function profile()
    {
        return $this->belongsTo(CvProfile::class, 'cv_profile_id');
    }
}

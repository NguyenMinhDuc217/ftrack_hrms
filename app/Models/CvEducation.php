<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvEducation extends Model
{
    use HasFactory;

    protected $table = 'cv_education';

    // protected $fillable = [
    //     'cv_profile_id',
    //     'school',
    //     'degree',
    //     'major',
    //     'is_studying',
    //     'start_date',
    //     'end_date',
    //     'description',
    // ];
    protected $guarded = [];

    protected $casts = [
        'is_studying' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function profile()
    {
        return $this->belongsTo(CvProfile::class, 'cv_profile_id');
    }
}

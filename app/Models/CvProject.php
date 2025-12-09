<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvProject extends Model
{
    use HasFactory;

    protected $table = 'cv_projects';

    // protected $fillable = [
    //     'cv_profile_id',
    //     'name',
    //     'description',
    //     'start_date',
    //     'end_date',
    //     'url',
    // ];
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function profile()
    {
        return $this->belongsTo(CvProfile::class, 'cv_profile_id');
    }
}

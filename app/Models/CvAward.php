<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvAward extends Model
{
    use HasFactory;

    protected $table = 'cv_awards';

    // protected $fillable = [
    //     'cv_profile_id',
    //     'name',
    //     'organization',
    //     'year',
    //     'description',
    // ];
    protected $guarded = [];
    
    protected $casts = [
        // 'year' => 'int',
    ];

    public function profile()
    {
        return $this->belongsTo(CvProfile::class, 'cv_profile_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvSkill extends Model
{
    use HasFactory;

    protected $table = 'cv_skills';

    // protected $fillable = [
    //     'cv_profile_id',
    //     'name',
    //     'group',
    //     'year_of_experience',
    // ];
    protected $guarded = [];

    public function profile()
    {
        return $this->belongsTo(CvProfile::class, 'cv_profile_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvLanguage extends Model
{
    use HasFactory;

    protected $table = 'cv_languages';

    // protected $fillable = [
    //     'cv_profile_id',
    //     'language',
    //     'proficiency',
    // ];
    protected $guarded = [];

    public function profile()
    {
        return $this->belongsTo(CvProfile::class, 'cv_profile_id');
    }
}

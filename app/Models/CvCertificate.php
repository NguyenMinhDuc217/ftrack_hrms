<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvCertificate extends Model
{
    use HasFactory;

    protected $table = 'cv_certificates';

    // protected $fillable = [
    //     'cv_profile_id',
    //     'name',
    //     'organization',
    //     'issue_date',
    //     'expiration_date',
    //     'url',
    // ];
    protected $guarded = [];

    protected $casts = [
        'issue_date' => 'date',
        'expiration_date' => 'date',
    ];

    public function profile()
    {
        return $this->belongsTo(CvProfile::class, 'cv_profile_id');
    }
}

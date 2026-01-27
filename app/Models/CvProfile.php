<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvProfile extends Model
{
    use HasFactory;

    protected $table = 'cv_profiles';

    // protected $fillable = [
    //     'user_id',
    //     'title',
    //     'summary',
    // ];
    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'gender' => Gender::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function avatar()
    {
        return $this->belongsTo(UserDocument::class, 'avatar_file_id');
    }

    public function educations()
    {
        return $this->hasMany(CvEducation::class)->orderBy('start_date', 'desc');
    }

    public function experiences()
    {
        return $this->hasMany(CvExperience::class)->orderBy('start_date', 'desc');
    }

    public function skills()
    {
        return $this->hasMany(CvSkill::class);
    }

    public function languages()
    {
        return $this->hasMany(CvLanguage::class);
    }

    public function projects()
    {
        return $this->hasMany(CvProject::class);
    }

    public function certificates()
    {
        return $this->hasMany(CvCertificate::class);
    }

    public function awards()
    {
        return $this->hasMany(CvAward::class);
    }
}

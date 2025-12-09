<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Gender;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guard_name = 'web';

    protected $fillable = [
        'google_id',
        'username',
        'email',
        'email_verified_at',
        'password',
        'phone_number',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'hire_date',
        'department_id',
        'manager_id',
        'document_id',
        'employment_type',
        'applicant',
        'status',
    ];

    public function searchable(): array
    {
        return [
            'search',
            'username',
            'google_id',
            'email',
            'phone_number',
            'first_name',
            'last_name',
            'gender',
            'hire_date',
            'department_id',
            'manager_id',
            'employment_type',
            'status',
        ];
    }

    protected $primaryKey = 'user_id';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'gender' => Gender::class,
            'status' => UserStatus::class,
        ];
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function getFullNameAttribute(): string
    {
        if ($this->first_name || $this->last_name) {
            return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
        }

        return "";
    }

    public function cvProfile()
    {
        return $this->hasOne(CvProfile::class, 'user_id', 'user_id');
    }
}

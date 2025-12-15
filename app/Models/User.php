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
    use HasFactory, HasRoles, Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guard_name = 'web';

    protected $fillable = [
        'email',
        'username',
        'first_name',
        'last_name',
        'province_ids',
        'phone_number',
        'email_verified_at',
        'password',
        'avatar',
        'height',
        'gender',
        'date_of_birth',
        'hire_date',
        'manager_id',
        'document_default_id',
        'role_id',
        'employment_type',
        'applicant',
        'org_id',
        'google_id',
        'login_type',
        'status',
    ];

    public function searchable(): array
    {
        return [
            'search',
            'email',
            'username',
            'first_name',
            'last_name',
            'province_ids',
            'phone_number',
            'height',
            'gender',
            'date_of_birth',
            'hire_date',
            'manager_id',
            'document_default_id',
            'role_id',
            'employment_type',
            'applicant',
            'org_id',
            'login_type',
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

    public function getFullNameAttribute(): string
    {
        if ($this->first_name || $this->last_name) {
            return trim(($this->first_name ?? '').' '.($this->last_name ?? ''));
        }

        return '';
    }

    public function cvProfile()
    {
        return $this->hasOne(CvProfile::class, 'user_id', 'user_id');
    }
}

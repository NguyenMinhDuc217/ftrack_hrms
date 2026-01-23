<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'organizations';

    protected $primaryKey = 'org_id';

    protected $fillable = [
        'name',
        'image_id',
        'slug',
        'description',
        'email',
        'phone_number',
        'address',
        'link',
        'business_field',
        'workforce_size',
        'latitude',
        'longitude',
        'status',
    ];

    #[Scope]
    protected function scopeActive($query)
    {
        return $query->where('status', 'active')->where('deleted_at', null);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function jobs()
    {
        return $this->hasMany(JobHrms::class, 'org_id', 'org_id')->where('jobs_hrms.status', 1)->where('jobs_hrms.deleted_at', null);
    }
}

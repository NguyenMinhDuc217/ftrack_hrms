<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class JobHrms extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';

    protected $table = 'jobs_hrms';

    protected $fillable = [
        'job_id',
        'name',
        'slug',
        'image_ids',
        'profession_ids',
        'tag_ids',
        'employment_type',
        'description_md',
        'requirements_md',
        'min_salary',
        'max_salary',
        'currency',
        'org_id',
        'start_date',
        'end_date',
        'experience',
        'status',
    ];

    public function searchable(): array
    {
        return [
            'name',
            'slug',
            'profession_id',
            'province_id',
            'employment_type',
            'headcount',
            'description_md',
            'requirements_md',
            'min_salary',
            'max_salary',
            'currency',
            'org_id',
            'status',
        ];
    }

    protected $primaryKey = 'job_id';

    protected $casts = [
        'image_ids' => 'array',
        'profession_ids' => 'array',
        'tag_ids' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('start_date', '<=', today())
            ->where('end_date', '>=', today())
            ->where('status', 1)
            ->where('deleted_at', null);
    }

    // RELATIONSHIP
    public function professions()
    {
        if (empty($this->profession_ids)) {
            return collect();
        }

        return Profession::whereIn('profession_id', $this->profession_ids)
            ->where('status', 'active')
            ->where('deleted_at', null)
            ->get();
    }

    public function tags()
    {
        if (empty($this->tag_ids)) {
            return collect();
        }

        return Tag::whereIn('id', $this->tag_ids)
            ->where('deleted_at', null)
            ->get();
    }

    public function job_area()
    {
        return $this->hasMany(JobArea::class, 'job_id', 'job_id')->where('status', 'active')->where('deleted_at', null);
    }

    public function images()
    {
        if (empty($this->image_ids)) {
            return collect();
        }

        return Image::whereIn('id', $this->image_ids)
            ->where('status', 1)
            ->where('deleted_at', null)
            ->get();
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id')->where('status', 'active')->where('deleted_at', null);
    }

    // BOOT
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (empty($job->slug)) {
                $job->slug = static::generateUniqueSlug($job->name);
            }
        });

        static::updating(function ($job) {
            if ($job->isDirty('name')) { // isDirty('name') kiểm tra name có bị thay đổi k ấy mà! mấy con gà đã đọc được dòng này
                $job->slug = static::generateUniqueSlug($job->name);
            }
            // if (empty($job->slug)) {
            //     $job->slug = static::generateUniqueSlug($job->name);
            // }
        });
    }

    public static function generateUniqueSlug($name, $job_id = null)
    {
        $slug = Str::slug($name);

        $count = static::where('slug', 'LIKE', "{$slug}%")
            ->when($job_id, function ($query) use ($job_id) {
                return $query->where('job_id', '!=', $job_id);
            })->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getUrlAttribute()
    {
        return route('client.job.detail', $this->slug);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class Tag extends Model
{
    use SoftDeletes;

    protected $table = 'tags';

    protected $fillable = [
        'name',
        'slug',
        'type',
        'color',
        'icon',
    ];

    public function scopeActive()
    {
        return Tag::where('deleted_at', null);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = static::generateUniqueSlug($tag->name);
            }
        });

        static::updating(function ($tag) {
            if ($tag->isDirty('name')) { // isDirty('name') kiểm tra name có bị thay đổi k ấy mà! mấy con gà đã đọc được dòng này
                $tag->slug = static::generateUniqueSlug($tag->name);
            }
            // if (empty($job->slug)) {
            //     $job->slug = static::generateUniqueSlug($job->name);
            // }
        });
    }

    public static function generateUniqueSlug($name, $tag_id = null)
    {
        $slug = Str::slug($name);

        $count = static::where('slug', 'LIKE', "{$slug}%")
            ->when($tag_id, function ($query) use ($tag_id) {
                return $query->where('tag_id', '!=', $tag_id);
            })->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

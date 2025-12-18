<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $blog_id
 * @property string|null $title
 * @property string|null $content
 * @property string|null $slug
 * @property int $user_id
 * @property int $category_id
 * @property string|null $image
 * @property int $view_count
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $author
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereBlogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereViewCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog withoutTrashed()
 * @mixin \Eloquent
 */
class Blog extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';

    protected $fillable = [
        'title',
        'content',
        'slug',
        'user_id',
        'category_id',
        'image',
        'view_count',
        'status',
    ];

    public function searchable(): array
    {
        return [
            'title',
            'content',
            'slug',
            'user_id',
            'category_id',
            'status',
        ];
    }

    protected $primaryKey = 'blog_id';

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

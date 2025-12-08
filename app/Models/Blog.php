<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

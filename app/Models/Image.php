<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use SoftDeletes;

    protected $table = 'images';

    protected $fillable = [
        'id',
        'name',
        'type',
        'file_url',
        'file_name_original',
        'size',
        'extension',
        'mime_type',
        'uploaded_by',
        'status',
    ];

    protected $primaryKey = 'id';

    public function getUrlAttribute()
    {
        if ($this->file_url == null) {
            return null;
        }

        return Storage::disk($this->disk)->url($this->file_url);
    }
}

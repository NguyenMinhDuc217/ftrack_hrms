<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDocument extends Model
{
    use SoftDeletes;
    protected $table = 'user_documents';
    protected $fillable = [
        'user_id',
        'uploaded_by',
        'disk',
        'document_type',
        'document_title',
        'confidential',
        'file_url',
        'file_name_original',
        'size',
        'extension',
        'mime_type',
        'language',
        'org_id',
        'status',
    ];

    public function getUrlAttribute()
    {
        return \Illuminate\Support\Facades\Storage::disk($this->disk)->url($this->file_url);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class UserDocument extends Model
{
    use SoftDeletes;

    protected $table = 'user_documents';

    protected $fillable = [
        'id',
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

    protected $primaryKey = 'id';

    public function getUrlAttribute()
    {
        // check file existed before return link
        if ($this->file_url == null) {
            return null;
        }

        return Storage::disk($this->disk)->url($this->file_url);
    }
}

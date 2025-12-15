<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';

    protected $table = 'applications';

    protected $fillable = [
        'application_id',
        'user_id',
        'job_id',
        'user_document_id',
        'applied_at',
        'status',
    ];

    protected $primaryKey = 'application_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user_document()
    {
        return $this->belongsTo(UserDocument::class, 'user_document_id');
    }
    
    public function job()
    {
        return $this->belongsTo(JobHrms::class, 'job_id');
    }

}

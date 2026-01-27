<?php

namespace App\Models;

use App\Enums\GeneralStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $application_id
 * @property int|null $user_id
 * @property int|null $job_id
 * @property int|null $user_document_id
 * @property string|null $applied_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\JobHrms|null $job
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobArea> $job_area
 * @property-read int|null $job_area_count
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\UserDocument|null $user_document
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereAppliedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereUserDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application withoutTrashed()
 *
 * @mixin \Eloquent
 */
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

    public function scopeGetAllApplications($query)
    {
        if (Auth::user()->role_id != 1) { // Nếu không phải admin
            $query->whereHas('user', function ($query) {
                $query->where('role_id', '!=', 1);
            });

            return $query;
        }

        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user_document()
    {
        return $this->belongsTo(UserDocument::class, 'user_document_id')->where('user_documents.deleted_at', null);
    }

    public function job()
    {
        $query_jobs = $this->belongsTo(JobHrms::class, 'job_id')->where('jobs_hrms.status', 1)->where('jobs_hrms.deleted_at', null);
        if (Auth::user()->role_id != 1) {
            $query_jobs->where('org_id', Auth::user()->org_id);
        }

        return $query_jobs;
    }

    public function job_area()
    {
        return $this->belongsToMany(
            JobArea::class,
            'application_areas',
            'application_id',
            'job_area_id',
            'application_id',
            'job_area_id'
        )
            ->where('job_areas.status', GeneralStatus::ACTIVE)
            ->where('job_areas.deleted_at', null)
            ->where('application_areas.status', GeneralStatus::ACTIVE)
            ->where('application_areas.deleted_at', null)
            ->withTimestamps();
    }

    public function application_area()
    {
        return $this->belongsToMany(ApplicationArea::class, 'application_id')->where('application_areas.status', 'active')->where('application_areas.deleted_at', null);
    }
}

<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
 */
	class Blog extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $cv_profile_id
 * @property string $name
 * @property string $organization
 * @property string|null $year
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CvProfile $profile
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvAward newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvAward newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvAward query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvAward whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvAward whereCvProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvAward whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvAward whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvAward whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvAward whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvAward whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvAward whereYear($value)
 */
	class CvAward extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $cv_profile_id
 * @property string $name
 * @property string $organization
 * @property \Illuminate\Support\Carbon|null $issue_date
 * @property \Illuminate\Support\Carbon|null $expiration_date
 * @property string|null $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CvProfile $profile
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvCertificate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvCertificate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvCertificate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvCertificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvCertificate whereCvProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvCertificate whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvCertificate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvCertificate whereIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvCertificate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvCertificate whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvCertificate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvCertificate whereUrl($value)
 */
	class CvCertificate extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $cv_profile_id
 * @property string $school
 * @property string $degree
 * @property string $major
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property int $is_current
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CvProfile $profile
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation whereCvProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation whereDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation whereIsCurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation whereMajor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation whereSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvEducation whereUpdatedAt($value)
 */
	class CvEducation extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $cv_profile_id
 * @property string $company_name
 * @property string $position
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property bool $is_current
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CvProfile $profile
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvExperience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvExperience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvExperience query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvExperience whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvExperience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvExperience whereCvProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvExperience whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvExperience whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvExperience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvExperience whereIsCurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvExperience wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvExperience whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvExperience whereUpdatedAt($value)
 */
	class CvExperience extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $cv_profile_id
 * @property string $language
 * @property string|null $level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CvProfile $profile
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvLanguage whereCvProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvLanguage whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvLanguage whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvLanguage whereUpdatedAt($value)
 */
	class CvLanguage extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string|null $full_name
 * @property string|null $phone_number
 * @property \App\Enums\Gender|null $gender
 * @property string|null $address
 * @property string|null $province_code
 * @property string|null $province_name
 * @property string|null $province_name_en
 * @property string|null $title
 * @property string|null $summary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $avatar_file_id
 * @property-read \App\Models\File|null $avatar
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CvAward> $awards
 * @property-read int|null $awards_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CvCertificate> $certificates
 * @property-read int|null $certificates_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CvEducation> $educations
 * @property-read int|null $educations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CvExperience> $experiences
 * @property-read int|null $experiences_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CvLanguage> $languages
 * @property-read int|null $languages_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CvProject> $projects
 * @property-read int|null $projects_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CvSkill> $skills
 * @property-read int|null $skills_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile whereAvatarFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile whereProvinceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile whereProvinceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile whereProvinceNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProfile whereUserId($value)
 */
	class CvProfile extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $cv_profile_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property int $is_current
 * @property string|null $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CvProfile $profile
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProject query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProject whereCvProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProject whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProject whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProject whereIsCurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProject whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProject whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvProject whereUrl($value)
 */
	class CvProject extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $cv_profile_id
 * @property string $name
 * @property string|null $group
 * @property int|null $year_of_experience
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CvProfile $profile
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvSkill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvSkill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvSkill query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvSkill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvSkill whereCvProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvSkill whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvSkill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvSkill whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvSkill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CvSkill whereYearOfExperience($value)
 */
	class CvSkill extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $department_id
 * @property string|null $department_name
 * @property string|null $description
 * @property string|null $type
 * @property int $org_id
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereDepartmentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereOrgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereUpdatedAt($value)
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $uuid
 * @property string $disk local, public, s3, etc.
 * @property string $path
 * @property string|null $name
 * @property string|null $extension
 * @property string|null $mime_type
 * @property int $size
 * @property int|null $uploaded_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $url
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereUploadedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|File withoutTrashed()
 */
	class File extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $job_id
 * @property string|null $title
 * @property int|null $department_id
 * @property string|null $employment_type
 * @property int|null $headcount
 * @property string|null $description_md
 * @property string|null $requirements_md
 * @property string|null $min_salary
 * @property string|null $max_salary
 * @property string|null $currency Tiền tệ
 * @property string|null $application_position
 * @property int $org_id
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Department|null $department
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereApplicationPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereDescriptionMd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereEmploymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereHeadcount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereMaxSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereMinSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereOrgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereRequirementsMd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job withoutTrashed()
 */
	class Job extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $job_id
 * @property string|null $title
 * @property int|null $department_id
 * @property string|null $employment_type
 * @property int|null $headcount
 * @property string|null $description_md
 * @property string|null $requirements_md
 * @property string|null $min_salary
 * @property string|null $max_salary
 * @property string|null $currency Tiền tệ
 * @property string|null $application_position
 * @property int $org_id
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Department|null $department
 * @property-read \App\Models\Province|null $province
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereApplicationPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereDescriptionMd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereEmploymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereHeadcount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereMaxSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereMinSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereOrgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereRequirementsMd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobHrms withoutTrashed()
 */
	class JobHrms extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $label
 * @property string $slug
 * @property string $type
 * @property string|null $route_name
 * @property string|null $url
 * @property string|null $icon
 * @property string|null $badge
 * @property int|null $parent_id
 * @property int $position
 * @property bool $is_active
 * @property string $guard_name
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Menu> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\User|null $creator
 * @property-read Menu|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu root()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereBadge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereRouteName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu withoutTrashed()
 */
	class Menu extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $menu_id
 * @property int $permission_id
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Menu $menu
 * @property-read \Spatie\Permission\Models\Permission $permission
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission whereUpdatedAt($value)
 */
	class MenuPermission extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $org_id
 * @property string $name
 * @property string|null $slug
 * @property string|null $description
 * @property string|null $logo
 * @property string|null $link
 * @property string|null $phone_number
 * @property string $email
 * @property string|null $address
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization whereOrgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Organization withoutTrashed()
 */
	class Organization extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $name_en
 * @property string $full_name
 * @property string|null $full_name_en
 * @property string|null $code_name
 * @property int|null $unit_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province whereCodeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province whereFullNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Province whereUnitId($value)
 */
	class Province extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereValue($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $user_id
 * @property string $username
 * @property string|null $google_id
 * @property string $login_type
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $phone_number
 * @property string|null $first_name
 * @property string|null $last_name
 * @property \App\Enums\Gender|null $gender
 * @property string|null $date_of_birth
 * @property string|null $hire_date
 * @property int|null $department_id
 * @property int|null $manager_id
 * @property int|null $document_id
 * @property int $role_id
 * @property string|null $employment_type
 * @property int $applicant
 * @property int $org_id
 * @property \App\Enums\UserStatus $status
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\CvProfile|null $cvProfile
 * @property-read \App\Models\Department|null $department
 * @property-read string $full_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereApplicant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmploymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereHireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLoginType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereOrgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int|null $uploaded_by
 * @property string|null $document_type
 * @property string|null $document_title
 * @property int $confidential
 * @property string|null $file_url
 * @property string|null $file_name_original
 * @property int|null $size
 * @property string|null $extension
 * @property string|null $mime_type
 * @property string|null $language
 * @property int $org_id
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereConfidential($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereDocumentTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereDocumentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereFileNameOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereFileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereOrgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereUploadedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDocument withoutTrashed()
 */
	class UserDocument extends \Eloquent {}
}

namespace App\Services\Translation{
/**
 * @property int $id
 * @property string $group
 * @property string $key
 * @property array<array-key, mixed> $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageLine query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageLine whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageLine whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageLine whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageLine whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class LanguageLine extends \Eloquent {}
}


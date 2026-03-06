<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use App\Http\Requests\CvProfile\ProfilePostRequest;
use App\Models\CvAward;
use App\Models\CvCertificate;
use App\Models\CvEducation;
use App\Models\CvExperience;
use App\Models\CvLanguage;
use App\Models\CvProfile;
use App\Models\CvProject;
use App\Models\Province;
use App\Models\UserDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Fluent;
use Illuminate\Validation\Rule;
use Storage;
use Spatie\LaravelPdf\Facades\Pdf;
use function Spatie\LaravelPdf\Support\pdf;
// use Barryvdh\DomPDF\Facade\Pdf;

class CvProfileController extends Controller
{
    private $user;
    private $user_id;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->user_id = $this->user->user_id;
    }

    private function getUserProfile()
    {
        $profile = CvProfile::where('user_id', $this->user_id)->first();
        if (!$profile) {
            $profile = CvProfile::create([
                'user_id' => $this->user_id,
                'phone_number' => $this->user->phone_number,
                'full_name' => $this->user->first_name . ' ' . $this->user->last_name,
                'gender' => $this->user->gender,
                'title' => '',
                'summary' => '',
            ]);
        }
        return $profile;
    }

    public function getView()
    {
        // Get or Create a profile for the current user
        $profile = $this->getUserProfile();

        // Load relationships
        // example laod with order
        // $author->load(['books' => function ($query) {
        //     $query->orderBy('published_date', 'asc');
        // }]);
        $profile->load(['experiences' => function ($query) {
            $query->orderBy('start_date', 'desc');
        }, 'educations' => function ($query) {
            $query->orderBy('start_date', 'desc');
        }, 'skills' => function ($query) {
            $query->orderBy('group', 'desc')->orderBy('name', 'asc');
        }, 'languages' => function ($query) {
            $query->orderBy('language', 'desc');
        }, 'projects' => function ($query) {
            $query->orderBy('start_date', 'desc');
        }, 'awards' => function ($query) {
            $query->orderBy('year', 'desc');
        }, 'certificates' => function ($query) {
            $query->orderBy('issue_date', 'desc');
        }]);
        $provinces = Province::orderBy('name')->get();
        $genders = Gender::cases();

        $user = $this->user;
        return view('cv.partials.profile', compact('profile', 'user', 'provinces', 'genders'));
    }

    public function index()
    {
        // Get or Create a profile for the current user
        $profile = $this->getUserProfile();

        // Load relationships
        // example laod with order
        // $author->load(['books' => function ($query) {
        //     $query->orderBy('published_date', 'asc');
        // }]);
        $profile->load(['experiences' => function ($query) {
            $query->orderBy('start_date', 'desc');
        }, 'educations' => function ($query) {
            $query->orderBy('start_date', 'desc');
        }, 'skills' => function ($query) {
            $query->orderBy('group', 'desc')->orderBy('name', 'asc');
        }, 'languages' => function ($query) {
            $query->orderBy('language', 'desc');
        }, 'projects' => function ($query) {
            $query->orderBy('start_date', 'desc');
        }, 'awards' => function ($query) {
            $query->orderBy('year', 'desc');
        }, 'certificates' => function ($query) {
            $query->orderBy('issue_date', 'desc');
        }]);
        $provinces = Province::orderBy('name')->get();
        $genders = Gender::cases();

        $user = $this->user;
        return view('cv.profile.index', compact('profile', 'user', 'provinces', 'genders'));
    }

    public function edit()
    {
        $profile = $this->getUserProfile();
        $user = $this->user;
        $provinces = Province::orderBy('name')->get();
        $genders = Gender::cases();
        $completionPercentage = $this->calculateCompletion($profile, $user);
        return view('cv.profile.edit', compact('profile', 'user', 'provinces', 'genders', 'completionPercentage'));
    }

    public function saveAll(ProfilePostRequest $request, \App\Services\UserDocumentService $userDocumentService) {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $profile = $this->getUserProfile();

            // SUMMARY
                if ($request->has('province_code')) {
                    $province = Province::where('code', $request->province_code)->first();
                    if ($province) {
                        $data['info']['province_name'] = $province->full_name;
                        $data['info']['province_name_en'] = $province->full_name_en;
                    }
                }

                $userData = array();
                $userData['date_of_birth'] = $data['info']['date_of_birth'] ? date('Y-m-d', strtotime($data['info']['date_of_birth'])) : null;
                $avatar = $data['info']['avatar'] ?? null;
                unset($data['info']['date_of_birth']);
                unset($data['info']['avatar']);

                // if ($request->hasFile('avatar')) {
                if (isset($avatar)) {
                    $oldFile = $profile->avatar;
                    $userDocument =  new UserDocument([
                        'user_id' => $this->user_id,
                        'uploaded_by' => $this->user_id,
                        'document_type' => 'avatar',
                        'document_title' => 'Avatar',
                        'confidential' => false,
                        'org_id' => $this->user->org_id,
                    ]);
                    $file = $userDocumentService->upload($avatar, $userDocument, 'avatars');
                    $data['info']['avatar_file_id'] = $file->id;
                    if ($oldFile) {
                        $userDocumentService->delete($oldFile);
                    }
                }
                $profile->update($data['info']);

                
                $user = $this->user;
                if (empty($user->phone_number)) {
                    $userData['phone_number'] = $data['info']['phone_number'] ?? null;
                }
                $user->update($userData);
            // END SUMMARY

            // SKILLS
                $skillData = $data["skill"] ?? [];
                foreach ($skillData as $group) {
                    $skill['cv_profile_id'] = $profile->id;
                    $groupName = $group['group'] ?? null;
                    $oldGroupName = $group['old_group'] ?? null;
                    $targetDelete = $oldGroupName ? $oldGroupName : $groupName;
                    $profile->skills()->where('group', $targetDelete)->delete();
                    foreach ($group['skills'] as $skill) {
                        $profile->skills()->create([
                            'name' => $skill['newSkillName'] ?? null,
                            'group' => $groupName,
                            'year_of_experience' => $skill['newSkillExp'] ?? null,
                        ]);
                    }
                }
            // END SKILLS

            // EXPERIENCES
                $expData = $data["exp"] ?? [];
                foreach ($expData as $exp) {
                    $exp['cv_profile_id'] = $profile->id;
                    $exp['start_date'] = !empty($exp['start_date']) ? date('Y-m-d', strtotime($exp['start_date'] . '-01')) : null;
                    $exp['end_date'] = !empty($exp['end_date']) ? date('Y-m-d', strtotime($exp['end_date'] . '-01')) : null;
                    if (isset($exp['id'])) {
                        $experience = $profile->experiences()->findOrFail($exp['id']);
                        unset($exp['id']);
                        $experience->update($exp);
                    } else {
                        $experience = $profile->experiences()->create($exp);
                    }
                }
            // END EXPERIENCES

            // EDUCATIONS
                $eduData = $data["edu"] ?? [];
                foreach ($eduData as $edu) {
                    $edu['cv_profile_id'] = $profile->id;
                    $edu['start_date'] = !empty($edu['start_date']) ? date('Y-m-d', strtotime($edu['start_date'] . '-01')) : null;
                    $edu['end_date'] = !empty($edu['end_date']) ? date('Y-m-d', strtotime($edu['end_date'] . '-01')) : null;
                    if (isset($edu['id'])) {
                        $education = $profile->educations()->findOrFail($edu['id']);
                        unset($edu['id']);
                        $education->update($edu);
                    } else {
                        $education = $profile->educations()->create($edu);
                    }
                }
            // END EDUCATIONS

            // PROJECTS
                $projData = $data["proj"] ?? [];
                foreach ($projData as $proj) {
                    $proj['cv_profile_id'] = $profile->id;
                    $proj['start_date'] = !empty($proj['start_date']) ? date('Y-m-d', strtotime($proj['start_date'] . '-01')) : null;
                    $proj['end_date'] = !empty($proj['end_date']) ? date('Y-m-d', strtotime($proj['end_date'] . '-01')) : null;
                    if (isset($proj['id'])) {
                        $project = $profile->projects()->findOrFail($proj['id']);
                        unset($proj['id']);
                        $project->update($proj);
                    } else {
                        $project = $profile->projects()->create($proj);
                    }
                }
            // END PROJECTS

            DB::commit();

            $redirect_to = session()->pull('redirect_to') ?? '';
            
            return response()->json([
                'success' => true,
                'message' => __('cv.profile_updated_successfully'),
                'redirect_to' => $redirect_to
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response()->json([
                'success' => false,
                'message' => __('cv.something_went_wrong'),
            ]);
        }
    }


    private function calculateCompletion($profile, $user)
    {
        $score = 0;
        $maxScore = 100;
        $sectionScore = 20;

        // 1. Personal Information (20%)
        // Check essential fields
        if (
            !empty($profile->full_name) &&
            !empty($profile->title) &&
            !empty($profile->gender) &&
            !empty($profile->phone_number) &&
            !empty($profile->province_code) &&
            !empty($user->date_of_birth) &&
            !empty($profile->address)
        ) {
             $score += $sectionScore;
        }

        // 2. Skills (20%)
        if ($profile->skills()->count() > 0) {
            $score += $sectionScore;
        }

        // 3. Work Experience (20%)
        if ($profile->experiences()->count() > 0) {
            $score += $sectionScore;
        }

        // 4. Education (20%)
        if ($profile->educations()->count() > 0) {
            $score += $sectionScore;
        }

        // 5. Projects (20%)
        if ($profile->projects()->count() > 0) {
             $score += $sectionScore;
        }

        return $score;
    }

    public function saveSummary(Request $request, \App\Services\UserDocumentService $userDocumentService)
    {
        $profile = $this->getUserProfile();

        $rules = [
            'full_name' => ['required', 'string', 'max:64'],
            'title' => ['required', 'string', 'max:64'],
            'gender' => ['required', 'string', Rule::enum(Gender::class)],
            'phone_number' => ['required', 'max:10', 'regex:/^\d{10}$/'],
            'address' => ['nullable', 'string', 'max:255'],
            'province_code' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'avatar' => ['nullable', 'image', 'max:2048'], // 2MB Max
        ];
        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }

        // Prepare data for update
        $data = $request->only([
            'full_name',
            'title',
            'gender',
            'phone_number',
            'address',
            'province_code',
            'summary',
        ]);

        $userData = $request->only([
            'date_of_birth',
        ]);


        // Look up province names based on the selected code
        if ($request->has('province_code')) {
            $province = Province::where('code', $request->province_code)->first();
            if ($province) {
                $data['province_name'] = $province->full_name;
                $data['province_name_en'] = $province->full_name_en;
            }
        }

        // Handle Avatar Upload
        if ($request->hasFile('avatar')) {
            $oldFile = $profile->avatar;
            $userDocument =  new UserDocument([
                'user_id' => $this->user_id,
                'uploaded_by' => $this->user_id,
                'document_type' => 'avatar',
                'document_title' => 'Avatar',
                'confidential' => false,
                'org_id' => $this->user->org_id,
            ]);
            $file = $userDocumentService->upload($request->file('avatar'), $userDocument, 'avatars');
            $data['avatar_file_id'] = $file->id;
            if ($oldFile) {
                $userDocumentService->delete($oldFile);
            }
        }

        $profile->update($data);
        $user = $this->user;
        if (empty($user->phone_number)) {
            $userData['phone_number'] = $data['phone_number'];
        }
        $user->update($userData);
        $provinces = Province::orderBy('name')->get();
        $genders = Gender::cases();
        $profile->load('avatar');
        return $this->getView();
    }

    // --- EXPERIENCE SECTION (1-to-Many) ---
    public function saveExperience(Request $request)
    {
        $profile = $this->getUserProfile();

        $ruleModel = new CvExperience();
        $rules = [
            'id' => ['nullable', Rule::exists($ruleModel->getTable(), $ruleModel->getKeyName())],
            'position' => ['required', 'string', 'max:64'],
            'company_name' => ['required', 'string', 'max:64'],
            'is_current' => ['nullable', 'boolean'],
            'start_date' => ['required', 'date_format:Y-m'],
            'end_date' => ['required_without:is_current', 'date_format:Y-m', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string', 'max:3000'],
        ];
        $validator = Validator::make($request->all(), $rules, [
            'end_date.required_without' => __('cv.validation_required'),
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }

        $data = $request->only([
            'id',
            'position',
            'company_name',
            'is_current',
            'start_date',
            'end_date',
            'description',
        ]);

        $data['cv_profile_id'] = $profile->id;
        $data['start_date'] = !empty($request->start_date) ? date('Y-m-d', strtotime($request->start_date . '-01')) : null;
        $data['end_date'] = !empty($request->end_date) ? date('Y-m-d', strtotime($request->end_date . '-01')) : null;

        if (isset($data['id'])) {
            $experience = $profile->experiences()->findOrFail($data['id']);
            unset($data['id']);
            $experience->update($data);
        } else {
            $experience = $profile->experiences()->create($data);
        }

        // Refresh list
        $experiences = $this->experienceDTO($profile->experiences()->orderBy('start_date', 'desc')->get());

        // Return the Updated Partial View
        return $this->getView();
    }

    public function deleteExperience($id)
    {
        $profile = $this->getUserProfile();
        // ensure experience belongs to the profile
        $experience = $profile->experiences()->findOrFail($id);
        $experience->delete();
        $experiences = $this->experienceDTO($profile->experiences()->orderBy('start_date', 'desc')->get());
        return $this->getView();
    }

    // --- 3. Education ---
    public function getEducation($id)
    {
        $profile = $this->getUserProfile();
        $education = $profile->educations()->findOrFail($id);
        return response()->json($education);
    }

    public function saveEducation(Request $request)
    {
        $profile = $this->getUserProfile();

        $ruleModel = new CvEducation();
        $rules = [
            'id' => ['nullable', Rule::exists($ruleModel->getTable(), $ruleModel->getKeyName())],
            'school' => ['required', 'string', 'max:64'],
            'degree' => ['required', 'string', 'max:64'],
            'major' => ['required', 'string', 'max:64'],
            'is_current' => ['nullable', 'boolean'],
            'start_date' => ['required', 'date_format:Y-m'],
            'end_date' => ['required_without:is_current', 'date_format:Y-m', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string', 'max:3000'],
        ];
        $validator = Validator::make($request->all(), $rules, [
            'end_date.required_without' => __('cv.validation_required'),
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }

        $data = $request->only([
            'id',
            'school',
            'degree',
            'major',
            'is_current',
            'description',
        ]);

        $data['cv_profile_id'] = $profile->id;
        $data['start_date'] = !empty($request->start_date) ? date('Y-m-d', strtotime($request->start_date . '-01')) : null;
        $data['end_date'] = !empty($request->end_date) ? date('Y-m-d', strtotime($request->end_date . '-01')) : null;

        if (isset($data['id'])) {
            $education = $profile->educations()->findOrFail($data['id']);
            unset($data['id']);
            $education->update($data);
        } else {
            $education = $profile->educations()->create($data);
        }

        $educations = $this->educationDTO($profile->educations()->orderBy('start_date', 'desc')->get());
        return $this->getView();
    }
    public function deleteEducation($id)
    {
        $profile = $this->getUserProfile();
        // ensure education belongs to the profile
        $education = $profile->educations()->findOrFail($id);
        $education->delete();
        $educations = $this->educationDTO($profile->educations()->orderBy('start_date', 'desc')->get());
        return $this->getView();
    }

    // --- 4. Skills ---
    public function saveSkillGroup(Request $request)
    {
        $profile = $this->getUserProfile();

        $validator = Validator::make($request->all(), [
            'group' => ['required', 'string', 'max:64'],
            'old_group' => ['nullable', 'string', 'max:64'],
            'skills' => ['nullable', 'array'],
            'skills.*.name' => ['required', 'string', 'max:64'],
            'skills.*.year_of_experience' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }

        // DB Transaction to ensure atomicity
        DB::transaction(function () use ($profile, $request) {
            $groupName = $request->group;
            $oldGroupName = $request->old_group;

            // 1. Delete existing skills in the target group (or old group if renaming)
            // If we are renaming, we delete from the old name.
            // If we are just saving to 'Backend', we delete previous 'Backend' skills to overwrite them
            // (assuming the modal sends the FULL list of skills for that group).

            $targetDelete = $oldGroupName ? $oldGroupName : $groupName;

            // Clean up old skills for this group
            $profile->skills()->where('group', $targetDelete)->delete();

            // 2. Create new skills
            if ($request->has('skills') && \is_array($request->skills)) {
                foreach ($request->skills as $skillData) {
                    $profile->skills()->create([
                        'name' => $skillData['name'],
                        'group' => $groupName,
                        'year_of_experience' => $skillData['year_of_experience'] ?? null,
                    ]);
                }
            }
        });

        $skills = $profile->skills()->orderBy('group')->orderBy('name')->get();
        return $this->getView();
    }

    public function deleteSkillGroup(Request $request)
    {
        $profile = $this->getUserProfile();
        $group = $request->group;
        if ($group) {
            $profile->skills()->where('group', $group)->delete();
        }
        $skills = $profile->skills()->orderBy('group')->orderBy('name')->get();
        return $this->getView();
    }

    // --- 5. Languages ---
    public function saveLanguage(Request $request)
    {
        $profile = $this->getUserProfile();
        $rulemodel = new CvLanguage();
        $rules = [
            'id' => ['nullable', Rule::exists($rulemodel->getTable(), $rulemodel->getKeyName())],
            'language' => ['required', 'string', 'max:64'],
            'level' => ['required', 'string', 'max:64'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }

        $data = $request->only(['language', 'level']);

        $profile->languages()->updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return $this->getView();
    }
    public function deleteLanguage($id)
    {
        $profile = $this->getUserProfile();

        $language = $profile->languages()->findOrFail($id);
        $language->delete();
        return $this->getView();
    }

    // --- 6. Projects ---
    public function saveProject(Request $request)
    {
        $profile = $this->getUserProfile();
        $ruleModel = new CvProject();
        $rules = [
            'id' => ['nullable', Rule::exists($ruleModel->getTable(), $ruleModel->getKeyName())],
            'name' => ['required', 'string', 'max:64'],
            'url' => ['nullable', 'url'],
            'is_current' => ['nullable', 'boolean'],
            'start_date' => ['required', 'date_format:Y-m'],
            'end_date' => ['required_without:is_current', 'date_format:Y-m', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string', 'max:3000'],
        ];
        $validator = Validator::make($request->all(), $rules, [
            'end_date.required_without' => __('cv.validation_required'),
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }

        $data = $request->only(['id', 'name', 'url', 'description', 'is_current']);

        $data['cv_profile_id'] = $profile->id;
        $data['start_date'] = !empty($request->start_date) ? date('Y-m-d', strtotime($request->start_date . '-01')) : null;
        $data['end_date'] = !empty($request->end_date) ? date('Y-m-d', strtotime($request->end_date . '-01')) : null;

        if (isset($data['id'])) {
            $project = $profile->projects()->findOrFail($data['id']);
            unset($data['id']);
            $project->update($data);
        } else {
            $project = $profile->projects()->create($data);
        }

        $projects = $profile->projects()->orderBy('start_date', 'desc')->get();
        $projects = $this->projectsDTO($projects);
        return $this->getView();
    }
    public function deleteProject($id)
    {
        $profile = $this->getUserProfile();
        // ensure project belongs to the profile
        $project = $profile->projects()->findOrFail($id);
        $project->delete();
        $projects = $profile->projects()->orderBy('start_date', 'desc')->get();
        $projects = $this->projectsDTO($projects);
        return $this->getView();
    }

    // --- 7. Certificates ---
    public function saveCertificate(Request $request)
    {
        $profile = $this->getUserProfile();
        $ruleModel = new CvCertificate();
        $rules = [
            'id' => ['nullable', Rule::exists($ruleModel->getTable(), $ruleModel->getKeyName())],
            'name' => ['required', 'string', 'max:255'],
            'organization' => ['nullable', 'string', 'max:255'],
            'issue_date' => ['nullable', 'date_format:Y-m'],
            'expiration_date' => ['nullable', 'date_format:Y-m', 'after_or_equal:issue_date'],
            'url' => ['nullable', 'url', 'max:1000'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }
        $data = $request->only(['id', 'name', 'organization', 'issue_date', 'expiration_date', 'url']);
        $data['cv_profile_id'] = $profile->id;
        $data['issue_date'] = !empty($request->issue_date) ? date('Y-m-d', strtotime($request->issue_date . '-01')) : null;
        $data['expiration_date'] = !empty($request->expiration_date) ? date('Y-m-d', strtotime($request->expiration_date . '-01')) : null;
        if (isset($data['id'])) {
            $certificate = $profile->certificates()->findOrFail($data['id']);
            unset($data['id']);
            $certificate->update($data);
        } else {
            $certificate = $profile->certificates()->create($data);
        }

        $certificates = $this->certificatesDTO($profile->certificates()->orderBy('issue_date', 'desc')->get());
        return $this->getView();
    }
    public function deleteCertificate($id)
    {
        $profile = $this->getUserProfile();
        // ensure certificate belongs to the profile
        $certificate = $profile->certificates()->findOrFail($id);
        $certificate->delete();
        $certificates = $this->certificatesDTO($profile->certificates()->orderBy('issue_date', 'desc')->get());
        return $this->getView();
    }

    // --- 8. Awards ---
    public function saveAward(Request $request)
    {
        $profile = $this->getUserProfile();
        $ruleModel = new CvAward();
        $rules = [
            'id' => ['nullable', Rule::exists($ruleModel->getTable(), $ruleModel->getKeyName())],
            'name' => ['required', 'string', 'max:255'],
            'organization' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'date_format:Y'],
            'description' => ['nullable', 'string', 'max:3000'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }
        $data = $request->only(['id', 'name', 'organization', 'year', 'description']);
        $data['cv_profile_id'] = $profile->id;
        if ($data['id']) {
            $award = $profile->awards()->findOrFail($data['id']);
            unset($data['id']);
            $award->update($data);
        } else {
            $award = $profile->awards()->create($data);
        }
        $awards = $profile->awards()->orderByDesc('year')->get();
        return $this->getView();
    }
    public function deleteAward($id)
    {
        $profile = $this->getUserProfile();
        // ensure award belongs to the profile
        $award = $profile->awards()->findOrFail($id);
        $award->delete();
        $awards = $profile->awards()->orderByDesc('year')->get();
        return $this->getView();
    }

    private function projectsDTO($projects)
    {
        return $projects->map(function ($project) {
            $project->start_date = !empty($project->start_date) ? date('Y-m', strtotime($project->start_date)) : null;
            $project->end_date = !empty($project->end_date) ? date('Y-m', strtotime($project->end_date)) : null;
            return $project;
        });
    }

    private function educationDTO($education)
    {
        return $education->map(function ($education) {
            $education->start_date = !empty($education->start_date) ? date('Y-m', strtotime($education->start_date)) : null;
            $education->end_date = !empty($education->end_date) ? date('Y-m', strtotime($education->end_date)) : null;
            return $education;
        });
    }

    private function experienceDTO($experience)
    {
        return $experience->map(function ($experience) {
            $experience->start_date = !empty($experience->start_date) ? date('Y-m', strtotime($experience->start_date)) : null;
            $experience->end_date = !empty($experience->end_date) ? date('Y-m', strtotime($experience->end_date)) : null;
            return $experience;
        });
    }

    private function certificatesDTO($certificates)
    {
        return $certificates->map(function ($certificate) {
            $certificate->issue_date = !empty($certificate->issue_date) ? date('Y-m', strtotime($certificate->issue_date)) : null;
            $certificate->expiration_date = !empty($certificate->expiration_date) ? date('Y-m', strtotime($certificate->expiration_date)) : null;
            return $certificate;
        });
    }

    public function createCv()
    {
        $profile = $this->getUserProfile();
        $user = $this->user;
        $cv_templates = [
            '1' => [
                'name' => 'C',
                'blade' => 'client.cv.cv1',
            ],
            '2' => [
                'name' => 'P',
                'blade' => 'client.cv.cv2',
            ],
            '3' => [
                'name' => 'M',
                'blade' => 'client.cv.cv3',
            ],
        ];
        return view('client.cv.create-cv', compact('cv_templates'));
    }
    

    public function previewDownloadPdf(Request $request, $key = 1, $type = '')
    {
        $theme = $request->theme ?? 'light';

        // $options = cv_template_options();
        $options = [
            '1' => [
                'name' => 'C',
                'blade' => 'client.cv.cv1',
            ],
            '2' => [
                'name' => 'P',
                'blade' => 'client.cv.cv2',
            ],
            '3' => [
                'name' => 'M',
                'blade' => 'client.cv.cv3',
            ],
        ];
        if (!isset($options[$key]) || !view()->exists($options[$key]['blade'])) {
            $key = 1;
        }
        $template = $options[$key]['blade'];
        $profile = $this->getUserProfile();
        $user = $this->user;
        if ($type == 'preview') {
            return view($template, compact('profile', 'user', 'theme'));
        } else if ($type == 'download') {
            if ($request->type_cv == 'example') {
                $data = $this->getExampleData();
                $profile = $data['profile'];
                $user = $data['user'];
            }
            return pdf()->view($template, compact('profile', 'user', 'theme'))
                ->format('a4')
                ->name('preview-cv.pdf')
                ->withBrowsershot(function ($browsershot) {
                    $browsershot->windowSize(1280, 1024) // Giả lập màn hình desktop
                        ->waitUntilNetworkIdle();  // Đợi tải xong font/ảnh các thứ các thứ
                })
                ->download();
        } else if ($type == 'example') {
            $data = $this->getExampleData();
            $profile = $data['profile'];
            $user = $data['user'];
            return view($template, compact('profile', 'user', 'theme'));
        }
    }

    public function checkProfile() {
        $profile = $this->getUserProfile();
        $user = $this->user;
        if ($profile && $user) {
            if (empty($profile->full_name) || empty($profile->phone_number) || empty($profile->address) || empty($user->email)) {
                session()->put('redirect_to', route('profile.create-cv'));
                return response()->json([
                    'success' => false,
                    'message' => __('cv.profile_is_not_complete'),
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => __('cv.profile_is_complete'),
                ]);
            }
        } else {
            session()->put('redirect_to', route('profile.create-cv'));
            return response()->json([
                'success' => false,
                'message' => __('cv.user_or_profile_does_not_exist'),
            ]);
        }
    }

    private function getExampleData()
    {
        // Giả lập User
        $user = new Fluent([
            'email' => 'nguyenvana@example.com',
            'date_of_birth' => Carbon::parse('2001-02-21'),
        ]);

        // Giả lập Profile
        $profile = new Fluent([
            'full_name' => __('cv.cv_full_name'),
            'title' => __('cv.cv_title'),
            'phone_number' => __('cv.cv_phone_number'),
            'province_name' => __('cv.cv_proivince_name'),
            'province_name_en' => __('cv.cv_province_name_en'),
            'summary' => __('cv.cv_summary'),
            'avatar' => new Fluent(['url' => 'https://i.pravatar.cc/300']),
            'skills' => collect([
                new Fluent(['name' => 'Office informatics', 'group' => 'Technical', 'year_of_experience' => 5]),
                new Fluent(['name' => 'English', 'group' => 'Technical', 'year_of_experience' => 3]),
                new Fluent(['name' => 'Japanese', 'group' => 'Technical', 'year_of_experience' => 2]),
                new Fluent(['name' => __('cv.cv_soft_skill_1'), 'group' => 'Soft Skill']),
                new Fluent(['name' => __('cv.cv_soft_skill_2'), 'group' => 'Soft Skill']),
            ]),
            'experiences' => collect([
                new Fluent([
                    'position' => __('cv.cv_exp_1_title'),
                    'company_name' => __('cv.cv_exp_1_company'),
                    'start_date' => Carbon::parse('2021-01-01'),
                    'end_date' => null, // Hiện tại
                    'description' => __('cv.cv_exp_1_description')
                ]),
                new Fluent([
                    'position' => __('cv.cv_exp_2_title'),
                    'company_name' => __('cv.cv_exp_2_company'),
                    'start_date' => Carbon::parse('2018-06-01'),
                    'end_date' => Carbon::parse('2020-12-31'),
                    'description' => __('cv.cv_exp_2_description')
                ])
            ]),
            'educations' => collect([
                new Fluent([
                    'school' => __('cv.cv_edu_1_school'),
                    'degree' => __('cv.cv_edu_1_degree'),
                    'major' => __('cv.cv_edu_1_major'),
                    'start_date' => Carbon::parse('2014-09-01'),
                    'end_date' => Carbon::parse('2018-06-01'),
                    'description' => __('cv.cv_edu_1_description')
                ])
            ]),
            'projects' => collect([
                new Fluent([
                    'name' => __('cv.cv_proj_1_name'),
                    'description' => __('cv.cv_proj_1_description'),
                    'url' => __('cv.cv_proj_1_url')
                ])
            ])
        ]);

        return [
            'user' => $user,
            'profile' => $profile
        ];
    }
}

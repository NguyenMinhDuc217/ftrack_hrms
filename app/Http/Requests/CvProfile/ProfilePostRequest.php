<?php

namespace App\Http\Requests\CvProfile;

use App\Enums\Gender;
use App\Models\CvEducation;
use App\Models\CvExperience;
use App\Models\CvProject;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfilePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    protected function failedValidation(Validator $validator)
    {
        // dd($validator);
    }

    public function rules(): array
    {
        $ruleExp = new CvExperience();
        $ruleEdu = new CvEducation();
        $ruleProj = new CvProject();
        

        return [
            // Summary
            'info.full_name' => ['required', 'string', 'max:64'],
            'info.title' => ['required', 'string', 'max:64'],
            'info.gender' => ['required', 'string', Rule::enum(Gender::class)],
            'info.phone_number' => ['required', 'max:10', 'regex:/^\d{10}$/'],
            'info.address' => ['required', 'string', 'max:255'],
            'info.province_code' => ['required', 'string', 'max:255'],
            'info.date_of_birth' => ['required', 'date', 'before:today'],
            'info.avatar' => ['nullable', 'image', 'max:2048'], // 2MB Max
            'info.summary' => ['nullable', 'string'],
            'info.avatar' => ['nullable', 'image', 'max:2048'], // 2MB Max
            // Skills
            'skill' => ['nullable', 'array'],
            'skill.*.group' => ['required', 'string', 'max:64'],
            'skill.*.old_group' => ['nullable', 'string', 'max:64'],
            'skill.*' => ['array', 'min:1'], // Mỗi group có ít nhất 1 skill (nếu group tồn tại)

            'skill.*.skills.*.newSkillName' => ['required', 'string', 'max:64'],
            
            'skill.*.skills.*.newSkillExp' => [
                'prohibited_if:skill.*.skills.*.newSkillName,,', // cấm nếu newSkillName rỗng
                'required_with:skill.*.skills.*.newSkillName',
                'integer',
                'min:0',
                'max:99',
            ],
            // Experience
            'exp.*.id' => ['nullable', 'integer'],
            'exp' => ['nullable', 'array'],
            'exp.*.position' => ['required', 'string', 'max:64'],
            'exp.*.company_name' => ['required', 'string', 'max:64'],
            'exp.*.is_current' => ['nullable', 'boolean'],
            'exp.*.start_date' => ['required', 'date_format:Y-m'],
            'exp.*.end_date' => [
                'exclude_if:exp.*.is_current,true',
                'date_format:Y-m',
                'after_or_equal:exp.*.start_date',
            ],
            'exp.*.description' => ['nullable', 'string', 'max:3000'],
            // Education
            'edu.*.id' => ['nullable', 'integer'],
            'edu' => ['nullable', 'array'],
            'edu.*.school' => ['required', 'string', 'max:64'],
            'edu.*.degree' => ['required', 'string', 'max:64'],
            'edu.*.major' => ['required', 'string', 'max:64'],
            'edu.*.is_current' => ['nullable', 'boolean'],
            'edu.*.start_date' => ['required', 'date_format:Y-m'],
            'edu.*.end_date' => [
                'exclude_if:edu.*.is_current,true',
                'date_format:Y-m',
                'after_or_equal:edu.*.start_date',
            ],
            'edu.*.description' => ['nullable', 'string', 'max:3000'],
            // Project
            'proj.*.id' => ['nullable', 'integer'],
            'proj' => ['nullable', 'array'],
            'proj.*.name' => ['required', 'string', 'max:64'],
            'proj.*.url' => ['nullable', 'url'],
            'proj.*.is_current' => ['nullable', 'boolean'],
            'proj.*.start_date' => ['required', 'date_format:Y-m'],
            'proj.*.end_date' => [
                'exclude_if:proj.*.is_current,true',
                'date_format:Y-m',
                'after_or_equal:proj.*.start_date',
            ],
            'proj.*.summary' => ['nullable', 'string', 'max:30'],
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'info.full_name.required' => 'Full name is required',
    //         'info.title.required' => 'Title is required',
    //         'info.gender.required' => 'Gender is required',
    //         'info.phone_number.required' => 'Phone number is required',
    //         'info.address.required' => 'Address is required',
    //         'info.province_code.required' => 'Province code is required',
    //         'info.date_of_birth.required' => 'Date of birth is required',
    //         'info.avatar.required' => 'Avatar is required',
    //         'info.avatar.image' => 'Avatar must be an image',
    //         'info.avatar.max' => 'Avatar size must be less than :max MB',
    //         'info.summary.max' => 'Summary must be less than :max characters',
        
    //         // SKILL
    //             // General skill array
    //             'skill.array' => 'Dữ liệu kỹ năng không hợp lệ.',

    //             // Tên nhóm kỹ năng (group)
    //             'skill.*.group.required' => ':attribute là bắt buộc.',
    //             'skill.*.group.string'   => ':attribute phải là chuỗi ký tự.',
    //             'skill.*.group.max'      => ':attribute không được vượt quá 64 ký tự.',

    //             // Tên nhóm cũ (old_group) - nếu dùng để update
    //             'skill.*.old_group.string' => ':attribute không hợp lệ.',
    //             'skill.*.old_group.max'    => ':attribute không được vượt quá 64 ký tự.',

    //             // Mỗi nhóm phải có ít nhất 1 kỹ năng
    //             'skill.*.min' => ':attribute phải có ít nhất một kỹ năng.',

    //             // Tên kỹ năng (newSkillName)
    //             'skill.*.skills.*.newSkillName.required' => 'Tên kỹ năng là bắt buộc trong nhóm này.',
    //             'skill.*.skills.*.newSkillName.string'   => ':attribute phải là chuỗi ký tự.',
    //             'skill.*.skills.*.newSkillName.max'      => ':attribute không được vượt quá 64 ký tự.',

    //             // Kinh nghiệm (newSkillExp)
    //             'skill.*.skills.*.newSkillExp.prohibited_if' => 'Không được nhập khi chưa có tên kỹ năng.',

    //             'skill.*.skills.*.newSkillExp.required_with' => 'Kinh nghiệp là bắt buộc khi bạn đã nhập tên kỹ năng.',

    //             'skill.*.skills.*.newSkillExp.integer' => ':attribute phải là số nguyên.',
    //             'skill.*.skills.*.newSkillExp.min'     => ':attribute không được nhỏ hơn 0.',
    //             'skill.*.skills.*.newSkillExp.max'     => ':attribute không được lớn hơn 99 năm.',
    //         // END SKILL
            
    //         // EXPERIENCE
    //         'exp.*.id.integer' => 'ID phải là số nguyên.',
    //         'exp.*.position_required'         => 'Vị trí là bắt buộc.',
    //         'exp.*.position_string'           => 'Vị trí phải là chuỗi',
    //         'exp.*.position_max'              => 'Vị trí không được vượt quá ::max ký tự.',
    //         'exp.*.company_name_required'     => 'Tên công ty là bắt buộc.',
    //         'exp.*.company_name_string'       => 'Tên công ty phải là chuỗi',
    //         'exp.*.company_name_max'          => 'Tên công ty không được vượt quá ::max ký tự.',
    //         'exp.*.start_date_required'       => 'Thời gian bắt đầu là bắt buộc',
    //         'exp.*.start_date_date_format'    => 'Thời gian bắt đầu phải có định dạng Y-m',
    //         'exp.*.end_date_required_without' => 'Thời gian kết thúc là bắt buộc',
    //         'exp.*.end_date_date_format'      => 'Thời gian kết thúc phải có định dạng Y-m',
    //         'exp.*.end_date_after_or_equal'   => 'Thời gian kết thúc phải sau hoặc bằng thời gian bắt đầu',
    //         'exp.*.description_string'        => 'Mô tả phải là chuỗi',
    //         'exp.*.description_max'           => 'Mô tả không được vượt quá ::max ký tự.',

    //         // EDUCATION
    //         'edu.*.id.integer'    => 'ID phải là số nguyên.',
    //         'edu.*.school.required'    => 'Vui lòng nhập tên trường học.',
    //         'edu.*.school.max'         => 'Tên trường học không được vượt quá 64 ký tự.',
    //         'edu.*.degree.required'    => 'Vui lòng nhập bằng cấp/chứng chỉ.',
    //         'edu.*.degree.max'         => 'Tên bằng cấp không được vượt quá 64 ký tự.',
    //         'edu.*.major.required'     => 'Vui lòng nhập chuyên ngành học.',
    //         'edu.*.major.max'          => 'Tên chuyên ngành không được vượt quá 64 ký tự.',
    //         'edu.*.start_date.required'=> 'Vui lòng nhập tháng bắt đầu học tập.',
    //         'edu.*.start_date.date_format' => 'Tháng bắt đầu học tập phải có định dạng YYYY-MM (Ví dụ: 2023-01).',
    //         'edu.*.end_date.date_format'   => 'Tháng kết thúc học tập phải có định dạng YYYY-MM.',
    //         'edu.*.end_date.after_or_equal' => 'Tháng kết thúc học tập không được trước tháng bắt đầu.',
    //         'edu.*.description.max'    => 'Mô tả học vấn không được vượt quá 3000 ký tự.',

    //         // PROJECT
    //         'proj.*.id.integer'           => 'ID phải là số nguyên.',
    //         'proj.*.name.required'     => 'Vui lòng nhập tên dự án.',
    //         'proj.*.name.max'          => 'Tên dự án không được vượt quá 64 ký tự.',
    //         'proj.*.url.url'           => 'Đường dẫn dự án (URL) không đúng định dạng.',
    //         'proj.*.start_date.required'   => 'Vui lòng nhập tháng bắt đầu dự án.',
    //         'proj.*.start_date.date_format' => 'Tháng bắt đầu dự án phải có định dạng YYYY-MM.',
    //         'proj.*.end_date.date_format'   => 'Tháng kết thúc dự án phải có định dạng YYYY-MM.',
    //         'proj.*.end_date.after_or_equal' => 'Tháng kết thúc dự án không được trước tháng bắt đầu.',
    //         'proj.*.description.max'   => 'Mô tả dự án không được vượt quá 3000 ký tự.',

    //         // Quy tắc chung cho Array/ID
    //         'edu.array'    => 'Dữ liệu học vấn không hợp lệ.',
    //         'proj.array'   => 'Dữ liệu dự án không hợp lệ.',
    //         'edu.*.is_current.boolean' => 'Giá trị "Đang học tại đây" phải là đúng hoặc sai.',
    //         'proj.*.is_current.boolean' => 'Giá trị "Dự án đang thực hiện" phải là đúng hoặc sai.',
            
    //     ];
    // }

    public function messages(): array
    {
        return [
            'info.full_name.required' => __('validation.required'),
            'info.full_name.string' => __('validation.string'),
            'info.title.required' => __('validation.required'),
            'info.gender.required' => __('validation.required'),
            'info.phone_number.required' => __('validation.required'),
            'info.address.required' => __('validation.required'),
            'info.province_code.required' => __('validation.required'),
            'info.date_of_birth.required' => __('validation.required'),
            'info.date_of_birth.before' => __('validation.before', ['date' => __('default.today')]),
            'info.avatar.required' =>__('validation.required'),
            'info.avatar.image' => __('validation.image'),
            'info.avatar.max' => __('validation.max.file', ['max' => 2048]),
        
            // SKILL
                // General skill array
                'skill.array' => __('validation.array'),

                // Tên nhóm kỹ năng (group)
                'skill.*.group.required' => __('validation.required'),
                'skill.*.group.string'   => __('validation.string'),
                'skill.*.group.max'      => __('validation.max.string', ['max' => 64]),

                // Tên nhóm cũ (old_group) - nếu dùng để update
                'skill.*.old_group.string' => __('validation.string'),
                'skill.*.old_group.max'    => __('validation.max.string', ['max' => 64]),

                // Mỗi nhóm phải có ít nhất 1 kỹ năng
                // 'skill.*.min' => ':attribute phải có ít nhất một kỹ năng.',
                'skill.*.min' => __('validation.min.array', ['min' => 1]),

                // Tên kỹ năng (newSkillName)
                'skill.*.skills.*.newSkillName.required' => __('validation.required'),
                'skill.*.skills.*.newSkillName.string'   => __('validation.string'),
                'skill.*.skills.*.newSkillName.max'      => __('validation.max.string', ['max' => 64]),

                // Kinh nghiệm (newSkillExp)
                'skill.*.skills.*.newSkillExp.prohibited_if' => __('validation.prohibited_if', [
                    'other' => __('cv.skill_name'),
                    'value' => __('default.txt_empty'),
                ]),
                'skill.*.skills.*.newSkillExp.required_with' => __('validation.required_with', [
                    'values' => __('cv.skill_name'),
                ]),

                'skill.*.skills.*.newSkillExp.integer' => __('validation.integer'),
                'skill.*.skills.*.newSkillExp.min'     => __('validation.min.numeric',['min: 0']),
                'skill.*.skills.*.newSkillExp.max'     => __('validation.max.numeric',['max: 99']),
            // END SKILL
            
            // EXPERIENCE
            'exp.*.id.integer' => __('validation.integer'),
            'exp.*.position.required'         => __('validation.required'),
            'exp.*.position.string'           => __('validation.string'),
            'exp.*.position.max'              => __('validation.max.string', ['max' => 64]),
            'exp.*.company_name.required'     => __('validation.required'),
            'exp.*.company_name.string'       => __('validation.string'),
            'exp.*.company_name.max'          => __('validation.max.string', ['max' => 64]),
            'exp.*.start_date.required'       => __('validation.required'),
            'exp.*.start_date.date_format'    => __('validation.date_format', ['format' => 'Y-m']),
            'exp.*.end_date.date_format'      => __('validation.date_format', ['format' => 'Y-m']),
            'exp.*.end_date.after_or_equal'   => __('validation.after_or_equal', ['date' => __('cv.start_date')]),
            'exp.*.description.string'        => __('validation.string'),
            'exp.*.description.max'           => __('validation.max.string', ['max' => 3000]),

            // EDUCATION
            'edu.*.id.integer'    => __('validation.integer'),
            'edu.*.school.required'    => __('validation.required'),
            'edu.*.school.max'         => __('validation.max.string', ['max' => 64]),
            'edu.*.degree.required'    => __('validation.required'),
            'edu.*.degree.max'         => __('validation.max.string', ['max' => 64]),
            'edu.*.major.required'     => __('validation.required'),
            'edu.*.major.max'          => __('validation.max.string', ['max' => 64]),
            'edu.*.start_date.required'=> __('validation.required'),
            'edu.*.start_date.date_format' => __('validation.date_format', ['format' => 'Y-m']),
            'edu.*.end_date.date_format'   => __('validation.date_format', ['format' => 'Y-m']),
            'edu.*.end_date.after_or_equal' => __('validation.after_or_equal', ['date' => __('cv.start_date')]),
            'edu.*.description.max'    => __('validation.max.string', ['max' => 3000]),

            // PROJECT
            'proj.*.id.integer'           => __('validation.integer'),
            'proj.*.name.required'     => __('validation.required'),
            'proj.*.name.max'          => __('validation.max.string', ['max' => 64]),
            'proj.*.url.url'           => __('validation.url'),
            'proj.*.start_date.required'   => __('validation.required'),
            'proj.*.start_date.date_format' => __('validation.date_format', ['format' => 'Y-m']),
            'proj.*.end_date.date_format'   => __('validation.date_format', ['format' => 'Y-m']),
            'proj.*.end_date.after_or_equal' => __('validation.after_or_equal', ['date' => __('cv.start_date')]),
            'proj.*.description.max'   => __('validation.max.string', ['max' => 3000]),

            // Quy tắc chung cho Array/ID
            'edu.array'    => __('validation.array'),
            'proj.array'   => __('validation.array'),
            'edu.*.is_current.boolean' => __('validation.boolean'),
            'proj.*.is_current.boolean' => __('validation.boolean'),
            
        ];
    }

    public function attributes(): array
    {
        return [
            'skill.*.group'                    => __('cv.group_name'),
            'skill.*.old_group'                => __('cv.old_group'),
            'skill.*'                          => __('cv.group_name'),
            'skill.*.skills.*.newSkillName'    => __('cv.skill_name'),
            'skill.*.skills.*.newSkillExp'     => __('cv.work_experience'),
        ];
    }
}

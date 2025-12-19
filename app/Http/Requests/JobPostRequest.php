<?php

namespace App\Http\Requests;

use App\Enums\EmploymentType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class JobPostRequest extends FormRequest
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

    // protected $stopOnFirstFailure = true; // Dừng validation sau lỗi đầu tiên

    protected function failedValidation(Validator $validator)
    {
        // dd($validator->errors()->all());
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'profession_id' => 'exists:professions,profession_id',
            'province_id' => ['required', 'max:255', Rule::exists('provinces', 'id')],
            'employment_type' => ['string', 'max:255', new Enum(EmploymentType::class)],
            'headcount' => 'integer',
            'description_md' => 'string',
            'requirements_md' => 'string',
            'min_salary' => 'numeric|min:0',
            'max_salary' => 'numeric|min:0',
            'currency' => 'string|max:50',
            'status' => 'boolean',
        ];
    }

    public function messages(): array
    {

        return [
            'name.required' => __('job.title_required'),
            'name.string' => __('job.title_string'),
            'name.max' => __('job.title_max'),
            'profession_id.exists' => __('job.profession_id_exists'),
            'province_id.required' => __('job.province_code_required'),
            'province_id.max' => __('job.province_code_max'),
            'province_id.exists' => __('job.province_code_in'),
            'employment_type.string' => __('user.employment_type_string'),
            'employment_type.enum' => __('user.employment_type_enums'),
            'headcount.integer' => __('job.headcount_integer'),
            'description_md.string' => __('job.description_md_string'),
            'requirements_md.string' => __('job.requirements_md_string'),
            'min_salary.numeric' => __('job.min_salary_decimal'),
            'max_salary.numeric' => __('job.max_salary_decimal'),
            'currency.string' => __('job.currency_string'),
            'currency.max' => __('job.currency_max'),
            'status.boolean' => __('job.status_boolean'),
        ];
    }
}

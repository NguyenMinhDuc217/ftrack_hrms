<?php

namespace App\Http\Requests;

use App\Enums\EmploymentType;
use App\Enums\UserStatus;
use App\Enums\Gender;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UserPostRequest extends FormRequest
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
        $user = $this->route('user');
        return [
            'username' => 'required|string|max:255',
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'email' => [ 
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user?->user_id, 'user_id'), 
            ],
            'phone_number' => [ 
                'numeric',
                'digits:10',
                Rule::unique('users', 'phone_number')->ignore($user?->user_id, 'user_id'), 
            ],
            'gender' => ['required','string','max:100', new Enum(Gender::class)],
            'date_of_birth' => 'date|before:today',
            'hire_date' => 'date|after:date_of_birth',
            'department_id' => 'exists:departments,department_id',
            'manager_id' => 'exists:users,user_id',
            // 'document_id' => 'exists:documents,document_id',
            'document_id' => 'integer',
            'org_id' => 'integer',
            'employment_type' => ['string','max:255',new Enum(EmploymentType::class)],
            'applicant' => 'boolean',
            'status' => ['string','max:100', new Enum(UserStatus::class)],
        ];
    }

    public function messages(): array
    {

        return [
            'username.required' => __('user.username_required'),
            'username.string' => __('user.username_string'),
            'username.max' => __('user.username_max'),
            'email.required' => __('user.email_required'),
            'email.email' => __('user.email_email'),
            'email.unique' => __('user.email_unique'),
            'phone_number.numeric' => __('user.phone_number_numeric'),
            'phone_number.digits' => __('user.phone_number_digits'),
            'phone_number.unique' => __('user.phone_number_unique'),
            'first_name.string' => __('user.first_name_string'),
            'first_name.max' => __('user.first_name_max'),
            'last_name.string' => __('user.last_name_string'),
            'last_name.max' => __('user.last_name_max'),
            'gender.required' => __('user.gender_required'),
            'gender.string' => __('user.gender_string'),
            'gender.max' => __('user.gender_max'),
            'gender.enum' => __('user.gender_enum'),
            'date_of_birth.date' => __('user.date_of_birth_date'),
            'date_of_birth.before' => __('user.date_of_birth_before'),
            'hire_date.date' => __('user.hire_date_date'),
            'hire_date.before_or_equal' => __('user.hire_date_before_or_equal'),
            'hire_date.after' => __('user.hire_date_after'),
            'department_id.exists' => __('user.department_id_exists'),
            'manager_id.exists' => __('user.manager_id_exists'),
            'document_id.exists' => __('user.document_id_exists'),
            'document_id.integer' => __('user.document_id_integer'),
            'employment_type.string' => __('user.employment_type_string'),
            'employment_type.enum' => __('user.employment_type_enums'),
            'applicant.boolean' => __('user.applicant_boolean'),
            'status.string' => __('user.status_string'),
            'status.enum' => __('user.status_enums'),
        ];
    }
}

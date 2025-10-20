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
        return [
            'username' => 'required|string|max:255',
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'email' => [ 
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore(request()->route('user_id'), 'user_id'), 
            ],
            '' => 'numeric|digits:11|unique:users',
            'phone_number' => [ 
                'numeric',
                'digits:10',
                Rule::unique('users', 'phone_number')->ignore(request()->route('user_id'), 'user_id'), 
            ],
            'gender' => ['string','max:100', new Enum(Gender::class)],
            'date_of_birth' => 'date|before:today',
            'hire_date' => 'date|before_or_equal:today',
            'department_id' => 'exists:departments,department_id',
            'manager_id' => 'exists:users,user_id',
            // 'document_id' => 'exists:documents,document_id',
            'document_id' => 'integer',
            'employment_type' => ['string','max:255',new Enum(EmploymentType::class)],
            'applicant' => 'boolean',
            'status' => ['string','max:100', new Enum(UserStatus::class)],
        ];
    }

    public function messages(): array
    {

        return [
            'username.required' => 'The username field is required.',
            'username.string' => 'The username must be a string.',
            'username.max' => 'The username may not be greater than 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'phone_number.numeric' => 'The phone number must be a number.',
            'phone_number.digits' => 'The phone number must be exactly 11 digits.',
            'phone_number.unique' => 'The phone number has already been taken.',
            'first_name.string' => 'The first name must be a string.',
            'first_name.max' => 'The first name may not be greater than 255 characters.',
            'last_name.string' => 'The last name must be a string.',
            'last_name.max' => 'The last name may not be greater than 255 characters.',
            'gender.string' => 'The gender must be a string.',
            'gender.max' => 'The gender may not be greater than 100 characters.',
            'gender.enum' => 'The gender is invalid.',
            'date_of_birth.date' => 'The date of birth must be a valid date.',
            'date_of_birth.before' => 'The date of birth must be a date before today.',
            'hire_date.date' => 'The hire date must be a valid date.',
            'hire_date.before_or_equal' => 'The hire date must be a date before or equal to today.',
            'department_id.exists' => 'The selected department does not exist.',
            'manager_id.exists' => 'The selected manager does not exist.',
            'document_id.exists' => 'The selected document does not exist.',
            'employment_type.enums' => 'The selected employment type is invalid.',
            'status.enums' => 'The selected status is invalid.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrganizationPostRequest extends FormRequest
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
        // dd($validator->errors()->all());
    }

    public function rules(): array
    {
        $org = $this->route('org');
        $imageRule = $this->isMethod('post') ? 'required' : 'nullable';

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('organizations', 'email')->ignore($org?->org_id, 'org_id'),
            ],
            'image' => $imageRule.'|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'phone_number' => [
                'required',
                'numeric',
                'digits_between:10,11',
                Rule::unique('organizations', 'phone_number')->ignore($org?->org_id, 'org_id'),
            ],
            'slug' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'link' => 'required|string|max:255|url',
            'status' => ['required', 'string', 'in:active,inactive'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('org.txt_name_required'),
            'name.string' => __('org.txt_name_string'),
            'name.max' => __('org.txt_name_max'),
            'email.required' => __('org.txt_email_required'),
            'email.email' => __('org.txt_email_email'),
            'email.unique' => __('org.txt_email_unique'),
            'image.required' => __('org.txt_image_required'),
            'image.image' => __('org.txt_image_image'),
            'image.mimes' => __('org.txt_image_mimes'),
            'image.max' => __('org.txt_image_max'),
            'phone_number.required' => __('org.txt_phone_number_required'),
            'phone_number.numeric' => __('org.txt_phone_number_numeric'),
            'phone_number.digits_between' => __('org.txt_phone_number_digits_between'),
            'phone_number.unique' => __('org.txt_phone_number_unique'),
            'slug.required' => __('org.txt_slug_required'),
            'slug.string' => __('org.txt_slug_string'),
            'slug.max' => __('org.txt_slug_max'),
            'description.required' => __('org.txt_description_required'),
            'description.string' => __('org.txt_description_string'),
            'address.required' => __('org.txt_address_required'),
            'address.string' => __('org.txt_address_string'),
            'address.max' => __('org.txt_address_max'),
            'link.required' => __('org.txt_link_required'),
            'link.url' => __('org.txt_link_url'),
            'status.required' => __('org.txt_status_required'),
            'status.string' => __('org.txt_status_string'),
            'status.in' => __('org.txt_status_in'),
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        $rules = [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required',
                        'email',
                        Rule::unique('users')->ignore($this->user()->id)
                    ],
            'dateOfBirth' => ['date', 'nullable'],
            'country' => ['integer', 'nullable'],
            'location' => ['integer', 'nullable'],
            'jobTitle' => ['string', 'max:75', 'nullable'],
            'educationLevel' => ['integer'],
            'gender' => ['integer', 'nullable'],
            'bio' => ['string', 'max:300', 'nullable']
        ];
        
        return $rules;
    }

    /**
     * Custom message for validation
     *
     * @return array
     */

    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.email' => 'Email not in proper format', 
            'name.required' => 'Name is required!',
        ];
    }
}

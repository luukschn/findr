<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScaleUploadRequest extends FormRequest
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
        return [
            "internalName" => ['required', 'string', 'max:50'],
            "officialName" => ['required', 'string', 'max:150'], 
            "reference" => ['required', 'string', 'max:500'],
            "explanation" => ['required', 'string', 'max:1000'],
            "options" => ['required', 'string', 'max:150'],
            //regex to validate float
            "referenceMean" => ['required', 'regex:/^\d*(\.\d{2})?$/'],
            "referenceSD" => ['required', 'regex:/^\d*(\.\d{2})?$/'],
        ];
    }
}

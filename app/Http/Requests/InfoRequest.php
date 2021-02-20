<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class InfoRequest extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }


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

        // dd('f');
        return [
            'name' => 'string|required|min:3',
            'email' => 'required|regex:/(.*)@(.*)\.(.*)/',
            'phone' => 'required|regex:/^\d{3}\d{3}\d{4}$/',
            'address' => 'required|min:10',
            'zip' => 'required|regex:/^\d{5}$/',
            'profile_img_file' => 'mimes:jpeg,jpg,png|required',
            'license_file' => 'required|mimes:doc,pdf,jpeg,jpg,png'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'name.string' => 'A name must be a string',
            'name.min' => 'Name must be more then 3 characters',
            'email.required' => 'A email is required',
            'phone.required' => 'A phone is required',
            'phone.regex' => 'A phone format is not correct (123) 456-7899',
            'address.required' => 'Address is required',
            'address.min' => 'Address must be more then 10 characters',
            'zip.required' => 'Zip Code is required',
            'zip.regex' => 'Zip Code must be five digits',
            'profile_img_file.required' => 'Profile Image is required',
            'profile_img_file.mimes' => 'Profile Image must be of type jpeg,jpg or png',
            'license_file.required' => 'License is required',
            'license_file.mimes' => 'License must be of type doc,pdf,jpeg,jpg or png',
        ];
    }
}

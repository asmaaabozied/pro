<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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

            'email' => 'required|email',
//            'phone' => 'required|min:11',
            'facebook' => 'required',
            'instegram' => 'required',
            'twitter' => 'required',
            'snapchat' => 'required',
        ];
    }

    public function messages() {

        return[

            'email.required' => 'The email field is required',
            'email.email' => 'The field is  email',
//            'phone.required' => 'The phone field is required',
//            'phone.integer' => 'The phone field is integer',
//            'phone.min' => 'The phone field is no less 6',
            'facebook' => 'The facebook field is required',
            'instegram' => 'The instegram field is required',
            'twitter' => 'The twitter field is required',
            'snapchat' => 'The snapchat field is required',


        ];
    }
}

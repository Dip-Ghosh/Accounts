<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class bankBranchFormValidation extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'=>'required|max:255',
            'address'=>'required|max:255',
            'email'=>'required|max:255',
            'mobile'=>'required|max:11',

        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'The name should be between 255 characters',
            'address.required'=>'The address should be between 255 character',
            'email.required'=>'You need to Give the unique email address',
            'mobile.required'=>'The mobile should be exact  11 digits',



        ];
    }
}

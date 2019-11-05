<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class bankAccountFormValidation extends FormRequest
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
            'bank_id'=>'required',
            'branch_id'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'The name should be between 255 characters',
            'address.required'=>'The address should be between 255 character',
            'email.required'=>'You need to Give the unique email address',
            'mobile.required'=>'The mobile should be exact  11 digits',
            'bank_id.required'=>'The bank id must  be  come from the bank table',
            'branch_id.required'=>'The branch id must be come from the branch table',

        ];
    }
}

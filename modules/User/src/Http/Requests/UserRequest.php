<?php

namespace Modules\User\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6',
            'group_id'=>['required','integer', function($attribute,$value,$message){
                if($value===0)
                {
                    $fail('Please choose group');
                }
            }],
        ];
    }


    public function messages()
    {
        return [
         'required'=> ':attribute is required ',
         'email'=>':attribute is required ',
         'unique'=>':attribute already exists',
         'min'=>':attribute must be more than :min character',
         'integer'=>':attribute must be a number'
        ];
    }

    public function attributes()
    {
        return [
            'name'=>'Name',
            'email'=>'Email',
            'group_id'=>'Group',
            'password'=>'Password'
        ];
    }
}

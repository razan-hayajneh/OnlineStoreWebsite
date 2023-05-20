<?php

namespace App\Http\Requests\Api\login;

use App\Enum\UserType;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class RegisterAPIRequest extends FormRequest
{
    use ResponseTrait;
    public function __construct(Request $request)
    {
        $request['user_type'] = 'client';
        $request['accepted'] = 1;
    }
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required',
            'email' => 'required|email|unique:users,email,deleted_at,null',
            'phone' => 'required|phone|unique:users,phone,deleted_at,null',
            'password' => 'required',
            'confirmed_password' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [];
    }

    public function filters()
    {
        return [
            'email' => 'trim|lowercase',
            'name'  => 'trim|capitalize|escape'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            //
        });
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->ApiResponse('fail', $validator->errors()->first()));
    }
}

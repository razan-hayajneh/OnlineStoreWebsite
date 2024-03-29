<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Client;

class CreateClientRequest extends FormRequest
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
            // 'name'                  => 'required',
            'first_name' => 'required',
            'phone' => 'nullable|regex:/(0)[0-9]{9}/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ];;
    }
}

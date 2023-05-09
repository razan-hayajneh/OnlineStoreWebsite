<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Client;

class UpdateClientRequest extends FormRequest
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
        $id = Client::whereId($this->route('client'))->first()['user_id'];
        $rules = [
            'first_name' => 'required|alpha',
            'last_name' => 'nullable|alpha',
            'name'     => 'required|string|unique:users,name,' . $id,
            'email'    => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|regex:/(0)[0-9]{9}/',
            'password' => 'confirmed'
        ];

        return $rules;
    }
}

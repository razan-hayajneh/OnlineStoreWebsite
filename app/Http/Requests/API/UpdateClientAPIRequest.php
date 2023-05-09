<?php

namespace App\Http\Requests\API;

use App\Models\Client;
use InfyOm\Generator\Request\APIRequest;

class UpdateClientAPIRequest extends APIRequest
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
        $id = $this->route('client');
        $rules = [
            'first_name' => 'required|alpha',
            'last_name' => 'nullable|alpha',
            'name'     => 'required|string|unique:users,name,' . $id,
            'email'    => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|regex:/(0)[0-9]{9}/',
            'password' => 'confirmed'
        ];
    }
}

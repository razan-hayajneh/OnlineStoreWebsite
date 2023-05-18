<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class UpdateProductRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required',
            'image_path' => 'sometimes|mimes:png,svg,jpg,jpeg',
            'category_id' => 'required|exists:categories,id,deleted_at,NULL',
            'quantity' => 'nullable'
        ];
        return $rules;
    }
}

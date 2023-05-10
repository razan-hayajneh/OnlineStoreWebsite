<?php

namespace App\Http\Resources;

use App\Models\ProductOptionKey;
use App\Models\Option;
use App\Models\OptionKey;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $options=Option::whereHas('optionKeys', function ($query) {
            return $query->whereIn('id', $this->optionKeys()->pluck('option_key_id'));
        })->get();
        foreach ($options as $key => $option) {
            $options[$key]->optionKeys=ProductOptionKey::where('product_id', $this->id)->whereHas('optionKey', function ($query) use ($option) {
                return $query->where('option_id', $option->id);
            })->get();

        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => strval($this->price),
            'category_id' => $this->category_id,
            'quantity' => $this->quantity,
            'selling_price' => $this->discount != 0 ? ($this->discount_type == 1 ? strval((1 - $this->discount / 100) * $this->price) : strval($this->price - $this->discount)) : null,
            'options' => $this->optionKeys ? OptionResource::collection($options) : [],

        ];
    }
}

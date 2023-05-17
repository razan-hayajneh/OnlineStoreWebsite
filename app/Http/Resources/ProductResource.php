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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => strval($this->price),
            'category_id' => $this->category->id,
            'category_name' => $this->category->name,
            'image_path' =>dashboard_url($this->image_path),
            'discount' => $this->discount,
            'discount_ratio' => $this->discount_type,
            'selling_price' => $this->discount != 0 ? ($this->discount_type == 1 ? strval((1 - $this->discount / 100) * $this->price) : strval($this->price - $this->discount)) : null,
            'selling_price' => $this->discount != 0 ? ($this->discount_type == 1 ? strval((1 - $this->discount / 100) * $this->price) : strval($this->price - $this->discount)) : null,
            'options' => $this->optionKeys ? $this->getOptions($this->optionKeys()) : [],

        ];
    }
    public function getOptions($optionKeys)
    {

        $options=Option::whereHas('optionKeys', function ($query) use($optionKeys) {
            return $query->whereIn('id', $optionKeys->pluck('option_key_id'));
        })->get();
        foreach ($options as $key => $option) {
            $options[$key]->optionKeys=ProductOptionKey::where('product_id', $this->id)->whereHas('optionKey', function ($query) use ($option) {
                return $query->where('option_id', $option->id);
            })->get();
        }
        return OptionResource::collection($options);
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user_id' => $this->user_id,
            'total_price' => $this->total_price,
            'coupon_id' => $this->coupon_id,
            'final_price' => $this->final_price,
            'tax' => $this->tax,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}

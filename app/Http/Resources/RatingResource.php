<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
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
            'product_id' => $this->product_id,
            'client_id' => $this->client_id,
            'stars' => $this->stars,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}

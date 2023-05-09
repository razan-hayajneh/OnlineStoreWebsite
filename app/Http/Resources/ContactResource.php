<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'phone2' => $this->phone2,
            'googleStore' => $this->googleStore,
            'appStore' => $this->appStore,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'whatsapp' => $this->whatsapp,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at
        ];
    }
}

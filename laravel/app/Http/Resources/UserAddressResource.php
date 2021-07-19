<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
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
            'address' => $this->address,
            'user_id' => $this->user_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'user' => $this->user,
            'state' => $this->state,
            'city' => $this->city,
        ];
    }
}

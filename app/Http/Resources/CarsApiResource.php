<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarsApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   
        // return parent::toArray($request);
        return [
            'id'              => $this->id,
            'title'           => $this->title,
            'user_id'         => $this->user_id,
            'user_name'       => $this->user->name,
            'image'           => $this->path,
            'address'         => $this->address,
            'phone'          => $this->phone,
            'detail'          => $this->detail,
            'brand'           => $this->brand,
            'model'           => $this->model,
            'year'            => $this->year,
            'price'           => $this->price,
            'licance_plate'   => $this->licance_plate,
            'engine_power'    => $this->engine_power,
            'fuel_type'       => $this->fuel_type,
            'color'           => $this->color,
            'gear_type'       => $this->gear_type,
            
          
        ];
    }
}

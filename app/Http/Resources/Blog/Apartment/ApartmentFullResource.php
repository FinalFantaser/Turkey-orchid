<?php

namespace App\Http\Resources\Blog\Apartment;

use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentFullResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'address' => $this->address,
            'located_at' => $this->located_at,
            'price' => $this->price,
            'price_m2' => $this->price_m2,
            'area' => $this->area,
            'rooms' => $this->rooms,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'floor' => $this->floor,
            'total_floors' => $this->total_floors,
            'details' => $this->details,
            'location' => $this->location,

            'thumbs' =>  $this->getSliderThumbs(),            
            'images' => $this->getImages(),
        ];
    }
}

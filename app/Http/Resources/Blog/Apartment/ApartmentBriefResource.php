<?php

namespace App\Http\Resources\Blog\Apartment;

use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentBriefResource extends JsonResource
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
            'thumb' => $this->getThumb(),
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'id' => $this->id,
        ];
    }
}

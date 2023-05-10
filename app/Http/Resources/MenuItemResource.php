<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" =>$this->id ,
            "name" =>$this->name ,
            "description"=> $this->description,
            "price" => $this->price,
            "created_at" => Carbon::parse($this->created_at)->diffForHumans(),
            "images" => MenuItemImageResource::collection($this->images),
            "offers"=> OfferResource::collection($this->offers),
            
        ];
    }
}

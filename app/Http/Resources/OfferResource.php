<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Create Carbon instances from the start_at and end_at dates
        $startAt = Carbon::parse($this->start_at);
        $endAt = Carbon::parse($this->end_at);

        // Calculate the time difference between the dates and format it as a string
        $diffStart = $startAt->diffForHumans();
        $diffEnd = $endAt->diffForHumans();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'amount' => $this->amount,
            'start_at' => "Starts {$diffStart}",
            'end_at' => "Ends {$diffEnd}",
            'menu_item' => MenuItemResource::make($this->whenLoaded('menuItem')),
        ];
    }
}
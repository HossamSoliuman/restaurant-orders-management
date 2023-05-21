<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body,
            'likes_count' => $this->likes_count,
            'images' => PostImagesResource::collection($this->whenLoaded('PostImages')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}

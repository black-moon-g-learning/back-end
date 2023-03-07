<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoHistoryResource extends JsonResource
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
            'id' => $this->id,
            'stop_at' => $this->stop_at,
            'created_at' => $this->created_at,
            'video' => new VideoResource($this->video),
            'url' => $this->url,
            'image' => $this->image,
            'time' => convertTimeFromDB($this->time),
            'author' => getUsername($this->user)
        ];
    }
}

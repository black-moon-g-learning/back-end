<?php

namespace App\Http\Resources;

use App\Constants\Common;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'url' => handleShowVideoLink($this->url),
            'author' => getUsername($this->user),
            'publish' => getTime($this->created_at),
            'time' => convertTimeFromDB($this->time),
            'image' => getS3Url($this->image),
            'watched' => $this->watched ? Common::WATCHED_VIDEO : Common::UNWATCHED_VIDEO,
            'watched_at' => $this->watched ? Carbon::parse($this->watched->created_at)->toDateTimeString() : null
        ];
    }
}

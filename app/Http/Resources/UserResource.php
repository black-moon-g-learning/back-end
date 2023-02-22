<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'phone' => $this->phone,
            'age' => $this->age,
            'gender' => $this->gender,
            'character' => $this->character->name ?? null,
            'target' => $this->target->name ?? null,
            'role' => $this->role->name ?? null,
            'provider' => $this->provider,
            'image' => getS3Url($this->image)
        ];
    }
}

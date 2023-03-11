<?php

namespace App\Http\Resources;

use App\Constants\Common;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected function handleTrial(?string $date)
    {
        $dateCarbon = Carbon::parse($date);
        $now = Carbon::now();

        if ($date == null) {
            return $date;
        } else if ($dateCarbon > $now) {
            return $now->diffInDays($dateCarbon) + 1;
        } else {
            return Common::DEFAULT_EXPIRED_TRIAL;
        }
    }

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
            'image' => getS3Url($this->image),
            'trial' =>  $this->handleTrial($this->expired)
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserEarning extends JsonResource
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
            // 'id' => $this['id'],
            'total' => $this['total'],
            'paid' => $this['paid'],
            'compounded' => $this['compounded'],
            'referral' => $this['referral'],
        ];
    }
}

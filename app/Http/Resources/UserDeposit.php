<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDeposit extends JsonResource
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
            'id' => $this['id'],
            'initial' => $this['initial'],
            'compounded' => $this['compounded'],
            'total' => $this['total'],
            'top_up' => $this['top_up'],
            'locked' => $this['locked']
        ];
    }
}

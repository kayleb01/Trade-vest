<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            'user' => new UserResource($this['user']),
            'deposit' => $this['deposit'],
            'role'=> $this['role'],
            'token' => $this['token'],
            'token_type' => $this['token_type'],
            'expires_in' => $this['expires_in']
        ];
    }
}

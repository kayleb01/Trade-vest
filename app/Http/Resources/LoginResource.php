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
            'deposit' => new UserDeposit($this['user']['deposits']),
            'earnings' => new UserEarning($this['user']['earnings']),
            'withdrawals' =>  UserWithdrawal::collection($this['user']['withdrawals']),
            'role'=> $this['role'],
            'token' => $this['token'],
            'token_type' => $this['token_type'],
            'expires_in' => $this['expires_in']
        ];
    }
}

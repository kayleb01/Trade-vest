<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'proof' => $this->ImageUrl,
            'role'=> $this->role->name,
            'deposit' => new UserDeposit($this->deposit),
            'earnings' => new UserEarning($this->earnings),
            'withdrawals' => new UserWithdrawal($this->withdrawals),
        ];
    }
}

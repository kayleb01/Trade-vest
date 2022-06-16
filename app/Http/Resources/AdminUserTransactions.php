<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserTransactions extends JsonResource
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
            'status' => $this->status == 0 ? 'unconfirmed' : 'confirmed',
            'amount' => $this->amount,
            'type' => $this->type,
            'proof' => $this->user->proof,
            'contract' => new AdminUserContract($this->contract)
        ];
    }
}

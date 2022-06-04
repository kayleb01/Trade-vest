<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
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
            'min_amount' => $this->min_amount,
            'max_amount' => $this->max_amount,
            'weekly_returns' => $this->weekly_returns,
            'bonus' => $this->bonus,
            'category' => $this->category
        ];
    }
}

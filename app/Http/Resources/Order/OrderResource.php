<?php

namespace App\Http\Resources\Order;

use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'costumer_id'=>$this->costumer_id,
            'total_price'=>$this->total_price,
            'total_amount'=>$this->total_amount,
            'status'=>OrderStatus::DRAFT->value,
            'contents'=> OrderContentResource::collection($this->contents)
        ];
    }
}

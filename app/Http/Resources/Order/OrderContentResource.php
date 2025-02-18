<?php

namespace App\Http\Resources\Order;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'item_id'=>$this->contentable_id,
            'type'=>$this->contentable_type==Offer::class?'offer':'product',
            'price'=>$this->price,
            'quantity'=>$this->quantity
        ];
    }
}

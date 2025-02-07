<?php

namespace App\Http\Resources\Stock;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
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
            'discount'=>$this->discount,
            'discount_type'=>$this->discount_type,
            'image'=>$this->imageUrl(),
            'price'=>$this->price??$this->product->price,
            'properties'=>$this->properties
        ];
    }
}

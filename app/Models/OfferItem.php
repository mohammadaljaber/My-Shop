<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferItem extends Model
{
    protected $guarded=[];
    public function offer(){
        return $this->belongsTo(Offer::class,'offer_id');
    }
    public function stock(){
        return $this->belongsTo(Stock::class,'stock_id');
    }
}

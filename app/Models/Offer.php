<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Offer extends Model
{
    protected $guarded=[];

    public function items(){
        return $this->hasMany(OfferItem::class,'offer_id');
    }
    public function orders():MorphMany{
        return $this->morphMany(OrderContent::class,'contentable');
    }
}

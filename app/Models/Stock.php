<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Stock extends Model
{
    protected $guarded=[];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function orders():MorphMany{
        return $this->morphMany(OrderContent::class,'contentable');
    }
}

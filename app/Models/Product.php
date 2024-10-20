<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $guarded=[];

    public function coupons(): MorphMany
    {
        return $this->morphMany(Coupon::class, 'couponable');
    }

    public function stocks(){
        return $this->hasMany(Stock::class,'product_id');
    }

}

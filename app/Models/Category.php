<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    protected $guarded=[];

    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }

    public function coupons(): MorphMany
    {
        return $this->morphMany(Coupon::class, 'couponable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Brand extends Model
{
    use SoftDeletes;
    protected $guarded=[];

    public function products(){
        return $this->hasMany(Product::class,'brand_id');
    }

    public function coupons(): MorphMany
    {
        return $this->morphMany(Coupon::class, 'couponable');
    }

    public function imageUrl(){
        return Storage::disk('public')->url($this->image);
    }

}

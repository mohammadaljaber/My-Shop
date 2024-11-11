<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use SoftDeletes;
    protected $guarded=[];

    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }

    public function coupons(): MorphMany
    {
        return $this->morphMany(Coupon::class, 'couponable');
    }

    public function imageUrl(){
        return Storage::disk('public')->url($this->image);
    }
}

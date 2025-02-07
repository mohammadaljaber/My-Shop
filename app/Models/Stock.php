<?php

namespace App\Models;

use App\Enums\DiscountType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected static function booted()
    {
        self::deleting((fn(Model $record)=>
            Storage::disk('public')->delete($record->image)
        ));
    }

    public function imageUrl(){
        return Storage::disk('public')->url($this->image);
    }

    protected $casts=[
        'properties'=>'json'
    ];

}

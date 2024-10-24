<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Stock extends Model
{
    use SoftDeletes;
    protected $guarded=[];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function orders():MorphMany{
        return $this->morphMany(OrderContent::class,'contentable');
    }

    // protected function Properties():Attribute{
    //     return Attribute::make(
    //         get:fn($value)=>json_decode($value),
    //         set:fn($value)=>json_encode($value)
    //     );
    // }

    protected $casts=[
        'properties'=>'array'
    ];

}

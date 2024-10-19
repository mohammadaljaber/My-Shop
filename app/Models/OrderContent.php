<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class OrderContent extends Model
{
    protected $guarded=[];
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function contentable():MorphTo{
        return $this->morphTo();
    }
}

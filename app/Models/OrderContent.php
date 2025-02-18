<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderContent extends Model
{
    use SoftDeletes;
    protected $guarded=[];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function contentable():MorphTo{
        return $this->morphTo();
    }
}

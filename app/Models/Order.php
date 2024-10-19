<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];

    public function costumer(){
        return $this->belongsTo(User::class,'costumer_id');
    }
    public function contents(){
        return $this->hasMany(OrderContent::class,'order_id');
    }
}

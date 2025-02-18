<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $guarded=[];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function costumer(){
        return $this->belongsTo(User::class,'costumer_id');
    }
    public function contents(){
        return $this->hasMany(OrderContent::class,'order_id');
    }
}

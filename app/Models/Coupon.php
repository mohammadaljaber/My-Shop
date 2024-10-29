<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Coupon extends Model
{
    protected $guarded=[];

    public function couponable(): MorphTo
    {
        return $this->morphTo();
    }

    

}

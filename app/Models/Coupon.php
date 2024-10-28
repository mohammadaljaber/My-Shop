<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    protected $guarded=[];

    public function couponable(): MorphTo
    {
        return $this->morphTo();
    }

}

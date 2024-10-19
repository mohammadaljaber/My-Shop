<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Coupon extends Model
{
    protected $guarded=[];

    public function couponable(): MorphTo
    {
        return $this->morphTo();
    }

}

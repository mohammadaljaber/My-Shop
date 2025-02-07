<?php
namespace App\Filters\Product;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ByBrand{
    public function handle(Builder $query,Closure $next)
    {
        if(request()->has('brand_id')){
            $query->where('brand_id',request()->input('brand_id'));
        }
        return $next($query);
    }
}

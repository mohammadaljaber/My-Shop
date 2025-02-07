<?php
namespace App\Filters\Product;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ByCategory{
    public function handle(Builder $query,Closure $next)
    {
        if(request()->has('category_id')){
            $query->where('category_id',request()->input('category_id'));
        }
        return $next($query);
    }
}

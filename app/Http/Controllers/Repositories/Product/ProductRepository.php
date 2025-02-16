<?php

namespace App\Http\Controllers\Repositories\Product;

use App\Enums\ProductStatus;
use Closure;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Filters\Product\ByBrand;
use App\Filters\Product\ByPrice;
use App\Filters\Product\ByCategory;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends BaseRepository{

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function index(Request $request=null){
        $pips=[
            ByBrand::class,
            ByPrice::class,
            ByCategory::class,
            function(Builder $query,Closure $next)use($request){
                return $next($query)->when($request->has('search'),
                    fn($query)=> $query->where('name','like','%'.$request->search.'%')
                );
            },
            function(Builder $query,Closure $next){
                return $next($query)->where('status',ProductStatus::ACTIVE->value);
            }
        ];
        $product=Pipeline::send( $this->model::query())
        ->through($pips)
        ->thenReturn()->paginate();
        return $product;
    }



}

<?php

namespace App\Http\Controllers\Api\V1\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Repositories\Product\ProductRepository;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Stock\StockResource;
use App\Models\Product;
use App\Traits\ApiResponse;

class ProductController extends Controller
{

    use ApiResponse;

    public function __construct(protected ProductRepository $productRepository){}

    public function index(Request $request){
        $products=$this->productRepository->index($request);
        return $this->paginationResponse($products,ProductResource::class);
    }

    public function getStocks(Product $product){
        $product=$this->productRepository->getRelation($product,"stocks");
        return $this->showCollection($product->stocks,StockResource::class);
    }

}

<?php

namespace App\Http\Controllers\Api\V1\Brand;

use App\Filament\Resources\BrandResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Repositories\Brand\BrandRepository;
use App\Http\Requests\IndexRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function __construct(protected BrandRepository $brandRepository){}

    use ApiResponse;

    public function index(IndexRequest $request){
        $Brands=$this->brandRepository->index($request->search);
        return $this->showCollection($Brands,BrandResource::class);
    }
}

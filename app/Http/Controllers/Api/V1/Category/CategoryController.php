<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Repositories\Category\CategoryRepository;
use App\Http\Requests\IndexRequest;
use App\Http\Resources\Categroy\CategoryResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse;
    public function __construct(protected CategoryRepository $categoryRepository){}

    public function index(IndexRequest $request){
        $categories=$this->categoryRepository->index($request->search);
        return $this->showCollection($categories,CategoryResource::class);
    }



}

<?php

namespace App\Http\Controllers\Repositories\Category;

use App\Http\Controllers\Repositories\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function index($search=null){
        return Category::when($search,function($q)use($search){
            $q->where('name','like','%'.$search.'%');
        })->latest()->get();
    }


}

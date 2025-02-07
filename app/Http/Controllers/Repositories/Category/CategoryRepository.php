<?php

namespace App\Http\Controllers\Repositories\Category;

use App\Http\Controllers\Repositories\BaseRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function index($search=null){
        return $this->model::when($search,function($q)use($search){
            $q->where('name','like','%'.$search.'%');
        })->latest()->get();
    }



}

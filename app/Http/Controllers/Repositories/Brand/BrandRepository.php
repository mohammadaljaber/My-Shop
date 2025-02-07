<?php

namespace App\Http\Controllers\Repositories\Brand;

use App\Http\Controllers\Repositories\BaseRepository;
use App\Models\Brand;

abstract class BrandRepository extends BaseRepository{

    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }

    public function index($search=null)
    {
        return Brand::when($search,function($q)use($search){
            $q->where('name','like','%'.$search.'%');
        })->latest()->get();
    }

}

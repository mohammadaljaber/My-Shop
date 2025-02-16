<?php

namespace App\Http\Controllers\Api\V1\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Repositories\Order\OrderRepository;
use App\Http\Controllers\Repositories\Orders\OrdersRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(protected OrdersRepository $orderRepository)
    {

    }


    public function store(Request $request){
        return $this->orderRepository->store($request);
    }
}

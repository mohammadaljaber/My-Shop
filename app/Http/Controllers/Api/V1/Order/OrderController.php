<?php

namespace App\Http\Controllers\Api\V1\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Repositories\Order\OrderRepository;
use App\Http\Controllers\Repositories\Orders\OrdersRepository;
use App\Http\Resources\Order\OrderResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    use ApiResponse;
    public function __construct(protected OrdersRepository $orderRepository){}



    public function store(Request $request){
        $order=$this->orderRepository->store($request);
        return $this->showOne($order,OrderResource::class);
    }
}

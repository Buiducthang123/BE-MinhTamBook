<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    //
    protected $orderItemController;

    protected $orderService;

    public function __construct(OrderItemController $orderItemController, OrderService $orderService)
    {
        $this->orderItemController = $orderItemController;
        $this->orderService = $orderService;
    }
    public function create(OrderRequest $request)
    {
        return $this->orderService->create($request->all());
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $orderController;

    protected $orderItemController;

    public function __construct(OrderController $orderController, OrderItemController $orderItemController)
    {
        $this->orderController = $orderController;
        $this->orderItemController = $orderItemController;
    }

    public function create(OrderRequest $orderRequest) {
        $order = $this->orderController->create($orderRequest);
        return $order;
    }

}

<?php
namespace App\Services;

use App\Repositories\Order\OrderRepositoryInterface;

class OrderService{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository){
        $this->orderRepository = $orderRepository;
    }
}

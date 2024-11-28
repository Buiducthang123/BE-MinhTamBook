<?php

namespace App\Services;

use App\Repositories\ShoppingCart\ShoppingCartRepositoryInterface;

class ShoppingCartService {
    protected $shoppingCartRepository;

    public function __construct(ShoppingCartRepositoryInterface $shoppingCartRepository){
        $this->shoppingCartRepository = $shoppingCartRepository;
    }
}

<?php

namespace App\Repositories\ShoppingCart;

use App\Models\ShoppingCart;
use App\Repositories\BaseRepository;

class ShoppingCartRepository extends BaseRepository implements ShoppingCartRepositoryInterface
{
    public function getModel()
    {
        return ShoppingCart::class;
    }
}

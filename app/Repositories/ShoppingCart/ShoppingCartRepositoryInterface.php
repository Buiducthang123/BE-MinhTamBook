<?php
namespace App\Repositories\ShoppingCart;

use App\Repositories\RepositoryInterface;

interface ShoppingCartRepositoryInterface extends RepositoryInterface{

    public function getCartItems();

    public function findItemInCart($user_id, $book_id);

    public function delete($book_id);
}

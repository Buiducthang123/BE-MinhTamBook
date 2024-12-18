<?php

namespace App\Services;

use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\ShoppingCart\ShoppingCartRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ShoppingCartService {
    protected $shoppingCartRepository;
    protected $bookRepository;

    public function __construct(ShoppingCartRepositoryInterface $shoppingCartRepository, BookRepositoryInterface $bookRepository){

        $this->shoppingCartRepository = $shoppingCartRepository;
        $this->bookRepository = $bookRepository;
    }

    public function getCartItems(){
        return $this->shoppingCartRepository->getCartItems();
    }

    public function addToCart($data){

        $book_id = $data['book_id'];

        $quantity = $data['quantity'] ?? 1;

        // $checkQuantity = $this->bookRepository->checkQuantity($book_id, $quantity);

        // if(!$checkQuantity){
        //     throw new \Exception('Số lượng sách trong kho không đủ');
        // }

        $user_id = Auth::id();

        $item = $this->shoppingCartRepository->findItemInCart($user_id, $book_id);

        if($item){
            $item->quantity += $quantity;
            $item->save();
            return $item;
        }

        return $this->shoppingCartRepository->create($data);
    }

    public function deleteItem($id){
        return $this->shoppingCartRepository->delete($id);
    }
}

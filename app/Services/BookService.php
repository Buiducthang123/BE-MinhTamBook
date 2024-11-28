<?php
namespace App\Services;

use App\Repositories\Book\BookRepositoryInterface;

class BookService{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository){
        $this->bookRepository = $bookRepository;
    }
}

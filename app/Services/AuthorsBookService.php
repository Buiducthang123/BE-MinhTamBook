<?php
namespace App\Services;

use App\Repositories\AuthorsBook\AuthorsBookRepositoryInterface;

class AuthorsBookService{
    protected $authorsBookRepository;
    public function __construct(AuthorsBookRepositoryInterface $authorsBookRepository){
        $this->authorsBookRepository = $authorsBookRepository;
    }

    public function create($data){
        return $this->authorsBookRepository->create($data);
    }
}

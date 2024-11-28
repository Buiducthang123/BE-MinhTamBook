<?php
namespace App\Services;

use App\Repositories\Author\AuthorRepositoryInterface;

class AuthorService{
    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository){
        $this->authorRepository = $authorRepository;
    }
}

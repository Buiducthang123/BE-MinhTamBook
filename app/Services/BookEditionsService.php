<?php

namespace App\Services;

use App\Repositories\BookEditions\BookEditionsRepositoryInterface;

class BookEditionsService
{
    protected $bookEditionsRepository;

    public function __construct(BookEditionsRepositoryInterface $bookEditionsRepository)
    {
        $this->bookEditionsRepository = $bookEditionsRepository;
    }
}

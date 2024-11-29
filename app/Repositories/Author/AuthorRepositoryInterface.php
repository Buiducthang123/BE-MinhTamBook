<?php
namespace App\Repositories\Author;

use App\Repositories\RepositoryInterface;

interface AuthorRepositoryInterface extends RepositoryInterface{
    public function getAll($paginate = null, $with = []);

    public function create($attributes = []);
}


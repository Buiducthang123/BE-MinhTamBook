<?php
namespace App\Repositories\Author;

use App\Repositories\RepositoryInterface;

interface AuthorRepositoryInterface extends RepositoryInterface{
    public function getAll($paginate = null, $with = [], $search = null);

    public function create($attributes = []);

    public function show($id, $with = []);
}


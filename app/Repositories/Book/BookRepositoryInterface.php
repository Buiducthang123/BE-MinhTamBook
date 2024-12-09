<?php
namespace App\Repositories\Book;

use App\Repositories\RepositoryInterface;

interface BookRepositoryInterface extends RepositoryInterface
{
    public function getAll($paginate =null, $with = [], $filter = null, $limit = null, $search = null);

    public function show($id, $with = []);

    public function create($data = []);
}


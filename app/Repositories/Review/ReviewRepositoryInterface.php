<?php
namespace App\Repositories\Review;

use App\Repositories\RepositoryInterface;

interface ReviewRepositoryInterface extends RepositoryInterface{
    public function getAll($paginate = null, $with = [], $filter = null, $sort = null);

    public function showByBook($paginate=10, $book_id, $with = []);
}

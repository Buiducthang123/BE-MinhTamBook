<?php
namespace App\Repositories\Book;

use App\Repositories\RepositoryInterface;

interface BookRepositoryInterface extends RepositoryInterface
{
    public function getAll($paginate =null, $with = [], $filter = null, $limit = null, $search = null, $sort = null);

    public function show($id, $with = []);

    public function create($data = []);

    public function getBookByCategory($category_id, $paginate = null, $with = []);

    // kiểm tra số lượng sách còn trong kho
    public function checkQuantity($id, $quantity);

    public function getBookInArrId($arrId, $with = []);
}

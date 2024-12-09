<?php
namespace App\Repositories\BookTransaction;

use App\Repositories\RepositoryInterface;

interface BookTransactionRepositoryInterface extends RepositoryInterface{
    public function getAll($paginate = null, $with = [], $filters = null, $search = null);

    public function show($id, $with = []);
}

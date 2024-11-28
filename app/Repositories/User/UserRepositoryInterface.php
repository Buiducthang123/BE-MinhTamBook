<?php
namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAll($paginate=null, $status=null, $search=null, $with=[], $role=null);

    public function show($id, $with=[]);
}

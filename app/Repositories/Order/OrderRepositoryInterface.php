<?php
namespace App\Repositories\Order;

use App\Repositories\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{
    public function getAll($paginate=null ,$with = [], $filter=null, $sort =null);

    public function show($id, $with = []);

    public function myOrder($paginate = null, $with = [], $filter = null, $sort = null);

    public function sendMailOrderStatus($order, $user);
}

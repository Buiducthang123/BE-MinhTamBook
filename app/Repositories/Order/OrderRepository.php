<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }

    public function getAll($paginate = null, $with = [], $filter = null, $sort = null)
    {
        $query = $this->model->with($with);

        if ($filter) {

            $filter = json_decode($filter, true);

            $status = $filter['status'] ?? null;

            if ($status) {
                $query->where('status', $status);
            }
        }

        if($sort){
            switch ($sort) {
                case 'all': // Tất cả
                    break;
                case 'new': // Mới nhất
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'old': // Cũ nhất
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'price_asc': // Tổng tiền tăng dần
                    $query->orderBy('total_price', 'asc');
                    break;
                case 'price_desc': // Tổng tiền giảm dần
                    $query->orderBy('total_price', 'desc');
                    break;

            }
        }

        if ($paginate) {
            return $query->paginate($paginate);
        }

        return $query->get();
    }

    public function show($id, $with = [])
    {
        if ($with) {
            return $this->model->with($with)->find($id);
        }
        return $this->model->find($id);
    }

    public function myOrder($paginate = null, $with = [], $filter = null, $sort = null){

        $user = Auth::user();

        if (!$user) {
            throw new \Exception('Không tìm thấy người dùng', 404);
        }

        $query = $this->model->where('user_id', $user->id)->with($with);

        if ($filter) {

            $filter = json_decode($filter, true);

            $status = $filter['status'] ?? null;

            if ($status) {
                $query->where('status', $status);
            }
        }

        if($paginate){
            return $query->paginate($paginate);
        }

        return $query->get();

    }

}

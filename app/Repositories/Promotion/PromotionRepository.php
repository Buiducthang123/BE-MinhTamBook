<?php

namespace App\Repositories\Promotion;

use App\Models\Promotion;
use App\Repositories\BaseRepository;

class PromotionRepository extends BaseRepository implements PromotionRepositoryInterface
{
    public function getModel()
    {
        return Promotion::class;
    }

    public function getAll($paginate = null, $with = [], $filter = null, $sort = null)
    {
        $query = $this->model->query();

        // if (!empty($with)) {
        //     $query->with($with);
        // }
        $query->with(['books']);

        if ($filter) {
            $filter = json_decode($filter, true);
            $title = $filter['title'] ?? null;
            $start_date = $filter['start_date'] ?? null;
            $end_date = $filter['end_date'] ?? null;

            if ($title) {
                $query->where('title', 'like', '%' . $title . '%');
            }

            if ($start_date) {
                $query->where('start_date', '>=', $start_date);
            }

            if ($end_date) {
                $query->where('end_date', '<=', $end_date);
            }

            if($start_date && $end_date){
                $query->whereBetween('start_date', [$start_date, $end_date]);
            }
        }

        if ($sort) {
            $sort = json_decode($sort, true);
            switch ($sort) {
                case 'asc':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'desc':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
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
       $query = $this->model->query();
        if (!empty($with)) {
            $query->with($with);
        }
       $query->where('id', $id)->orWhere('slug', $id);
       return $query->first();
    }
}

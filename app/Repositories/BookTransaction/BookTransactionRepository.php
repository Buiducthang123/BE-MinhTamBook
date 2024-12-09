<?php
namespace App\Repositories\BookTransaction;

use App\Enums\BookTransactionStatus;
use App\Enums\BookTransactionType;
use App\Models\BookTransaction;
use App\Repositories\BaseRepository;

class BookTransactionRepository extends BaseRepository implements BookTransactionRepositoryInterface
{
    public function getModel()
    {
        return BookTransaction::class;
    }

    public function getAll($paginate = null, $with = [], $filters = null, $search = null)
    {
        $query = $this->model->query();
        if (!empty($filters)) {
            $filters = json_decode($filters, true);

            $status = $filters['status'] ?? null;

            switch ($status) {
                case 'all':
                    break;
                case 'pending':
                    $query = $query->where('status', BookTransactionStatus::PENDING);
                    break;
                case 'success':
                    $query = $query->where('status', BookTransactionStatus::SUCCESS);
                    break;
                case 'cancel':
                    $query = $query->where('status', BookTransactionStatus::CANCEL);
                    break;
                default:
                    break;
            }

            $type = $filters['type'] ?? null;

            switch ($type) {
                case 'all':
                    break;
                case 'export':
                    $query = $query->where('type', BookTransactionType::EXPORT);
                    break;
                case 'import':
                    $query = $query->where('type', BookTransactionType::IMPORT);
                    break;
                default:
                    break;
            }

            $latest = $filters['latest'] ?? null;

            switch ($latest) {
                case 'all':
                    break;
                case 'today':
                    $query = $query->whereDate('date', now());
                    break;
                case 'week':
                    $query = $query->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query = $query->whereMonth('date', now()->month);
                    break;
                case 'year':
                    $query = $query->whereYear('date', now()->year);
                    break;
                case 'new':
                    $query = $query->orderBy('date', 'desc');
                    break;
                case 'old':
                    $query = $query->orderBy('date', 'asc');
                    break;
                default:
                    break;
            }

            $price = $filters['price'] ?? null;

            // switch ($price) {
            //     case 'all':
            //         break;
            //     case 'low': // Giá thấp đến cao
            //         $query = $query->orderBy('price', 'asc');
            //         break;
            //     case 'high':
            //         $query = $query->orderBy('price', 'desc');
            //         break;
            //     default:
            //         break;
            // }]
        }
        if (!empty($search)) {
            $search = json_decode($search, true);

            $bookName = $search['bookName'] ?? null;

            if($bookName){
                $query->whereHas('book', function ($query) use ($bookName) {
                    $query->where('title', 'like', '%' . $bookName . '%');
                });
            }
        }

        if (!empty($with)) {
            $query = $query->with($with);
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
            $query = $query->with($with);
        }
        return $query->find($id);
    }

}

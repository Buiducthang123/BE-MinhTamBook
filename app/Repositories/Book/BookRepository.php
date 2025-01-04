<?php
namespace App\Repositories\Book;

use App\Models\Book;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function getModel()
    {
        return Book::class;
    }

    public function getAll($paginate = null, $with = [], $filter = null, $limit = null, $search = null, $sort = null)
    {
        $query = $this->model->query();

        if (!empty($with)) {
            $query->with($with);
        }

        if ($filter) {
            $filter = json_decode($filter, true);
            $category_id = $filter['category_id'] ?? null;
            $publisher_id = $filter['publisher_id'] ?? null;

            if ($category_id) {
                $query->where('category_id', $category_id);
            }

            if ($publisher_id) {
                $query->where('publisher_id', $publisher_id);
            }

            //lọc theo trạng thái bán
            $is_sale = $filter['is_sale'] ?? null;
            switch ($is_sale) {
                case 'all':
                    break;
                case 1:
                    $query->where('is_sale', 1);
                    break;
                case 0:
                    $query->where('is_sale', 0);
                    break;
                default:
                    break;
            }

            //lọc theo khoảng giá

            $priceFrom = $filter['priceFrom'] ?? null;
            $priceTo = $filter['priceTo'] ?? null;

            if ($priceFrom && $priceTo) {
                $query->whereBetween('price', [$priceFrom, $priceTo]);
            }

            //Lấy book chưa thuộc promotion nào
            $promotion_null = $filter['promotion_null'] ?? null;

            if ($promotion_null) {
                $query->whereNull('promotion_id');
            }
        }

        if ($sort) {
            switch ($sort) {
                case 'all':
                    break;
                case 'new':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'old':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'name_az':
                    $query->orderBy('title', 'asc');
                    break;
                case 'name_za':
                    $query->orderBy('title', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'discount_asc':
                    $query->orderBy('discount', 'asc');
                    break;
                case 'discount_desc':
                    $query->orderBy('discount', 'desc');
                    break;
                case 'author_null':
                    $query->doesntHave('authors');
                    break;
                case 'publisher_null':
                    $query->whereNull('publisher_id');
                    break;
                default:
                    break;
            }
        }

        if ($search) {
            $search = json_decode($search, true);
            $title = $search['title'] ?? null;

            if ($title) {
                //tìm kiếm theo tiêu đề hoặc nhà xuất bản hoặc tác giả
                //tác giả và nhà xuất bản là bảng liên kết nên cần join
                $query->where('title', 'like', '%' . $title . '%')
                    ->orWhereHas('authors', function ($q) use ($title) {
                        $q->where('name', 'like', '%' . $title . '%');
                    })
                    ->orWhereHas('publisher', function ($q) use ($title) {
                        $q->where('name', 'like', '%' . $title . '%');
                    });
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

        $book = $query->where(function ($query) use ($id) {
            $query->where('id', $id)->orWhere('slug', $id);
        })->first();

        return $book;
    }

    public function update($id, $attributes = [])
    {
        $model = $this->model->find($id);
        DB::beginTransaction();
        try {
            if ($model) {
                $book = $model->update($attributes);
                if ($book) {
                    $model->authors()->sync($attributes['authors']);
                    DB::commit();
                    return $model;
                }
                return $model;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }

        return null;
    }

    public function create($attributes = [])
    {
        DB::beginTransaction();
        try {
            $book = $this->model->create($attributes);
            if ($book) {
                $book->authors()->attach($attributes['authors']);
                DB::commit();
                return $book;
            }
            return $book;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function getBookByCategory($category_id, $paginate = null, $with = [], $filter = null, $limit = null, $search = null, $sort = null)
    {
        $query = $this->model->query();

        if (!empty($with)) {
            $query->with($with);
        }

        $query->where('category_id', $category_id);

        $query->where('is_sale', 1);

        if ($sort) {
            switch ($sort) {
                case 'all':
                    break;
                case 'new':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'old':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'name_az':
                    $query->orderBy('title', 'asc');
                    break;
                case 'name_za':
                    $query->orderBy('title', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'discount_asc':
                    $query->orderBy('discount', 'asc');
                    break;
                case 'discount_desc':
                    $query->orderBy('discount', 'desc');
                    break;
                case 'author_null':
                    $query->doesntHave('authors');
                    break;
                case 'publisher_null':
                    $query->whereNull('publisher_id');
                    break;
                default:
                    break;
            }
        }

        if ($search) {
            $search = json_decode($search, true);

            $title = $search['title'] ?? null;

            if ($title) {
                //tìm kiếm theo tiêu đề hoặc nhà xuất bản hoặc tác giả
                //tác giả và nhà xuất bản là bảng liên kết nên cần join
                $query->where('title', 'like', '%' . $title . '%')
                    ->orWhereHas('authors', function ($q) use ($title) {
                        $q->where('name', 'like', '%' . $title . '%');
                    })
                    ->orWhereHas('publisher', function ($q) use ($title) {
                        $q->where('name', 'like', '%' . $title . '%');
                    });
            }
        }

        if ($paginate) {
            return $query->paginate($paginate);
        }
        return $query->get();
    }

    public function checkQuantity($id, $quantity)
    {
        $book = $this->model->find($id);
        if ($book) {
            if ($book->quantity >= $quantity) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function getBookInArrId($arrId, $with = [])
    {
        $query = $this->model->query();

        if (!empty($with)) {
            $query->with($with);
        }

        $query->whereIn('id', $arrId);

        return $query->get();
    }

    public function getTop10BestSeller($start_date, $end_date, $optionShow = 'all')
    {
        $query = $this->model->query();

        $query->join('order_items', 'order_items.book_id', '=', 'books.id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->select(
                'books.id',
                'books.title',
                'books.cover_image',
                'books.price',
                'books.discount',
                'orders.total_amount',

                DB::raw('SUM(order_items.quantity) as total_quantity')
            )
            ->whereBetween('orders.created_at', [$start_date, $end_date])
            ->groupBy('books.id', 'books.title','books.cover_image','books.price','books.discount','orders.total_amount')
            ->orderBy('total_quantity', 'desc')
            ->orderBy('total_quantity', 'desc')
            ->limit(10); // Giới hạn lấy 10 kết quả

        switch ($optionShow) {
            case 'all':
                break;
            case 'today':
                $query->whereDate('orders.created_at', now());
                break;
            case 'yesterday':
                $query->whereDate('orders.created_at', now()->subDay());
                break;
            case 'this_week':
                $query->whereBetween('orders.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'this_month':
                $query->whereMonth('orders.created_at', now()->month);
                break;
            case 'this_year':
                $query->whereYear('orders.created_at', now()->year);
                break;
            default:
                break;
        }

        return $query->take(10)->get();
    }

}

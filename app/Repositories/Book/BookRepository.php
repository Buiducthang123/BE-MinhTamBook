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

    public function getAll($paginate = null, $with = [], $filter = null, $limit = null, $search = null)
    {
        $query = $this->model->query();

        if(!empty($with)){
            $query->with($with);
        }

        if($filter){
            $filter = json_decode($filter, true);
            $category_id = $filter['category_id'] ?? null;
            $publisher_id = $filter['publisher_id'] ?? null;

            if($category_id){
                $query->where('category_id', $category_id);
            }

            if($publisher_id){
                $query->where('publisher_id', $publisher_id);
            }

            //sắp xếp
            $sort = $filter['sort'] ?? null;
            switch ($sort){
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

            //lọc theo trạng thái bán
            $is_sale = $filter['is_sale'] ?? null;
            switch ($is_sale){
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
        }

        if($search){
            $search = json_decode($search, true);

            $title = $search['title'] ?? null;

            if($title){
                //tìm kiếm theo tiêu đề hoặc nhà xuất bản hoặc tác giả
                //tác giả và nhà xuất bản là bảng liên kết nên cần join
                $query->where('title', 'like', '%'.$title.'%')
                    ->orWhereHas('authors', function($q) use ($title){
                        $q->where('name', 'like', '%'.$title.'%');
                    })
                    ->orWhereHas('publisher', function($q) use ($title){
                        $q->where('name', 'like', '%'.$title.'%');
                    });
            }
        }

        if($paginate){
            return $query->paginate($paginate);
        }
        return $query->get();
    }

    public function show($id,  $with = [])
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

    public function update($id, $attributes = []){
        $model = $this->model->find($id);
        DB::beginTransaction();
        try {
            if($model){
                $book = $model->update($attributes);
                if($book){
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

    public function create($attributes = []){
        DB::beginTransaction();
        try {
            $book = $this->model->create($attributes);
            if($book){
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

    public function getBookByCategory($category_id, $paginate = null, $with = []){
        $query = $this->model->query();

        if(!empty($with)){
            $query->with($with);
        }

        $query->where('category_id', $category_id);

        if($paginate){
            return $query->paginate($paginate);
        }
        return $query->get();
    }

    public function checkQuantity($id, $quantity){
        $book = $this->model->find($id);
        if($book){
            if($book->quantity >= $quantity){
                return true;
            }
            return false;
        }
        return false;
    }

    public function getBookInArrId($arrId, $with = []){
        $query = $this->model->query();

        if(!empty($with)){
            $query->with($with);
        }

        $query->whereIn('id', $arrId);

        return $query->get();
    }

}

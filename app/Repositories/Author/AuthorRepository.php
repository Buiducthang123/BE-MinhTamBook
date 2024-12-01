<?php
namespace App\Repositories\Author;

use App\Models\Author;
use App\Repositories\BaseRepository;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{

    public function getModel()
    {
        return Author::class;
    }

    public function getAll($paginate = null, $with = [], $search = null)
    {
        $query = $this->model->query();

        if (!empty($search)) {
            $searchData = is_string($search) ? json_decode($search, true) : $search;
            $name = $searchData['name'] ?? null;

            if ($name) {
                $query->where('name', 'like', '%' . trim($name) . '%');
            }
        }

        if ($with) {
            $query->with($with);
        }

        if ($paginate) {
            return $query->paginate($paginate);
        }

        return $query->get();
    }

    public function show($id, $with = [])
    {
        $query = $this->model->query();

        if ($with) {
            $query->with($with);
        }

        return $query->findOrFail($id);
    }

}

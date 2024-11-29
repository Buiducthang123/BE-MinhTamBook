<?php
namespace App\Repositories\Author;

use App\Models\Author;
use App\Repositories\BaseRepository;
use GuzzleHttp\Psr7\Request;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface{

    public function getModel()
    {
        return Author::class;
    }

    public function getAll($paginate = null, $with = [])
    {
        $query = $this->model->query();


        if(is_array($with) && count($with) > 0){
            $query->with($with);
        }

        if ($paginate !== null) {
            return $query->paginate($paginate);
        }

        return $query->get();
    }

}

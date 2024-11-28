<?php
namespace App\Repositories\Author;

use App\Models\Author;
use App\Repositories\BaseRepository;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface{

    public function getModel()
    {
        return Author::class;
    }
}

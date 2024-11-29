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

}

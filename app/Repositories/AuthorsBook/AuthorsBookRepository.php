<?php
namespace App\Repositories\AuthorsBook;

use App\Models\AuthorBook;
use App\Repositories\BaseRepository;

class AuthorsBookRepository extends BaseRepository implements AuthorsBookRepositoryInterface
{
    public function getModel()
    {
        return AuthorBook::class;
    }
}

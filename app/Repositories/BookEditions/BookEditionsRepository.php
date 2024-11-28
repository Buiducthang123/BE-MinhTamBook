<?php
namespace App\Repositories\BookEditions;

use App\Models\BookEditions;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;

class BookEditionsRepository extends BaseRepository implements RepositoryInterface{

    public function getModel(){
        return BookEditions::class;
    }

}

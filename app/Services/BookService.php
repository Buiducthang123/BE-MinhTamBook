<?php
namespace App\Services;

use App\Repositories\Book\BookRepositoryInterface;

class BookService{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository){
        $this->bookRepository = $bookRepository;
    }

    public function getAll($data){

        $paginate = $data['paginate'] ?? null;
        $with = $data['with'] ?? [];
        return $this->bookRepository->getAll($paginate, $with);
    }

    public function create($data){
        return $this->bookRepository->create($data);
    }

    public function update($data, $id){
        return $this->bookRepository->update($data, $id);
    }

    public function delete($id){
        return $this->bookRepository->delete($id);
    }
}

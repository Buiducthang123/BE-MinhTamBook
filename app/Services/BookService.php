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
        $filter = $data['filter'] ?? null;
        $limit = $data['limit'] ?? null;
        $search = $data['search'] ?? null;
        return $this->bookRepository->getAll($paginate, $with, $filter, $limit, $search);
    }
    public function create($data){
        return $this->bookRepository->create($data);
    }

    public function update($data, $id){
        return $this->bookRepository->update($id, $data);
    }

    public function delete($id){
        return $this->bookRepository->delete($id);
    }

    public function show($id, $data){
        $with = $data['with'] ?? [];
        return $this->bookRepository->show($id, $with);
    }

    public function getBookByCategory($category_id, $data){
        $paginate = $data['paginate'] ?? null;
        $with = $data['with'] ?? [];
        return $this->bookRepository->getBookByCategory($category_id, $paginate, $with);
    }

    public function checkQuantity($id, $quantity){
        return $this->bookRepository->checkQuantity($id, $quantity);
    }
}

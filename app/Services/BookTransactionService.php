<?php
namespace App\Services;

use App\Repositories\BookTransaction\BookTransactionRepositoryInterface;

class BookTransactionService{

    protected $bookTransactionRepository;

    public function __construct(BookTransactionRepositoryInterface $bookTransactionRepository)
    {
        $this->bookTransactionRepository = $bookTransactionRepository;
    }

    public function getAll($paginate = null, $with = [], $filters = [], $search = null)
    {
        return $this->bookTransactionRepository->getAll($paginate, $with, $filters, $search);
    }

    public function show($id, $with = [])
    {
        return $this->bookTransactionRepository->show($id, $with);
    }

    public function update($data, $id)
    {
        return $this->bookTransactionRepository->update($id, $data);
    }

    public function create($data)
    {
        return $this->bookTransactionRepository->create($data);
    }

}

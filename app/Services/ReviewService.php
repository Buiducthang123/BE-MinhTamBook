<?php
namespace App\Services;

use App\Repositories\Review\ReviewRepositoryInterface;

class ReviewService
{
    protected $reviewRepository;

    public function __construct(ReviewRepositoryInterface $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function create($data = [])
    {
        return $this->reviewRepository->create($data);
    }

    public function getAll($paginate = null, $with = [], $filter = null, $sort = null)
    {
        return $this->reviewRepository->getAll($paginate, $with, $filter, $sort);
    }

    public function update($id, $data = [])
    {
        return $this->reviewRepository->update($id, $data);
    }

    public function showByBook($paginate = 10, $book_id, $with = [])
    {
        return $this->reviewRepository->showByBook($paginate, $book_id, $with);
    }
}

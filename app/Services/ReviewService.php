<?php
namespace App\Services;

use App\Repositories\Review\ReviewRepositoryInterface;

class ReviewService {
    protected $reviewRepository;

    public function __construct(ReviewRepositoryInterface $reviewRepository){
        $this->reviewRepository = $reviewRepository;
    }
}

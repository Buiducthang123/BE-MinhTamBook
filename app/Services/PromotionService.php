<?php

namespace App\Services;

use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Promotion\PromotionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PromotionService {
    protected $promotionRepository;

    protected $bookRepository;

    public function __construct(PromotionRepositoryInterface $promotionRepository, BookRepositoryInterface $bookRepository)
    {
        $this->promotionRepository = $promotionRepository;
        $this->bookRepository = $bookRepository;
    }

    public function create($data=[])
    {
        DB::beginTransaction();
        try {
            $promotion = $this->promotionRepository->create($data);
            foreach ($data['items'] as $bookId) {
                $book = $this->bookRepository->find($bookId);
                if ($book) {
                    $book->promotion_id = $promotion->id;
                    $book->save();
                }
            }
            DB::commit();
            return $promotion;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    public function getAll($data=[])
    {
        $paginate = $data['paginate'] ?? null;

        $with = $data['with'] ?? [];

        $filter = $data['filter'] ?? null;

        $sort = $data['sort'] ?? null;

        return $this->promotionRepository->getAll($paginate, $with, $filter, $sort);
    }

    public function show($id, $data=[])
    {
        $with = $data['with'] ?? [];

        return $this->promotionRepository->show($id, $with);
    }

    public function update($id, $data=[])
    {
        DB::beginTransaction();
        try {
            $promotion = $this->promotionRepository->update($id, $data);
            $bookIds = $data['items'] ?? [];
            //promotion and book relationship 1-n
            $books = $promotion->books;
            foreach ($books as $book) {
                $book->promotion_id = null;
                $book->save();
            }
            foreach ($bookIds as $bookId) {
                $book = $this->bookRepository->find($bookId);
                if ($book) {
                    $book->promotion_id = $promotion->id;
                    $book->save();
                }
            }

            DB::commit();
            return $promotion;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($id)
    {
        return $this->promotionRepository->delete($id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookTransactionRequest;
use App\Services\BookTransactionService;
use Illuminate\Http\Request;

class BookTransactionController extends Controller
{
    protected $bookTransactionService;

    public function __construct(BookTransactionService $bookTransactionService)
    {
        $this->bookTransactionService = $bookTransactionService;
    }

    public function index(Request $request)
    {
        $paginate = $request['paginate'] ?? null;
        $with = $request['with'] ?? [];
        $filters = $request['filters'] ?? null;
        $search = $request['search'] ?? null;
        $transactions = $this->bookTransactionService->getAll($paginate, $with, $filters, $search);
        return response()->json($transactions);
    }

    public function show($id)
    {
        $with = request('with') ?? [];
        $transaction = $this->bookTransactionService->show($id, $with);
        return response()->json($transaction);
    }

    public function update(BookTransactionRequest $request, $id)
    {
        $data = $request->all();
        $transaction = $this->bookTransactionService->update($data, $id);
        return response()->json($transaction);
    }

    public function create(BookTransactionRequest $request)
    {
        $data = $request->all();
        $transaction = $this->bookTransactionService->create($data);
        return response()->json($transaction);
    }
}

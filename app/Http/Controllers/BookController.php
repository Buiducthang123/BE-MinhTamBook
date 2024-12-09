<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    public function index(Request $request)
    {
        $data = $request->all();
        $books = $this->bookService->getAll($data);
        return response()->json($books);
    }

    public function create(BookRequest $request)
    {
        try {
            $book = $this->bookService->create($request->all());
            return response()->json($book);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function show($id, Request $request)
    {
        $book = $this->bookService->show($id, $request->all());
        return response()->json($book);
    }

    public function update(BookRequest $request, $id)
    {
        $book = $this->bookService->update($request->all(), $id);
        return response()->json($book);
    }
}

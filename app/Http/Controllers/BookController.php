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
        $validated = $request->validated();

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        return response()->json($request->all());
        // return response()->json($this->bookService->create($request->all()));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Services\AuthorService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(Request $request)
    {
        $paginate = $request->paginate ?? null;
        $with = $request->with ?? [];
        $authors = $this->authorService->getAll($paginate, $with);
        return response()->json($authors);
    }

    public function create(AuthorRequest $request)
    {
        $data = $request->all();
        try{
            $author = $this->authorService->create($data);
            return response()->json([
                'success' => true,
                'message' => 'Tạo mới tác giả thành công',
                'data' => $author,
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function update(AuthorRequest $request, $id)
    {
        try {
            $author = $this->authorService->update($id, $request->all());
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công',
                'data' => $author,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function delete($id)
    {
        try {
            $author = $this->authorService->delete($id);
            return response()->json([
                'success' => true,
                'message' => 'Xóa thành công',
                'data' => $author,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}

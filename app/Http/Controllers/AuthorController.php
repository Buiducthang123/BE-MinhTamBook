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
        $author = $this->authorService->create($data);
        if (!$author) {
            return response()->json(['message' => 'Tạo tác giả không thành công'], 500);
        }
        return response()->json($author);
    }

    public function update(AuthorRequest $request, $id)
    {
        $data = $request->all();
        $author = $this->authorService->update($id, $data);
        if (!$author) {
            return response()->json(['message' => 'Cập nhật tác giả không thành công'], 500);
        }
        return response()->json($author);
    }

    public function delete($id)
    {
        try {
            $this->authorService->delete($id);
            return response()->json([
                'success' => true,
                'message' => 'Xóa tác giả thành công',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy tác giả',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xóa tác giả không thành công',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

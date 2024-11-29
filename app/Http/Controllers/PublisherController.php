<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublisherRequest;
use App\Services\PublisherService;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    protected $publisherService;

    public function __construct(PublisherService $publisherService)
    {
        $this->publisherService = $publisherService;
    }
    public function index(Request $request)
    {
        $publishers = $this->publisherService->getAll($request->all());
        return response()->json($publishers);
    }

    public function create(PublisherRequest $request)
    {
        $data = $request->all();
        try{
            $publisher = $this->publisherService->create($data);
            return response()->json([
                'success' => true,
                'message' => 'Tạo mới nhà xuất bản thành công',
                'data' => $publisher,
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function update(PublisherRequest $request, $id)
    {
        try{
            $publisher = $this->publisherService->update($id, $request->all());
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công',
                'data' => $publisher,
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function delete($id)
    {
        try{
            $publisher = $this->publisherService->delete($id);
            return response()->json([
                'success' => true,
                'message' => 'Xóa thành công',
                'data' => $publisher,
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

}

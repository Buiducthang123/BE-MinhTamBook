<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    protected $orderItemController;

    protected $orderService;

    public function __construct(OrderItemController $orderItemController, OrderService $orderService)
    {
        $this->orderItemController = $orderItemController;
        $this->orderService = $orderService;
    }
    public function create(OrderRequest $request)
    {
        return $this->orderService->create($request->all());
    }

    public function updateStatusAfterPayment(Request $request, $id)
    {
        return $this->orderService->updateStatusAfterPayment($id,$request->all());
    }

    public function getAll(Request $request)
    {
        $paginate = $request->get('paginate') ?? null;

        $with = $request->get('with') ?? [];

        $filter = $request->get('filter') ?? null;

        $sort = $request->get('sort') ?? null;

        return $this->orderService->getAll($paginate, $with, $filter, $sort);
    }

    public function show($id, Request $request)
    {
        $with = $request->get('with') ?? [];

        return $this->orderService->show($id, $with);
    }

    public function update(OrderRequest $request, $id)
    {
        $result = $this->orderService->update($id, $request->all());

        if($result){
            return response()->json(['message' => 'Cập nhật thành công'], 200);
        }
        return response()->json(['message' => 'Cập nhật thất bại'], 400);
    }

    public function getMyOrder(Request $request)
    {
        $paginate = $request->get('paginate') ?? null;

        $with = $request->get('with') ?? [];

        $filter = $request->get('filter') ?? null;

        $sort = $request->get('sort') ?? null;

        $user = Auth::user();

        if(!$user){
            return response()->json(['message' => 'Vui lòng đăng nhập'], 401);
        }
        return $this->orderService->myOrder($paginate, $with, $filter, $sort);
    }
}

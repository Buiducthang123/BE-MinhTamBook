<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    /**
     * Hàm khởi tạo
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Đăng ký
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
        $data = $request->all();
        $response = $this->authService->register($data);
        return response()->json($response);
    }
    /**
     * Đăng nhập
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $data = $request->all();
        $response = $this->authService->login($data);
        return response()->json($response);
    }

    /**
     * Đăng xuất
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){
        $response = $this->authService->logout();
        return response()->json($response);
    }
}

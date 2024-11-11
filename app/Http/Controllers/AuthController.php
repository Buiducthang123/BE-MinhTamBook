<?php

namespace App\Http\Controllers;

use App\Enums\AccountStatus;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    protected $authService;
    protected $roleService;
    /**
     * Hàm khởi tạo
     */
    public function __construct(AuthService $authService,RoleService $roleService)
    {
        $this->authService = $authService;
        $this->roleService = $roleService;
    }

    /**
     * Đăng ký
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request){

        $email = $request->email;
        $password = $request->password;
        $full_name = $request->full_name;
        $company_name = $request->company_name;
        $company_address = $request->company_address;
        $company_phone_number = $request->company_phone_number;
        $company_tax_code = $request->company_tax_code;
        $contact_person_name = $request->contact_person_name;
        $representative_id_card = $request->representative_id_card;
        $representative_id_card_date = $request->representative_id_card_date;
        $contact_person_position = $request->contact_person_position;
        $role_id = null;
        $status = AccountStatus::NOT_ACTIVE;

        $isCompanyUser = false;
        if ($company_name && $company_address && $company_phone_number && $company_tax_code && $contact_person_name && $representative_id_card && $representative_id_card_date && $contact_person_position) {
            $isCompanyUser = true;
        }
        if ($isCompanyUser) {
            $role = $this->roleService->getRoleByName('company');
            if (!$role) {
                return response()->json(['message' => 'Không thể tạo tài khoản, vui lòng liên hệ quản trị viên'], 404);
            }
           $role_id = $role->id;
        } else {
            $role = $this->roleService->getRoleByName('user');
            if (!$role) {
                return response()->json(['message' => 'Không thể tạo tài khoản, vui lòng liên hệ quản trị viên'], 404);
            }
            $role_id = $role->id;
            $status = AccountStatus::ACTIVE;
        }
        $data = [
            'email' => $email,
            'password' => $password,
            'full_name' => $full_name,
            'company_name' => $company_name,
            'company_address' => $company_address,
            'company_phone_number' => $company_phone_number,
            'company_tax_code' => $company_tax_code,
            'contact_person_name' => $contact_person_name,
            'representative_id_card' => $representative_id_card,
            'representative_id_card_date' => $representative_id_card_date,
            'contact_person_position' => $contact_person_position,
            'role_id' => $role_id,
            'status' => $status
        ];
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

<?php
namespace App\Repositories\Auth;

use App\Enums\AccountStatus;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{

    /**
     * Summary of getModel
     * @return mixed
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * Summary of register
     * @param array $data
     * @return mixed
     */
    public function register($data)
    {
        try {
            DB::beginTransaction();
            $data['password'] = bcrypt($data['password']);
            $user = $this->model->create($data);
            $token = null;
            //Đặt tên token theo ngày giờ cấp phát
            if ($user) {
                $tokenName = 'WebToken_' . now()->format('Y_m_d_H_i_s');
                $token = $user->createToken($tokenName)->plainTextToken;
                $message = $user->status == AccountStatus::ACTIVE ? 'Đăng ký thành công' : 'Đăng ký thành công, vui lòng chờ xác nhận từ quản trị viên';
                DB::commit();
                return [
                    'user' => $user,
                    'token' => $token,
                    'message' => $message,
                ];
            }
            return abort(404, 'Tạo tài khoản thất bại, vui lòng liên hệ quản trị viên');
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * Summary of login
     * @param array $data
     * @return mixed
     */
    public function login($data)
    {
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        $user = $this->model->where('email', $email)->first();
        if (!$user) {
            return abort(404, 'Email đăng nhập không chính xác');
        }

        $credential = Auth::attempt(['email' => $email, 'password' => $password]);
        if (!$credential) {
            return abort(404, 'Mật khẩu không chính xác');
        }
        $tokenName = 'WebToken_' . now()->format('Y_m_d_H_i_s');
        $token = $user->createToken($tokenName, ["*"], now()->addMonth())->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
            'message' => 'Đăng nhập thành công',
        ];
    }

    /**
     * Summary of logout
     * @return mixed
     */
    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            $result = $user->tokens()->delete();
            if ($result) {
                return response()->json(['message' => 'Đăng xuất thành công']);
            }
            return response()->json(['message' => 'Đăng xuất thất bại'], 500);
        }
        return response()->json(['message' => 'Người dùng chưa đăng nhập'], 401);
    }

    /**
     * Summary of user
     * @return User | null
     */
    public function user()
    {
        return null;
    }

    /**
     * Summary of refresh
     * @return string
     */
    public function refresh()
    {
        return 'refresh';
    }

}

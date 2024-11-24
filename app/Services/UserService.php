<?php
namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserService {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function updateMe($data)
    {
        $user = Auth::user();

        if (!$user) {
            return abort(403, 'Bạn không có quyền thực hiện hành động này');
        }

        $dataUpdate = [
            'full_name' => $data['fullName'] ?? $user->full_name,
            'avatar' => $data['avatar'] ?? $user->avatar,
        ];

        $user = $this->userRepository->update($user->id,$dataUpdate);

        if (!$user) {
            return abort(500, 'Có lỗi xảy ra');
        }
        return $user;
    }
}

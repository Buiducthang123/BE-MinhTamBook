<?php

namespace App\Services;

use App\Repositories\Auth\AuthRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;


class AuthService
{
    protected $authRepository;
    protected $roleRepository;

    public function __construct(AuthRepositoryInterface $authRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->authRepository = $authRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Summary of register
     * @param array $data
     * @return mixed
     */
    public function register($data)
    {
        return $this->authRepository->register($data);
    }

    /**
     * Summary of login
     * @param array $data
     * @return mixed
     */

    public function login($data){
        return $this->authRepository->login($data);
    }

    public function logout(){
        return $this->authRepository->logout();
    }

}

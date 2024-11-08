<?php
namespace App\Repositories\Auth;

use App\Repositories\RepositoryInterface;

interface AuthRepositoryInterface extends RepositoryInterface
{
    public function register($data);
    public function login($data);
    public function logout();
    public function user();
    public function refresh();
}

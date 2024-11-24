<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userServices;

    public function __construct(UserService $userServices)
    {
        $this->userServices = $userServices;
    }

    public function store(Request $request)
    {
        return $request->all();
    }

    public function update(Request $request)
    {
       return $this->userServices->updateMe($request->all());
    }
}

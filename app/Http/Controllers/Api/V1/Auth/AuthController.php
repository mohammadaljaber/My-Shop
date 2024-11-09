<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Repositories\Auth\AuthRepository;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthRepository $authRepository){}
    use ApiResponse;

    public function register(RegisterRequest $request){
        $user=$this->authRepository->register($request->validated());
        return $this->response('created user successfully',$user);
    }

    public function login(LoginRequest $request){
        return $this->authRepository->login($request->validated());
    }

    public function verify($id){
        return $this->authRepository->verify($id);
    }

    public function logout(){
        return $this->authRepository->logout();
    }

}

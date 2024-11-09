<?php

namespace App\Http\Controllers\Repositories\Auth;

use App\Mail\verify;
use App\Models\User;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthRepository{

    public function __construct(protected User $model){}

    use ApiResponse;
    public function register($data){
        unset($data['confirm_pass']);
        $user=User::create($data);
        $this->sendVerifyEmail($user);
        return $user;
    }

    private function sendVerifyEmail($user){
        Mail::to($user->email)->send(new verify($user));
    }

    public function login($data){
        $user=User::where('email',$data['email'])->first();
        if($user){
            if($user->email_verified_at){
                if(Hash::check($data['password'],$user->password)){
                    $user=Auth::loginUsingId($user->id);
                    $token=$this->createUserToken();
                    return $this->response('you have successfully logged in',['user'=>$user,'token'=>$token]);
                }else{
                    return $this->responseMessage('incorrect password');
                }
            }else{
                $this->sendVerifyEmail($user);
                return $this->responseMessage('an activation email has been send to your email , please activate your account.');
            }
        }else{
            return $this->responseMessage('this account does not exist');
        }
    }

    private function createUserToken(){
        $user=Auth::user();
        $user->tokens()->delete();
        return $token = $user->createToken('apiToken')->plainTextToken;
    }

    public function verify($id){
        $user=User::find($id);
        $user->email_verified_at=Carbon::now();
        $user->save();
        return $this->responseMessage('your account is active');
    }

    public function logout(){
        Auth::user()->tokens()->delete();
        return $this->responseMessage('logging out successfully');
    }

}

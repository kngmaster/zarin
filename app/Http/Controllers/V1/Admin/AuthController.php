<?php

namespace App\Http\Controllers\V1\Admin;

use App\Helper\JsonResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Interface\AuthRepositoryInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $repository;
    public function __construct(AuthRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function register(RegisterRequest $request)
    {       
        $res = $this->repository->register($request);         
        return JsonResponseHelper($res, )
    }
 
    /**
     * Laravel Passport User Login  API Function
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
 
        $userData = User::where('email',$request->input('email'))->first();
        if ($userData) {
            if (Hash::check($request->password, $userData->password)) {
                    $success['token'] = $userData->createToken('MY_New_Project')->accessToken;
                    $success['massage'] = "Login Successfully!";
                    return response()->json(['data'=>$success], 200);
            }
        }else{
            return response()->json(['message'=> 'User does not exist'], 422);
        }  
    }
 
 
 
    /**
     * Laravel Passport User Login  API Function
     */
   
    public function logout(Request $request)
{
    $token = $request->user()->token();
    $token->revoke();
    return response()->json(['message' => 'You have been successfully logged out!'], 200);
}
 
}

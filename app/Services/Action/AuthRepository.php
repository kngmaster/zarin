<?php

namespace App\Services\Action;
use App\Models\User;
use App\Services\Interface\AuthRepositoryInterface;



class AuthRepository implements AuthRepositoryInterface
{

    public function register($request)
    {      
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $user = User::create([
            "name" => $name,
            "email" => $email,
            "password" =>$password
        ]);        
      
        $data = [];
        $data['user'] = $user;
        $data['token'] = $user->createToken('esanj_token')->accessToken;
        return $data;
    }
 
    /**
     * Laravel Passport User Login  API Function
     */
    public function login($request)
    {        
        $email = $request->email;
        $password = $request->password;

        $userData = User::where('email',$email)->first();
        if ($userData) {
            if (Hash::check($password, $userData->password)) {
                    $success['token'] = $userData->createToken('MY_New_Project')->accessToken;
                    $success['massage'] = "Login Successfully!";
                    return response()->json(['data'=>$success], 200);
            }
        }else{
            return false;          
        }  
    }
 
 
 
    /**
     * Laravel Passport User Login  API Function
     */
   
    public function logout($request)
{
    $token = $request->user()->token();
    $token->revoke();
    return true;
}
 
}
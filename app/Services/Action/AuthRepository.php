<?php

namespace App\Services\Action;

use App\Models\User;
use App\Services\Interface\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{

    public function register($request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $version = resolve(SettingRepository::class)->get_version();

        $user = User::create([
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "version" => $version
        ]);

        $data = [];
        $data['user'] = $user;
        $data['token'] = $user->createToken('zarin_token')->accessToken;
        return $data;
    }

    /**
     * Laravel Passport User Login  API Function
     */
    public function login($request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {                
                $data = [];
                $data['user'] = $user;
                $data['token'] = $user->createToken('zarin_token')->accessToken;
                return $data; 
            }
        } else {
            return false;
        }
    }


    public function logout($request)
    {
        $request->user()->tokens()->delete();
        return true;
    }
}

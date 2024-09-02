<?php

namespace App\Http\Controllers\V1\Api;

use App\Helpers\JsonResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Services\Interface\AuthRepositoryInterface;
use Illuminate\Http\Request;

class AuthController extends Controller {
    
    public function __construct(private AuthRepositoryInterface $authRepository ) {}

    public function register( RegisterRequest $request ) {        
        $res = $this->authRepository->register( $request );
        return JsonResponseHelper::OutputResponse( [ new AuthResource($res["user"]), "token" => $res["token"]], JsonResponseHelper::MESSAGE[ 'success' ], true, 200 );
    }

    /**
    * Laravel Passport User Login  API Function
    */

    public function login( LoginRequest $request ) {
        $res = $this->authRepository->login( $request );
        if($res == false){
            return JsonResponseHelper::OutputResponse( '', JsonResponseHelper::MESSAGE[ 'login_invalid' ], true, 422 );           
        }
        return JsonResponseHelper::OutputResponse( [ new AuthResource($res["user"]), "token" => $res["token"]], JsonResponseHelper::MESSAGE[ 'success' ], true, 200 );

        
    }

    /**
    * Laravel Passport User Login  API Function
    */

    public function logout( Request $request ) {
        $res = $this->authRepository->logout( $request );
        return JsonResponseHelper::OutputResponse( '', JsonResponseHelper::MESSAGE[ 'success' ], true, 200 );
    }

}

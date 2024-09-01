<?php

namespace App\Http\Controllers\V1\Api;

use App\Helper\JsonResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Interface\AuthRepositoryInterface;
use Illuminate\Http\Request;

class AuthController extends Controller {
    private $repository;

    public function __construct( AuthRepositoryInterface $repository ) {
        $this->repository = $repository;
    }

    public function register( RegisterRequest $request ) {

        $res = $this->repository->register( $request );

        return JsonResponseHelper::OutputResponse( '', JsonResponseHelper::MESSAGE[ 'success' ], true, 200 );
    }

    /**
    * Laravel Passport User Login  API Function
    */

    public function login( LoginRequest $request ) {
        $res = $this->repository->login( $request );
        if($res == false){
            return JsonResponseHelper::OutputResponse( '', JsonResponseHelper::MESSAGE[ 'login_invalid' ], true, 422 );           
        }
        return JsonResponseHelper::OutputResponse( '', JsonResponseHelper::MESSAGE[ 'success' ], true, 200 );

        
    }

    /**
    * Laravel Passport User Login  API Function
    */

    public function logout( Request $request ) {
        $res = $this->repository->logout( $request );

        return JsonResponseHelper::OutputResponse( '', JsonResponseHelper::MESSAGE[ 'success' ], true, 200 );
    }

}

<?php

namespace App\Services\Interface;

interface AuthRepositoryInterface {
    public function register( $request ); 

    public function login( $request );

    public function logout( $request );

}
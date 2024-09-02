<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Api\AuthController as AuthFront;
use App\Http\Controllers\V1\Admin\AuthController as AuthAdmin;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([], function () {
    //login
    Route::post('/login', [AuthFront::class, 'login']);
    //register
    Route::post('/register', [AuthFront::class, 'register']);
    //log out user
    Route::post('/logout', [AuthFront::class, 'logout'])->middleware(["auth:api"]);
});

Route::group(["prefix" => "admin","middleware"=>["auth:api"]], function () { 
    
    
});


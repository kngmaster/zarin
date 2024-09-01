<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Api\UserController as UserFront;
use App\Http\Controllers\V1\Admin\UserController as UserAdmin;



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
});

Route::group(["prefix" => "admin","middleware"=>["auth:api"]], function () {
    //create
   // Route::post('/create', [UserAdmin::class, 'create']);
    
  
});

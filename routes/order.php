<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Api\OrderController as OrderFront;
use App\Http\Controllers\V1\Admin\OrderController as OrderAdmin;



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


Route::group(["middleware"=>["auth:api"]], function () { 
   //create
   Route::post('/order_follower', [OrderFront::class, 'order_follower']);
   //unfollow list
   Route::get('/unfollow_list', [OrderFront::class, 'order_unfollow_list']);
   //follow page
   Route::post('/follow_user', [OrderFront::class, 'follow_user']);
   
});

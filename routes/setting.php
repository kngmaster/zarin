<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Api\SettingController as SettingFront;




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
      //get first config
      Route::get('/first_init', [SettingFront::class, 'config']);
});

Route::group(["prefix" => "admin","middleware"=>["auth:api"]], function () { 
  
});

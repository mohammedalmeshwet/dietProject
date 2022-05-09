<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthUserController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Admin\AuthAdminController;
use App\Http\Controllers\Api\Admin\adminOperController;
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

Route::group(['prefix' => 'user','namespace' => 'User'],function(){
    Route::post('register',[UserController::class,'store']);
    Route::put('personal-information/{id}',[UserController::class,'update']);
    Route::delete('delete/{id}',[UserController::class,'destroy']);
    Route::get('login',[AuthUserController::class,'login']);
    Route::get('logout',[AuthUserController::class,'logout']) -> middleware(['auth.guard:user-api']);
});


Route::group(['prefix' => 'admin','namespace' => 'Admin'],function(){
    Route::get('login',[AuthAdminController::class,'login']);
    Route::get('logout',[AuthAdminController::class,'logout']) -> middleware(['auth.guard:admin-api']);
    Route::delete('delete-user/{id}',[UserController::class,'destroy']);
});

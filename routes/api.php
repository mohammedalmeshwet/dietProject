<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthUserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|llll
*/

Route::group(['prefix' => 'user','namespace' => 'User'],function(){
    Route::post('login',[AuthUserController::class,'login']);
    Route::get('logout',[AuthUserController::class,'logout']) -> middleware(['auth.guard:user-api']);
});

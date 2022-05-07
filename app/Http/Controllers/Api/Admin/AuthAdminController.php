<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthAdminController extends Controller
{
    use GeneralTrait;

    public function login(Request $request){
        //validaion
        try {
            $rules = [
                'email' => 'required',
                'password' => 'required'
            ];

            $validator = Validator::make($request -> all(),$rules);
            if($validator->fails()){
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code,$validator);
            }
            //login
            $credentials = $request -> only(['email','password']);
            $token = Auth::guard('admin-api') -> attempt($credentials);

        if(!$token)
            return $this->returnError('E001','بيانات الدخول غير صحيحة');
            //return Token
            $admin = Auth::guard('admin-api')->user();
            $admin -> api_Token = $token;
          return  $this->returnData("Admin",$admin);

        } catch (\Exception $ex) {
             return $this -> returnError($ex -> getCode(),$ex -> getMessage());
        }

    }



    
    public function logout(Request $request){
        $token = $request -> header('auth-token');
        if($token){
            try {
                JWTAuth::setToken($token)->invalidate();
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return $this -> returnError('E000','some thing went wrongs');
            }

            return $this -> returnSuccessMessage('Logged out successfully');
        }else{
            return $this -> returnError('E000','some thing went wrongs');
        }
    }
}

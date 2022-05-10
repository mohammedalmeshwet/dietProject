<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class RegisterController extends Controller
{
    use GeneralTrait;

    public function store (Request $request){


        $rules = $this->getRules();
        $messages = $this->getMessages();

        $validator = Validator::make($request -> all(), $rules, $messages);

        if($validator -> fails()){
            return $this -> returnError('E000',$validator -> errors() ->first());
        }


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'height' => $request->height,
        ]);
        return $this->returnSuccessMessage('تم الاضافة بنجاح');
    }



    public function getRules(){
        return [
            'name' => ['required','max:100'],
            'email' => ['required'],
            'password' => ['required'],
            'birth_date' => ['required'],
            'gender' => ['required'],
            'height' => ['required','numeric']
        ];
    }


    public function getMessages(){
        return [
            'name.required' => 'يجب ادخال الاسم',
            'email.required' => 'يجب ادخال الإيميل',
            'password.required' => 'يجب ادخال كلمة السر',
            'birth_date.required' => 'يجب ادخال تاريخ الميلاد',
            'gender.required' => 'يجب ادخال الجنس',
            'height.required' => 'يجب ادخال الطول',
            'height.numeric' => 'يجب أن يكون الطول رقم',
        ];
    }
}

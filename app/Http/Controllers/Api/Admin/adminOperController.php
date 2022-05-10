<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class adminOperController extends Controller
{
    use GeneralTrait;

    public function deleteUser($id){
        $user = User::find($id);
        if($user){
            $result = $user->delete();
                if($result)
                {
                    return $this ->returnSuccessMessage('تم حذف المستخدم رقم   '.$id);
                }else{
                    return $this ->returnError("E000",'لم يتم  حذف المستخدم رقم  '.$id);
                }
        }else{
            return $this->returnError("E005","المستخدم غير موجود");
        }






    }

}

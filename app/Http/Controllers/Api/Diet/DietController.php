<?php

namespace App\Http\Controllers\Api\Diet;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\Diet;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class DietController extends Controller
{
    use GeneralTrait;
    public function getDietById($id){

            //    $diet = Diet::find($id);

            $diet =  Diet::where('calory',$id)->get();
            return $this->returnData('Diet',$diet);




    }

}

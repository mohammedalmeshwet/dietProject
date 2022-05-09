<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();

        $validator = Validator::make($request -> all(), $rules, $messages);

        if($validator -> fails()){
            return $this -> returnError('E000',$validator -> errors() ->first());
        }


        // User::create([
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $this->returnSuccessMessage('تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($user){
            User::where('id',$id)->update([
                'first_name' => $request -> first_name,
                'last_name' => $request -> last_name,
                'birth_date' => $request -> birth_date,
                'gender' => $request -> gender,
                'height' => $request -> height,
            ]);
            return $this->returnSuccessMessage('تم التعديل بنجاح');
        }
        return $this->returnError('E000','لم يتم التعديل');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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




    public function getRules(){
        return [
            // 'name' => ['required','max:100'],
            'email' => ['required'],
            'password' => ['required','confirmed'],
            // 'birth_date' => ['required'],
            // 'gender' => ['required'],
            // 'height' => ['required','numeric']
        ];
    }


    public function getMessages(){
        return [
            // 'name.required' => 'يجب ادخال الاسم',
            'email.required' => 'يجب ادخال الإيميل',
            'password.required' => 'يجب ادخال كلمة السر',
            // 'birth_date.required' => 'يجب ادخال تاريخ الميلاد',
            // 'gender.required' => 'يجب ادخال الجنس',
            // 'height.required' => 'يجب ادخال الطول',
            // 'height.numeric' => 'يجب أن يكون الطول رقم',
        ];
    }
}

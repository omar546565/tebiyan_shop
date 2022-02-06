<?php

namespace App\Http\Controllers\API;



use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{
   public  function  register(Request  $request){
       $validator = Validator::make($request->all(),
           [
               'name' => 'required',
               'email'=> 'required|email|unique:users',
               'password'=> 'required',
               'phone'=> 'required|unique:users',
               //'C_password'=> 'required|same:password',
           ]);

       if ($validator->fails()){
           return $this->sendError('pleas rerro' , $validator->errors());
       }

        $input = $request->all() ;
        $input['password'] = Hash::make( $input['password']);

        $user = User::create($input);
        $success['token'] = $user->createToken('muhaaaaamd')->accessToken;
        $success['name'] = $user->name;
              $response =[
           'success'=>true,
           'data'=>$success,
           'message'=>'Uder registered successfully'
       ];
       return response()->json($response,200);


   }

   public  function  login(Request  $request){
       if (Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
       {
           $user = Auth::user();
           $success['token'] = $user->createToken('muhaaaaamd')->accessToken;
           $success['id'] = $user->id;
           $success['name'] = $user->name;
           $success['email'] = $user->email;
           $success['phone'] = $user->phone;
           $success['image'] = $user->image;
           $success['points'] = $user->points;
           $success['credit'] = $user->credit;

                  $response =[
               'success'=>true,
               'data'=>$success,
               'message'=>'تم تسجيل الدخول بنجاح'
           ];
           return response()->json($response,200);
       }
       else
       {
           $success['token'] = null;
           $success['id'] = null;
           $success['name'] = null;
           $success['email'] = null;
           $success['phone'] = null;
           $success['image'] = null;
           $success['points'] = null;
           $success['credit'] = null;
           $response =[
               'success'=>false,
               'data'=>$success,
               'message'=>'لم يتم تسجيل الدخول تأكد من المعلومات'
           ];
           return response()->json($response,200);
       }


   }
   public  function  index(Request  $request){
       $user = Auth::user();
       $success['name'] = $user->name;
       $success['email'] = $user->email;
       $response =[
           'success'=>true,
           'data'=>$success,
           'message'=>' successfully'
       ];
       return response()->json($response,200);


   }


   public  function  UpdateUser(Request  $request){
       $user = Auth::user();


       $input = $request->all() ;

       $user->name=$input['name'];
       $user->password=Hash::make( $input['password']);
       $user->save();

       $response =[
           'success'=>true,
           'data'=>$user,
           'message'=>'update successfully'
       ];
       return response()->json($response,200);


   }



}

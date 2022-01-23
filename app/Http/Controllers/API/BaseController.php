<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller ;
use Illuminate\Http\Request;

class BaseController extends Controller
{
   public  function  sendResponse($result, $message){
       $response =[
          'success'=>true,
          'date'=>$result,
          'message'=>$message
       ];
       return response()->json($response,200);
   }
   public  function  sendError($Error, $errorMessage=[],$code =404){
       $response =[
          'success'=>false,
          'date'=>$Error,
       ];
       if (!empty($errorMessage)){
           $response ['date'] =$errorMessage ;
       }
       return response()->json($response,$code);
   }
}

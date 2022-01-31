<?php

namespace App\Http\Controllers\API;



use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class HomeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public  function  index2(){

         $Product=Product::with('Images')->get();

         $Banner=Banner::all();
        $response =[
            'status'=>true,
            'message'=>' successfully',
            'data'=>[
                'banners'=>$Banner,
                'products'=>$Product

            ],

        ];
        return response()->json($response,200);


     }




}

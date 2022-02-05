<?php

namespace App\Http\Controllers\API;



use App\Models\Banner;
use App\Models\Categorie;
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
            'message'=>'successfully',
            'data'=>[
                'banners'=>$Banner,
                'products'=>$Product

            ],

        ];
        return response()->json($response,200);


     }
        public  function  Categories(){



         $Categorie=Categorie::paginate(6);
        $response =[
            'status'=>true,
            'message'=>'successfully',
            'data'=>$Categorie,

        ];
        return response()->json($response,200);


     }
        public  function  Favorites(Request $request){


            $Product=Product::find($request->product_id);
            if ($Product->in_favorites == 'true'){
                Product::where('id',$request->product_id)->update([
                    'in_favorites' => 'false'
                ]);

                $message= 'تم الحذف بنجاح';
            }else{
                Product::where('id',$request->product_id)->update([
                    'in_favorites' => 'true'
                ]);
                $message= 'تم الإضافة للمفضلة';
            }

            $response =[
                'status'=>true,
                'message'=>$message,
                'data'=>[
                    'products'=>$Product

                ],

            ];
        return response()->json($response,200);


     }




}

<?php

namespace App\Http\Controllers\API;



use App\Models\Banner;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\User;
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
        public  function  Profile(){

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
        public  function  Favorites(Request $request){


            $Product=Product::find($request->product_id);
            if ($Product->in_favorites == 'true'){
                Product::where('id',$request->product_id)->update([
                    'in_favorites' => 'false'
                ]);

                $message= 'تم الإزالة من المفضلة';
                $update= 0;
            }else{
                Product::where('id',$request->product_id)->update([
                    'in_favorites' => 'true'
                ]);
                $message= 'تم الإضافة للمفضلة';
                $update= 1;
            }
            $Products=Product::find($request->product_id);
            $response =[
                'status'=>true,
                'message'=>$message,
                'update'=>$update,
                 'products'=>$Products
            ];
        return response()->json($response,200);


     }
        public  function  Favoritesget(){

            $Products=Product::where('in_favorites','true')->get();
            $response =[
                'status'=>true,
                'message'=>'null',

                 'products'=>$Products
            ];
        return response()->json($response,200);


     }




}

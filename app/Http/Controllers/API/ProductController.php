<?php

namespace App\Http\Controllers\API;


use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isNull;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $Product=Product::all();
       return $this->sendResponse(ProductResource::collection($Product),
       "all Products sent");
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
       $input = $request->all();
       $Validator= Validator::make($input, [
           'name' => 'required' ,
           'detail' => 'required' ,
           'price' => 'required' ,
              ]);
       if ($Validator->fails()){
           return $this->sendError('pleas Validator error ' , $Validator->errors());
       }
       $Product=Product::create($input);
        return $this->sendResponse(new ProductResource($Product), 'Product create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Product=Product::find($id);
        if (is_null($Product)){
            return $this->sendError('pleas Product no found ');
        }

        return $this->sendResponse(new ProductResource($Product), 'Product found successfully');
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
    public function update(Request $request, Product $Product)
    {
        $input = $request->all();
        $Validator= Validator::make($input, [
            'name' => 'required' ,
            'detail' => 'required' ,
            'price' => 'required' ,
        ]);
        if ($Validator->fails()){
            return $this->sendError('pleas Validator error ' , $Validator->errors());
        }
        $Product->name=$input['name'];
        $Product->detail=$input['detail'];
        $Product->price=$input['price'];
        $Product->save();
        return $this->sendResponse(new ProductResource($Product), 'Product update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $Product)
    {
        $Product->delete();
        return $this->sendResponse(new ProductResource($Product), 'Product delete successfully');
    }
}

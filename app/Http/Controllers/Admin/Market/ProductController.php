<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\ProductMeta;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status' , 1)->where('marketable' , 1)->orderBy('created_at' , 'desc')->paginat(15)->get();

        return response()->json([
            'products' => $products,
            'status' => true
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
    $inputs = $request->all();

    //fix date
    $realTimePublishedAt = substr($request->published_at , 0 , 10);
    $inputs['published_at'] = date('Y/m/d H:i:s',(int)$realTimePublishedAt);
    // DB::transaction(function () use ($inputs,$request) {
        $product = Product::create($inputs);
        $metas = array_combine($request->meta_key , $request->meta_value);

        foreach($metas as $key => $value){
            ProductMeta::create([
                'meta_key' => $key,
                'meta_value' => $value,
                'product_id' => $product->id
            ]);
        }
        return response()->json([
            'product' => $product,
            'status' => true
        ]);
        // });

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        $prd = Product::where('id' , $product)->with('metas')->get();
        return response()->json([
            'product' => $prd,
            'status' => true
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $inputs = $request->all();
        //fix date
        $realTimePublishedAt = substr($request->published_at , 0 , 10);
        $inputs['published_at'] = date('Y/m/d H:i:s',(int)$realTimePublishedAt);

        $product->update($inputs);
        $metas = array_combine($request->meta_key , $request->meta_value);
        $product->metas()->delete();
        foreach($metas as $key => $value){
            ProductMeta::create([
                'meta_key' => $key,
                'meta_value' => $value,
                'product_id' => $product->id
            ]);
        }
        return response()->json([
            'product' =>$product->where('id' , $product->id)->with('metas')->first(),
            'status' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->metas()->delete();
        $product->delete();
        return response()->json([
            'msg' => 'محصول شما با موفقیت حذف شد',
            'status' => true,
        ]);
    }

    public function getProduct($number)
    {
        $products = Product::where('status' , 1)->where('marketable' , 1)->orderBy('created_at' , 'desc')->take($number)->with('metas')->get();
        return response()->json([
            'products' => $products,
            'status' => true
        ]);
    }

    public function statua(Product $product)
    {
        $product->statua == 0 ? $product->statua = 1 : $product->statua = 0;
        $product->save();
        return response()->json([
            'msg' => 'عملیات با موفقیت انجام شد',
            'status' => true,
        ]);
    }
}

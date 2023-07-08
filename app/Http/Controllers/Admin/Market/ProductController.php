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

          /**
     * @OA\Get(
     *    path="/admin/product",
     *    operationId="product",
     *    tags={"Product"},
     *    summary="Get Products Detail",
     *    description="Get Products Detail",
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *          @OA\Property(property="status_code", type="integer", example="200"),
     *          @OA\Property(property="data",type="object")
     *           ),
     *        )
     *       )
     *  )
     */
    public function index()
    {
        $products = Product::where('status' , 1)->where('marketable' , 1)->orderBy('created_at' , 'desc')->paginate(15);

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
   /**
     * @OA\Post(
     *      path="/admin/product/store",
     *      operationId="Productstore",
     *      tags={"Product"},
     *      summary="Store Product in DB",
     *      description="Store Product in DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "introduction" , "image", "status" , "tags" , "price", "brand_id" , "category_id" , "published_at"},
     *            @OA\Property(property="name", type="string", format="string", example="Test Product name"),
     *            @OA\Property(property="introduction", type="string", format="string", example="Test Product introduction"),
     *            @OA\Property(property="image", type="string", format="string", example="Test Product image"),
     *            @OA\Property(property="tags", type="string", format="string", example="Test Product tags"),
     *            @OA\Property(property="price", type="integer", format="integer", example="14,500,000"),
     *            @OA\Property(property="status", type="integer", format="integer", example="0 Or 1"),
     *            @OA\Property(property="brand_id", type="integer", format="integer", example="brand ID"),
     *            @OA\Property(property="category_id", type="integer", format="integer", example="Category ID"),
     *            @OA\Property(property="published_at", type="integer", format="integer", example="published_at"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
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

            /**
     * @OA\Get(
     *    path="/admin/product/show/{product}",
     *    operationId="Productshow",
     *    tags={"Product"},
     *    summary="Get Product Detail",
     *    description="Get Product Detail",
     *    @OA\Parameter(name="product", in="path", description="Id of Product", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *          @OA\Property(property="status_code", type="integer", example="200"),
     *          @OA\Property(property="data",type="object")
     *           ),
     *        )
     *       )
     *  )
     */
    public function show($product)
    {
        $prd = Product::where('id' , $product)->with('metas')->first();
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
    /**
     * @OA\Put(
     *     path="/admin/product/update/{product}",
     *     operationId="productUpdate",
     *     tags={"Product"},
     *     summary="Update Prorduct in DB",
     *     description="Update Prorduct in DB",
     *     @OA\Parameter(name="product", in="path", description="Id of product", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "introduction" , "image", "status" , "tags" , "price", "brand_id" , "category_id" , "published_at"},
     *            @OA\Property(property="name", type="string", format="string", example="Test Product name"),
     *            @OA\Property(property="introduction", type="string", format="string", example="Test Product introduction"),
     *            @OA\Property(property="image", type="string", format="string", example="Test Product image"),
     *            @OA\Property(property="tags", type="string", format="string", example="Test Product tags"),
     *            @OA\Property(property="price", type="integer", format="integer", example="14,500,000"),
     *            @OA\Property(property="status", type="integer", format="integer", example="0 Or 1"),
     *            @OA\Property(property="brand_id", type="integer", format="integer", example="brand ID"),
     *            @OA\Property(property="category_id", type="integer", format="integer", example="Category ID"),
     *            @OA\Property(property="published_at", type="integer", format="integer", example="published_at"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status_code", type="integer", example="200"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
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

        /**
     * @OA\Delete(
     *    path="/admin/product/destroy/{product}",
     *    operationId="productDestroy",
     *    tags={"Product"},
     *    summary="Delete Product",
     *    description="Delete Product",
     *    @OA\Parameter(name="product", in="path", description="Id of Product", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="200"),
     *         @OA\Property(property="data",type="object")
     *          ),
     *       )
     *      )
     *  )
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
            /**
     * @OA\Get(
     *    path="/admin/product/get-product/{number}",
     *    operationId="get-product",
     *    tags={"Product"},
     *    summary="Get Any Product Detail",
     *    description="Get Any Product Detail",
     *    @OA\Parameter(name="number", in="path", description="Id of Product Category", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *          @OA\Property(property="status_code", type="integer", example="200"),
     *          @OA\Property(property="data",type="object")
     *           ),
     *        )
     *       )
     *  )
     */
    public function getProduct($number)
    {
        $products = Product::where('status' , 1)->where('marketable' , 1)->orderBy('created_at' , 'desc')->take($number)->with('metas')->get();
        return response()->json([
            'products' => $products,
            'status' => true
        ]);
    }
         /**
     * @OA\Get(
     *    path="/admin/product/status/{product}",
     *    operationId="productStatus",
     *    tags={"Product"},
     *    summary="Change Status",
     *    description="Change Status",
     *    @OA\Parameter(name="product", in="path", description="Id of Product", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *          @OA\Property(property="status_code", type="integer", example="200"),
     *          @OA\Property(property="data",type="object")
     *           ),
     *        )
     *       )
     *  )
     */
    public function status(Product $product)
    {
        $product->status == 0 ? $product->status = 1 : $product->status = 0;
        $product->save();
        return response()->json([
            'msg' => 'عملیات با موفقیت انجام شد',
            'status' => true,
        ]);
    }
}

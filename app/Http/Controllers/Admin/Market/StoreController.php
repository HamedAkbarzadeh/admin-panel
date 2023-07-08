<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AddStoreRequest;
use App\Http\Requests\Admin\Market\UpdateStoreRequest;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
                    /**
     * @OA\Get(
     *    path="/admin/store",
     *    operationId="storeIndex",
     *    tags={"Store"},
     *    summary="Get Store Detail",
     *    description="Get Store Detail",
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
        $products = Product::where('status' , 1)->orderBy('created_at' , 'desc')->get();
        return response()->json([
            'products' => $products,
            'status' => true,
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
     *      path="/admin/store/store/{product}",
     *      operationId="storeStore",
     *      tags={"Store"},
     *      summary="Store product_marketable in DB",
     *      description="Store product_marketable in DB",
     *      @OA\Parameter(name="product", in="path", description="Id of product", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"marketable_number", "receiver" , "delivery", "description"},
     *            @OA\Property(property="receiver", type="string", format="string", example="Alex"),
     *            @OA\Property(property="delivery", type="string", format="string", example="David"),
     *            @OA\Property(property="description", type="string", format="string", example="description"),
     *            @OA\Property(property="marketable_number", type="integer", format="integer", example="5"),
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
    public function store(AddStoreRequest $request , Product $product)
    {
        $product->marketable_number += $request->marketable_number;
        if($product->save()){
            Log::channel('store')->info([
                'receiver' => $request->receiver,
                'deliver' => $request->delivery,
                'description' => $request->description,
                'add' => $request->marketable_number,
                'product_name' => $product->name,
            ]);
        }
        return response()->json([
            'msg' => 'success save in log and increase marketable_number',
            'status' => true,
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
     *     path="/admin/store/update/{product}",
     *     operationId="storeUpdate",
     *     tags={"Store"},
     *     summary="Update Store in DB",
     *     description="Update Store in DB",
     *     @OA\Parameter(name="product", in="path", description="Id of product", required=true,
     *         @OA\Schema(type="integer")
     *     ),

     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"marketable_number", "receiver" , "delivery", "description"},
     *            @OA\Property(property="receiver", type="string", format="string", example="Alex"),
     *            @OA\Property(property="delivery", type="string", format="string", example="David"),
     *            @OA\Property(property="description", type="string", format="string", example="description"),
     *            @OA\Property(property="marketable_number", type="integer", format="integer", example="5"),
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
    public function update(UpdateStoreRequest $request, Product $product)
    {
        $product->marketable_number = $request->marketable_number;
        $product->sold_number = $request->sold_number;
        $product->frozen_number = $request->frozen_number;
        $product->save();

        return response()->json([
            'product' => $product,
            'status' => true,
        ]);
    }

    //custom
                    /**
     * @OA\Get(
     *    path="/admin/store/get-store/{number}",
     *    operationId="storeShow",
     *    tags={"Store"},
     *    summary="Get Store Detail",
     *    description="Get Store Detail",
     *    @OA\Parameter(name="number", in="path", description="Id of brand", required=true,
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
    public function getStore($number)
    {
        $products = Product::where('status' , 1)->orderBy('created_at' , 'desc')->take($number)->get();
        return response()->json([
            'products' => $products,
            'status' => true
        ]);
    }
}

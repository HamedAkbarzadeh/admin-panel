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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json([
            'product' => $product,
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

    public function getStore($number)
    {
        $products = Product::where('status' , 1)->orderBy('created_at' , 'desc')->take($number)->get();
        return response()->json([
            'products' => $products,
            'status' => true
        ]);
    }
}

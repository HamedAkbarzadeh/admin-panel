<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\BrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::where('status' , 1)->get();
        return response()->json([
            'brands' => $brands,
            'status' => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $inputs = $request->all();
        $brand = Brand::create($inputs);

        return response()->json([
            'brand' => $brand,
            'status' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return response()->json([
            'brand' => $brand,
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
    public function update(BrandRequest $request, Brand $brand)
    {
        $inputs = $request->all();
        $brand->update($inputs);

        return response()->json([
            'brand' => $brand,
            'status' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json([
            'msg' => 'برند شما با موفقیت حذف شد',
            'status' => true,
        ]);
    }


    //custom
    public function getBrand($number)
    {
        $brands = Brand::where('status' , 1)->orderBy('created_at' , 'desc')->take($number)->get();
        return response()->json([
            'brands' => $brands,
            'status' => true
        ]);
    }

    public function statua(Brand $brand)
    {
        $brand->statua == 0 ? $brand->statua = 1 : $brand->statua = 0;
        $brand->save();
        return response()->json([
            'msg' => 'عملیات با موفقیت انجام شد',
            'status' => true,
        ]);
    }
}

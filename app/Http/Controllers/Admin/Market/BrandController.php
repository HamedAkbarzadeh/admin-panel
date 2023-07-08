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

              /**
     * @OA\Get(
     *    path="/admin/brand",
     *    operationId="get-brand",
     *    tags={"Brand"},
     *    summary="Get Brands Detail",
     *    description="Get Brands Detail",

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
       /**
     * @OA\Post(
     *      path="/admin/brand/store",
     *      operationId="brandStore",
     *      tags={"Brand"},
     *      summary="Store Brand in DB",
     *      description="Store Brand in DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"persian_name", "original_name" , "logo", "status" , "tags"},
     *            @OA\Property(property="persian_name", type="string", format="string", example="Test persian_name"),
     *            @OA\Property(property="original_name", type="string", format="string", example="Test original_name"),
     *            @OA\Property(property="logo", type="string", format="string", example="Test logo"),
     *            @OA\Property(property="status", type="integer", format="integer", example="0 Or 1"),
     *            @OA\Property(property="tags", type="string", format="string", example="Test tags"),
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
                /**
     * @OA\Get(
     *    path="/admin/brand/show/{brand}",
     *    operationId="brandshow",
     *    tags={"Brand"},
     *    summary="Get Brand Detail",
     *    description="Get Brand Detail",
     *    @OA\Parameter(name="brand", in="path", description="Id of brand", required=true,
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
           /**
     * @OA\Put(
     *     path="/admin/brand/update/{brand}",
     *     operationId="brandUpdate",
     *     tags={"Brand"},
     *     summary="Update Brand in DB",
     *     description="Update Brand in DB",
     *     @OA\Parameter(name="brand", in="path", description="Id of Article", required=true,
     *         @OA\Schema(type="integer")
     *     ),

     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"persian_name", "original_name" , "logo", "status" , "tags"},
     *            @OA\Property(property="persian_name", type="string", format="string", example="Test persian_name"),
     *            @OA\Property(property="original_name", type="string", format="string", example="Test original_name"),
     *            @OA\Property(property="logo", type="string", format="string", example="Test logo"),
     *            @OA\Property(property="status", type="integer", format="integer", example="0 Or 1"),
     *            @OA\Property(property="tags", type="string", format="string", example="Test tags"),
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
    /**
 * @OA\Delete(
 *    path="/admin/brand/destroy/{brand}",
 *    operationId="brandDestroy",
 *    tags={"Brand"},
 *    summary="Delete Brand",
 *    description="Delete Brand",
 *    @OA\Parameter(name="brand", in="path", description="Id of Product Category", required=true,
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
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json([
            'msg' => 'برند شما با موفقیت حذف شد',
            'status' => true,
        ]);
    }


    //custom
                /**
     * @OA\Get(
     *    path="/admin/brand/get-brand/{number}",
     *    operationId="brandNumber",
     *    tags={"Brand"},
     *    summary="Get Any Brand Detail",
     *    description="Get Any Brand Detail",
     *    @OA\Parameter(name="number", in="path", description="number", required=true,
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
    public function getBrand($number)
    {
        $brands = Brand::where('status' , 1)->orderBy('created_at' , 'desc')->take($number)->get();
        return response()->json([
            'brands' => $brands,
            'status' => true
        ]);
    }
                /**
     * @OA\Get(
     *    path="/admin/brand/status/{brand}",
     *    operationId="brandStatus",
     *    tags={"Brand"},
     *    summary="Change Status",
     *    description="Change Status",
     *    @OA\Parameter(name="brand", in="path", description="Id of Brand", required=true,
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
    public function status(Brand $brand)
    {
        $brand->status == 0 ? $brand->status = 1 : $brand->status = 0;
        $brand->save();
        return response()->json([
            'msg' => 'عملیات با موفقیت انجام شد',
            'status' => true,
        ]);
    }
}

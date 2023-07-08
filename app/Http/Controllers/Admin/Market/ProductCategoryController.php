<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductCategoryRequest;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;



class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *    path="/admin/product-category",
     *    tags={"Product Category"},
     *    summary="Get Product Categories Detail",
     *    description="Get Product Categories Detail",

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
        $categories = ProductCategory::where([['status' , 1] , ['show_in_menu' , 1]])->with(['children' , 'parent'])->get();
        return response()->json([
            'categories'=> $categories,
            'status' => true,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

         /**
     * @OA\Get(
     *    path="/admin/product-category/show/{productCategory}",
     *    operationId="Categoryshow",
     *    tags={"Product Category"},
     *    summary="Get Product Category Detail",
     *    description="Get Product Category Detail",
     *    @OA\Parameter(name="productCategory", in="path", description="Id of Product Category", required=true,
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
    public function show($productCategory)
    {
        $category = ProductCategory::where('id' , $productCategory)->with(['children' , 'parent'])->first();
        return response()->json([
            'category' => $category,
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
     *      path="/admin/product-category/store",
     *      operationId="store",
     *      tags={"Product Category"},
     *      summary="Store Product Category in DB",
     *      description="Store Product Category in DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "description" , "show_in_menu", "status" , "tags" , "parent_id"},
     *            @OA\Property(property="name", type="string", format="string", example="Test Category name"),
     *            @OA\Property(property="description", type="string", format="string", example="Test Category description"),
     *            @OA\Property(property="image", type="string", format="string", example="Test Category image (OPT)"),
     *            @OA\Property(property="show_in_menu", type="integer", format="integer", example="0 Or 1"),
     *            @OA\Property(property="status", type="integer", format="integer", example="0 Or 1"),
     *            @OA\Property(property="parent_id", type="integer", format="integer", example="Parent ID Category"),
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

    public function store(ProductCategoryRequest $request)
    {
        $inputs = $request->all();
        $category = ProductCategory::create($inputs);
        return response()->json([
            'category' => $category,
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
     *     path="/admin/product-category/update/{productCategory}",
     *     operationId="update",
     *     tags={"Product Category"},
     *     summary="Update Prorduct Category in DB",
     *     description="Update Prorduct Category in DB",
     *     @OA\Parameter(name="productCategory", in="path", description="Id of Article", required=true,
     *         @OA\Schema(type="integer")
     *     ),

     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "description" , "show_in_menu", "status" , "tags" , "parent_id"},
     *            @OA\Property(property="name", type="string", format="string", example="Test Category name"),
     *            @OA\Property(property="description", type="string", format="string", example="Test Category description"),
     *            @OA\Property(property="image", type="string", format="string", example="Test Category image (OPT)"),
     *            @OA\Property(property="show_in_menu", type="integer", format="integer", example="0 Or 1"),
     *            @OA\Property(property="status", type="integer", format="integer", example="0 Or 1"),
     *            @OA\Property(property="parent_id", type="integer", format="integer", example="Parent ID Category"),
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

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $inputs = $request->all();
        $inputs['slug'] = null;
        $result = $productCategory->update($inputs);
        $notification = [
            'category' => $productCategory,
            'status' => true,
        ];
        return response()->json($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        /**
     * @OA\Delete(
     *    path="/admin/product-category/destroy/{productCategory}",
     *    operationId="destroy",
     *    tags={"Product Category"},
     *    summary="Delete Product Category",
     *    description="Delete Product Category",
     *    @OA\Parameter(name="productCategory", in="path", description="Id of Product Category", required=true,
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

    public function destroy(ProductCategory $productCategory)
    {
        if($productCategory->children()->count()){
            $productCategory->children()->delete();
        }
        $productCategory->delete();
        return response()->json([
            'msg' => 'دسته بندی شما با موفقیت حذف شد',
            'status' => true,
        ]);
    }

     /**
     * @OA\Get(
     *    path="/admin/product-category/parent/{productCategory}",
     *    operationId="parent",
     *    tags={"Product Category"},
     *    summary="Get Product Category Parent Detail",
     *    description="Get Product Category Parent Detail",
     *    @OA\Parameter(name="productCategory", in="path", description="Id of Product Category", required=true,
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
    public function parent(ProductCategory $productCategory)
{
    if($productCategory->parent_id != null && $productCategory->parent()->count()){
        $status = true;
        $category = $productCategory->parent()->first();
    }else{
        $status = false;
        $category = null;
    }
    return response()->json([
        'category' => $category,
        'status' => $status,
    ]);
}

     /**
     * @OA\Get(
     *    path="/admin/product-category/children/{productCategory}",
     *    operationId="children",
     *    tags={"Product Category"},
     *    summary="Get Product Category Children Detail",
     *    description="Get Product Category Children Detail",
     *    @OA\Parameter(name="productCategory", in="path", description="Id of Product Category", required=true,
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
public function children(ProductCategory $productCategory)
{


    if($productCategory->children()->count()){
        $categories = $productCategory->children()->get();
        $status = true;
    }else{
        $categories = null;
        $status = false;
    }
    return response()->json([
        'categories' => $categories,
        'status' => $status,
    ]);
}

     /**
     * @OA\Get(
     *    path="/admin/product-category/get-category/{number}",
     *    operationId="getCategory",
     *    tags={"Product Category"},
     *    summary="Get Any Product Categories Detail",
     *    description="Get Any Product Categories Detail",
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
public function getCategory($number)
{
    $categories = ProductCategory::where('status' , 1)->where('show_in_menu' , 1)->with(['children' , 'parent'])->orderBy('created_at', 'DESC')->take($number)->get();
    return response()->json([
        'categories' => $categories,
        'status' => true,
    ]);
}

     /**
     * @OA\Get(
     *    path="/admin/product-category/status/{productCategory}",
     *    operationId="status",
     *    tags={"Product Category"},
     *    summary="Change Status",
     *    description="Change Status",
     *    @OA\Parameter(name="productCategory", in="path", description="Id of Product Category", required=true,
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
public function status(ProductCategory $productCategory)
{
    $productCategory->status == 0 ? $productCategory->status = 1 : $productCategory->status = 0;
    $productCategory->save();
    return response()->json([
        'msg' => 'عملیات با موفقیت انجام شد',
        'status' => true,
    ]);
}
}

/// custom api



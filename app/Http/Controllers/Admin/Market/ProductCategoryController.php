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

public function getCategory($number)
{
    $categories = ProductCategory::where('status' , 1)->where('show_in_menu' , 1)->with(['children' , 'parent'])->orderBy('created_at', 'DESC')->take($number)->get();
    return response()->json([
        'categories' => $categories,
        'status' => true,
    ]);
}


public function statua(ProductCategory $productCategory)
{
    $productCategory->statua == 0 ? $productCategory->statua = 1 : $productCategory->statua = 0;
    $productCategory->save();
    return response()->json([
        'msg' => 'عملیات با موفقیت انجام شد',
        'status' => true,
    ]);
}
}

/// custom api



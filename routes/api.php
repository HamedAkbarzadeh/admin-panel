<?php

use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\CommentController;
use App\Http\Controllers\Admin\Market\CopanController;
use App\Http\Controllers\Admin\Market\OrderController;
use App\Http\Controllers\Admin\Market\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Market\ProductCategoryController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Market\StoreController;
use App\Models\Market\ProductCategory;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/////////////// Admin Panel ///////////////
Route::prefix('admin')->group(function(){
    ///// Market /////

/// Product-category ///
Route::prefix('product-category')->group(function () {
    Route::get('/' , [ProductCategoryController::class , 'index'])->name('admin.market.product-category');
    Route::get('/show/{productCategory}' , [ProductCategoryController::class , 'show'])->name('admin.market.product-category.show')->where('productCategory' , '[0-9]+');
    Route::post('/store' , [ProductCategoryController::class , 'store'])->name('admin.market.product-category.store');
    Route::put('/update/{productCategory}' , [ProductCategoryController::class , 'update'])->name('admin.market.product-category.put');
    Route::delete('/destroy/{productCategory}' , [ProductCategoryController::class , 'destroy'])->name('admin.market.product-category.destroy');
    Route::get('/status/{productCategory}' , [ProductCategoryController::class , 'status'])->name('admin.market.product-category.status')->where('productCategory' , '[0-1]');
    //custom
    Route::get('/parent/{productCategory}' , [ProductCategoryController::class , 'parent'])->name('admin.market.product-category.parent');
    Route::get('/children/{productCategory}' , [ProductCategoryController::class , 'children'])->name('admin.market.product-category.children')->where('productCategory' , '[0-9]+');
    Route::get('/get-category/{number}' , [ProductCategoryController::class , 'getCategory'])->name('admin.market.product-category.get-category')->where('number' , '[0-9]+');
});

// brand //
Route::prefix('brand')->group(function () {
    Route::get('/' , [BrandController::class , 'index'])->name('admin.market.brand');
    Route::get('/show/{brand}' , [BrandController::class , 'show'])->name('admin.market.brand.show')->where('brand' , '[0-9]+');
    Route::post('/store' , [BrandController::class , 'store'])->name('admin.market.brand.store');
    Route::put('/update/{brand}' , [BrandController::class , 'update'])->name('admin.market.brand.put');
    Route::delete('/destroy/{brand}' , [BrandController::class , 'destroy'])->name('admin.market.brand.destroy');
    Route::get('/status/{brand}' , [BrandController::class , 'status'])->name('admin.market.brand.status')->where('brand' , '[0-1]');
    //custom
    Route::get('/get-brand/{number}' , [BrandController::class , 'getBrand'])->name('admin.market.brand.get-brand')->where('number' , '[0-9]+');
});

/// product ///
Route::prefix('product')->group(function(){
    Route::get('/' , [ProductController::class , 'index'])->name('admin.market.product');
    Route::get('/show/{product}' , [ProductController::class , 'show'])->name('admin.market.product.show')->where('product' , '[0-9]+');
    Route::post('/store' , [ProductController::class , 'store'])->name('admin.market.product.store');
    Route::put('/update/{product}' , [ProductController::class , 'update'])->name('admin.market.product.put');
    Route::delete('/destroy/{product}' , [ProductController::class , 'destroy'])->name('admin.market.product.destroy');
    //custom
    Route::get('/status/{product}' , [ProductController::class , 'status'])->name('admin.market.store.status')->where('product' , '[0-1]');
    Route::get('/get-product/{number}' , [ProductController::class , 'getProduct'])->name('admin.market.product.get-product')->where('number' , '[0-9]+');
});

/// store ///
Route::prefix('store')->group(function(){
    Route::get('/' , [StoreController::class , 'index'])->name('admin.market.store');
    Route::get('/show/{product}' , [StoreController::class , 'show'])->name('admin.market.store.show')->where('product' , '[0-9]+');
    Route::post('/store/{product}' , [StoreController::class , 'store'])->name('admin.market.store.store');
    Route::put('/update/{product}' , [StoreController::class , 'update'])->name('admin.market.store.put');
    //custom
    Route::get('/get-store/{number}' , [StoreController::class , 'getStore'])->name('admin.market.store.get-store')->where('number' , '[0-9]+');
});

/// comment /// //check after authentication
Route::prefix('comment')->group(function(){
    Route::get('/' , [CommentController::class , 'index'])->name('admin.market.comment');
    Route::get('/show/{comment}' , [CommentController::class , 'show'])->name('admin.market.comment.show')->where('comment' , '[0-9]+');
    Route::get('/approved/{comment}' , [CommentController::class , 'approved'])->name('admin.market.comment.approved')->where('comment' , '[0-9]+');
    Route::post('/answer/{comment}' , [CommentController::class , 'answer'])->name('admin.market.comment.answer');
    Route::get('/status/{comment}' , [CommentController::class , 'status'])->name('admin.market.comment.status')->where('comment' , '[0-1]');
});

    //order
    Route::prefix('order')->group(function(){
        Route::get('/', [OrderController::class, 'all'])->name('admin.market.order.all');
        Route::get('/new-order', [OrderController::class, 'newOrders'])->name('admin.market.order.newOrders');
        Route::get('/sending', [OrderController::class, 'sending'])->name('admin.market.order.sending');
        Route::get('/unpaid', [OrderController::class, 'unpaid'])->name('admin.market.order.unpaid');
        Route::get('/canceled', [OrderController::class, 'canceled'])->name('admin.market.order.canceled');
        Route::get('/returned', [OrderController::class, 'returned'])->name('admin.market.order.returned');
        Route::get('/show/{order}', [OrderController::class, 'show'])->name('admin.market.order.show');
        Route::get('/show-item/{order}', [OrderController::class, 'showItem'])->name('admin.market.order.showItem');
        Route::get('/change-send-status/{order}', [OrderController::class, 'changeSendStatus'])->name('admin.market.order.changeSendStatus');
        Route::get('/change-order-status/{order}', [OrderController::class, 'changeOrderStatus'])->name('admin.market.order.changeOrderStatus');
        Route::get('/cancel-order/{order}', [OrderController::class, 'cancelOrder'])->name('admin.market.order.cancelOrder');
    });

    //payment
    Route::prefix('payment')->group(function () {
        Route::get('/' , [PaymentController::class , 'index'])->name('admin.market.payment');
        Route::get('/online' , [PaymentController::class , 'online'])->name('admin.market.payment.online');
        Route::get('/offline' , [PaymentController::class , 'offline'])->name('admin.market.payment.offline');
        Route::get('/attendance' , [PaymentController::class , 'attendance'])->name('admin.market.payment.attendance');
        Route::get('/show/{payment}' , [PaymentController::class , 'show'])->name('admin.market.payment.show');

        //status
        Route::get('/confirm/{payment}' , [PaymentController::class , 'confirm'])->name('admin.market.payment.confirm');
        Route::get('/NotConfirm/{payment}' , [PaymentController::class , 'NotConfirm'])->name('admin.market.payment.NotConfirm');
        Route::get('/return/{payment}' , [PaymentController::class , 'return'])->name('admin.market.payment.return');
        Route::get('/cancel/{payment}' , [PaymentController::class , 'cancel'])->name('admin.market.payment.cancel');
    });

    //discount
    Route::prefix('discount')->group(function () {

        //copon
        Route::prefix('copon')->group(function () {
            Route::get('/' , [CopanController::class , 'index'])->name('admin.market.discount.index');
            Route::post('/store' , [CopanController::class , 'store'])->name('admin.market.discount.store');
        });
    });
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

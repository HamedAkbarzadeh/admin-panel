<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Market\Payment;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
         /**
     * @OA\Get(
     *    path="/admin/dashboard",
     *    operationId="index",
     *    tags={"Admin Dashboard"},
     *    summary="Get Dashboard Detail",
     *    description="Get Dashboard Detail",
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
    public function index(){
        $users = User::where('user_type' , 0)->count();
        $admins = User::where('user_type' , 1)->count();
        $products = Product::where('status' , 1)->count();
        $offlinePayment = Payment::where('type' , 1)->count();
        $onlinePayment = Payment::where('type' , 0)->count();

        $orders = Order::where('order_status' , 2)->get();
        $allPrice = 0;
        foreach($orders as $order){
            $allPrice += $order->order_final_amount;
        }
        return response()->json([
            "usersCount" => $users,
            "adminsCount" => $admins,
            "products" => $products,
            "offlinePayment" => $offlinePayment,
            "onlinePayment" => $onlinePayment,
            "totalRevenue" => $allPrice
        ]);
    }
}

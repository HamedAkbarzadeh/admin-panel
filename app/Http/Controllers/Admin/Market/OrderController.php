<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
     /**
     * @OA\Get(
     *    path="/admin/order/new-order",
     *    operationId="newOrder",
     *    tags={"Order"},
     *    summary="Get all new orders Detail",
     *    description="Get all new orders Detail",

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
    public function newOrders()
    {
        $yesterday = date("Y-m-d", strtotime( '-2 days' ) );
        $orders = Order::whereDate('created_at' , '>' , $yesterday )->orderBy('created_at' , 'desc')->simplePaginate(15);
        return response()->json([
            'orders' => $orders,
            'status' => true,
        ]);
    }
         /**
     * @OA\Get(
     *    path="/admin/sending",
     *    operationId="seningOrder",
     *    tags={"Order"},
     *    summary="Get all sending orders Detail",
     *    description="Get all sending orders Detail",

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
    public function sending()
    {
        $orders = Order::where('delivery_status', 1)->orderBy('created_at' , 'desc')->simplePaginate(15);
        return response()->json([
            'orders' => $orders,
            'status' => true,
        ]);
    }
         /**
     * @OA\Get(
     *    path="/admin/unpaid",
     *    operationId="unpaidOrder",
     *    tags={"Order"},
     *    summary="Get all unpaid orders Detail",
     *    description="Get all unpaid orders Detail",

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
    public function unpaid()
    {
        $orders = Order::where('payment_status', 0)->get();
        return response()->json([
            'orders' => $orders,
            'status' => true,
        ]);
        }
                 /**
     * @OA\Get(
     *    path="/admin/canceled",
     *    operationId="canceledOrder",
     *    tags={"Order"},
     *    summary="Get all canceled orders Detail",
     *    description="Get all canceled orders Detail",

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
    public function canceled()
    {
        $orders = Order::where('order_status', 4)->orderBy('created_at' , 'desc')->simplePaginate(15);
        return response()->json([
            'orders' => $orders,
            'status' => true,
        ]);
        }
                         /**
     * @OA\Get(
     *    path="/admin/returned",
     *    operationId="returnedOrder",
     *    tags={"Order"},
     *    summary="Get all returned orders Detail",
     *    description="Get all returned orders Detail",

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
    public function returned()
    {
        $orders = Order::where('order_status', 5)->orderBy('created_at' , 'desc')->simplePaginate(15);
        return response()->json([
            'orders' => $orders,
            'status' => true,
        ]);
    }
         /**
     * @OA\Get(
     *    path="/admin/order",
     *    operationId="allOrder",
     *    tags={"Order"},
     *    summary="Get all orders Detail",
     *    description="Get all orders Detail",

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
    public function all()
    {
        $orders = Order::orderBy('created_at' , 'desc')->simplePaginate(15);
        return response()->json([
            'orders' => $orders,
            'status' => true,
        ]);
    }
                    /**
     * @OA\Get(
     *    path="/admin/order/show/{order}",
     *    operationId="orderShow",
     *    tags={"Order"},
     *    summary="show order Detail",
     *    description="show order Detail",
     *    @OA\Parameter(name="order", in="path", description="Id of order", required=true,
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
    public function show(Order $order)
    {
        return response()->json([
            'order' => $order,
            'status' => true,
        ]);
      }
                         /**
     * @OA\Get(
     *    path="/admin/order/show-item/{order}",
     *    operationId="orderShowItem",
     *    tags={"Order"},
     *    summary="show item order Detail",
     *    description="show item order Detail",
     *    @OA\Parameter(name="order", in="path", description="Id of order", required=true,
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
    public function showItem(Order $order)
    {
        return response()->json([
            'order' => $order,
            'status' => true,
        ]);
    }
                                 /**
     * @OA\Get(
     *    path="/admin/order/change-send-status/{order}",
     *    operationId="changeSendStatusItem",
     *    tags={"Order"},
     *    summary="change send status",
     *    description="change send status",
     *    @OA\Parameter(name="order", in="path", description="Id of order", required=true,
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
    public function changeSendStatus(Order $order)
    {
        $order->delivery_status += 1;
        if($order->delivery_status == 4){
            $order->delivery_status = 0;
        }
        $order->save();
        return response()->json([
            'msg' => 'وضعیت با موفقیت تغییر کرد .',
            'status' => true,
        ]);
    }
                                   /**
     * @OA\Get(
     *    path="/admin/order/change-order-status/{order}",
     *    operationId="changeOrderStatusItem",
     *    tags={"Order"},
     *    summary="change order status",
     *    description="change order status",
     *    @OA\Parameter(name="order", in="path", description="Id of order", required=true,
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
    public function changeOrderStatus(Order $order)
    {
        $order->order_status += 1;
        if($order->order_status == 5){
            $order->order_status = 0;
        }
        $order->save();
        return response()->json([
            'msg' => 'وضعیت با موفقیت تغییر کرد .',
            'status' => true,
        ]);
        }

    // public function cancelOrder()
    // {
    //     return response()->json([
    //         'msg' => 'درخواست شما انجام شد .',
    //         'status' => true,
    //     ]);
    //     }
}

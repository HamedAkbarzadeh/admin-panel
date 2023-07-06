<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function newOrders()
    {
        $yesterday = date("Y-m-d", strtotime( '-2 days' ) );
        $orders = Order::whereDate('created_at' , '>' , $yesterday )->orderBy('created_at' , 'desc')->simplePaginate(15);
        return response()->json([
            'orders' => $orders,
            'status' => true,
        ]);
    }
    public function sending()
    {
        $orders = Order::where('delivery_status', 1)->orderBy('created_at' , 'desc')->simplePaginate(15);
        return response()->json([
            'orders' => $orders,
            'status' => true,
        ]);    }
    public function unpaid()
    {
        $orders = Order::where('payment_status', 0)->get();
        return response()->json([
            'orders' => $orders,
            'status' => true,
        ]);    }
    public function canceled()
    {
        $orders = Order::where('order_status', 4)->orderBy('created_at' , 'desc')->simplePaginate(15);
        return response()->json([
            'orders' => $orders,
            'status' => true,
        ]);    }
    public function returned()
    {
        $orders = Order::where('order_status', 5)->orderBy('created_at' , 'desc')->simplePaginate(15);
        return response()->json([
            'orders' => $orders,
            'status' => true,
        ]);    }
    public function all()
    {
        $orders = Order::orderBy('created_at' , 'desc')->simplePaginate(15);
        return response()->json([
            'orders' => $orders,
            'status' => true,
        ]);    }
    public function show(Order $order)
    {
        return response()->json([
            'order' => $order,
            'status' => true,
        ]);
      }
    public function showItem(Order $order)
    {
        return response()->json([
            'order' => $order,
            'status' => true,
        ]);    }
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
    public function cancelOrder()
    {
        return response()->json([
            'msg' => 'درخواست شما انجام شد .',
            'status' => true,
        ]);
        }
}

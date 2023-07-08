<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Market\PaymentCollection;
use App\Http\Resources\Admin\Market\PaymentResource;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
                                      /**
     * @OA\Get(
     *    path="/admin/payment",
     *    operationId="allPayment",
     *    tags={"Payment"},
     *    summary="get all payments status",
     *    description="get all payments status",
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
        $payments = new PaymentCollection(Payment::orderBy('created_at' , 'desc')->get());
        return response()->json([
            'payments' => $payments,
            'stauts' => true,
        ]);
    }
                                     /**
     * @OA\Get(
     *    path="/admin/payment/online",
     *    operationId="onlinePayment",
     *    tags={"Payment"},
     *    summary="get online payments status",
     *    description="get online payments status",
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
    public function online()
    {
        $payments = new PaymentCollection(Payment::where('type' , 0)->orderBy('created_at' , 'desc')->get());
        return response()->json([
            'payments' => $payments,
            'stauts' => true,
        ]);
    }
                                         /**
     * @OA\Get(
     *    path="/admin/offline",
     *    operationId="offlinePayment",
     *    tags={"Payment"},
     *    summary="get offline payments status",
     *    description="get offline payments status",
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
    public function offline()
    {
        $payments = new PaymentCollection(Payment::where('type' , 1)->orderBy('created_at' , 'desc')->get());
        return response()->json([
            'payments' => $payments,
            'stauts' => true,
        ]);
    }
                                         /**
     * @OA\Get(
     *    path="/admin/payment/attendance",
     *    operationId="attendancePayment",
     *    tags={"Payment"},
     *    summary="get attendance payments status",
     *    description="get attendance payments status",
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
    public function attendance()
    {
        $payments = new PaymentCollection(Payment::where('type' , 2)->orderBy('created_at' , 'desc')->get());
        return response()->json([
            'payments' => $payments,
            'stauts' => true,
        ]);
    }

                   /**
     * @OA\Get(
     *    path="/admin/payment/confirm/{payment}",
     *    operationId="paymentConfirm",
     *    tags={"Payment"},
     *    summary="confirm payment Detail",
     *    description="confirm Brand Detail",
     *    @OA\Parameter(name="payment", in="path", description="Id of payment", required=true,
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
    public function confirm(Payment $payment)
    {
        $payment->status = 1;
        $payment->save();
        return response('وضیعت کالا با موفقیت تغییر کرد .' , 200);
    }
    /**
     * @OA\Get(
     *    path="/admin/payment/cancel/{payment}",
     *    operationId="cancelConfirm",
     *    tags={"Payment"},
     *    summary="cancel payment Detail",
     *    description="cancel Brand Detail",
     *    @OA\Parameter(name="payment", in="path", description="Id of payment", required=true,
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
    public function cancel(Payment $payment)
    {
        $payment->status = 2;
        $payment->save();
        return response('وضیعت کالا با موفقیت تغییر کرد .' , 200);
    }
    /**
     * @OA\Get(
     *    path="/admin/payment/return/{payment}",
     *    operationId="returnConfirm",
     *    tags={"Payment"},
     *    summary="return payment Detail",
     *    description="return Brand Detail",
     *    @OA\Parameter(name="payment", in="path", description="Id of payment", required=true,
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
    public function return(Payment $payment)
    {
        $payment->status = 3;
        $payment->save();
        return response('وضیعت کالا با موفقیت تغییر کرد .' , 200);
    }
    /**
     * @OA\Get(
     *    path="/admin/payment/NotConfirm/{payment}",
     *    operationId="paymentNotConfirm",
     *    tags={"Payment"},
     *    summary="NotConfirm payment Detail",
     *    description="NotConfirm Brand Detail",
     *    @OA\Parameter(name="payment", in="path", description="Id of payment", required=true,
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
    public function NotConfirm(Payment $payment)
    {
        $payment->status = 0;
        $payment->save();
        return response('وضیعت کالا با موفقیت تغییر کرد .' , 200);
    }
                       /**
     * @OA\Get(
     *    path="/admin/payment/show/{payment}",
     *    operationId="paymentShow",
     *    tags={"Payment"},
     *    summary="show payment Detail",
     *    description="show Brand Detail",
     *    @OA\Parameter(name="payment", in="path", description="Id of payment", required=true,
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
    public function show(Payment $payment)
    {
        $payments = new PaymentResource(Payment::findOrFail($payment));
        return response()->json([
            'payments' => $payments
        ]);
    }

}

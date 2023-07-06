<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Market\PaymentCollection;
use App\Http\Resources\Admin\Market\PaymentResource;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = new PaymentCollection(Payment::orderBy('created_at' , 'desc')->get());
        return response()->json([
            'payments' => $payments,
            'stauts' => true,
        ]);
    }

    public function online()
    {
        $payments = new PaymentCollection(Payment::where('type' , 0)->orderBy('created_at' , 'desc')->get());
        return response()->json([
            'payments' => $payments,
            'stauts' => true,
        ]);
    }
    public function offline()
    {
        $payments = new PaymentCollection(Payment::where('type' , 1)->orderBy('created_at' , 'desc')->get());
        return response()->json([
            'payments' => $payments,
            'stauts' => true,
        ]);
    }
    public function attendance()
    {
        $payments = new PaymentCollection(Payment::where('type' , 2)->orderBy('created_at' , 'desc')->get());
        return response()->json([
            'payments' => $payments,
            'stauts' => true,
        ]);
    }

    public function confirm(Payment $payment)
    {
        $payment->status = 1;
        $payment->save();
        return response('وضیعت کالا با موفقیت تغییر کرد .' , 200);
    }
    public function cancel(Payment $payment)
    {
        $payment->status = 2;
        $payment->save();
        return response('وضیعت کالا با موفقیت تغییر کرد .' , 200);
    }
    public function return(Payment $payment)
    {
        $payment->status = 3;
        $payment->save();
        return response('وضیعت کالا با موفقیت تغییر کرد .' , 200);
    }
    public function NotConfirm(Payment $payment)
    {
        $payment->status = 0;
        $payment->save();
        return response('وضیعت کالا با موفقیت تغییر کرد .' , 200);
    }
    public function show(Payment $payment)
    {
        $payments = new PaymentResource(Payment::findOrFail($payment));
        return response()->json([
            'payments' => $payments
        ]);
    }

}

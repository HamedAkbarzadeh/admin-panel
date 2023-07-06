<?php

namespace App\Http\Resources\Admin\Market;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\Market\CashPaymentResource;
use App\Http\Resources\Admin\Market\OfflinePaymentResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'fullName' => $this->user->fullName,
            'type' => $this->type,
            'payment_type' => [
                'id' => $this->paymentable->id,
                'amount' => $this->paymentable->amount,
                'pay_date' => $this->paymentable->pay_date,
                'transaction_id' => $this->paymentable->transaction_id,
                //onlinePayment
                'getway' => $this->paymentable->getway,
                'bank_first_response' => $this->paymentable->bank_first_response,
                //cashPayment
                'cash_receiver' => $this->paymentable->cash_receiver,
            ]
        ];
    }
}

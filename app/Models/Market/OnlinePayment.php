<?php

namespace App\Models\market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function payments()
    {
        return $this->morphMany(Payment::class , 'paymentable');
    }
}

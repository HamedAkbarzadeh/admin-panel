<?php

namespace App\Models\market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflinePayment extends Model
{
    use HasFactory;

    protected $table = 'offline_payments';

    protected $guarded = ['id'];

    public function payments()
    {
        return $this->morphMany(Payment::class , 'paymentable');
    }
}

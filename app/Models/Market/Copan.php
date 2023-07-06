<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copan extends Model
{
    use HasFactory;

    protected $fillable = ['code' , 'amount' , 'amount_type' , 'discount_ceiling' , 'type' , 'status' , 'start_date' , 'end_date' , 'user_id'];


}

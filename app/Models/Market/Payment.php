<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];



    public function paymentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // protected static function boot()
    // {
    //     parent::boot();
    //     static::addGlobalScope('status' , function (Builder $builder)
    //     {
    //         $builder->where('status' , 1);
    //     });
    // }
}

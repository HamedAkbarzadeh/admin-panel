<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    use HasFactory;


    protected $table = 'product_meta';
    protected $guarded = ['id'];

      public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

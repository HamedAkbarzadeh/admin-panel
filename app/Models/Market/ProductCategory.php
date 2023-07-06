<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ProductCategory extends Model
{
    use HasFactory,Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    protected $guarded = ['id'];

    public function parent(){
        return $this->belongsTo($this, 'parent_id')->where('status' , 1)->with('parent');
    }
    public function children(){
        return $this->hasMany($this, 'parent_id')->where('status' , 1)->with('children');
    }
}

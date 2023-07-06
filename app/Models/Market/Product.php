<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory , Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    protected $guarded = ['id'];

    public function metas()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable');
    }
}

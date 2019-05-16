<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];

    public function featureds(){
        return $this->hasMany(Featured::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function product_skuses(){
        return $this->hasMany(ProductSkus::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

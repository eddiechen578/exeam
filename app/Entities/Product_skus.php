<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Product_skus extends Model
{
    public function product(){
        return $this->belongsTo(Product::class);
    }
}

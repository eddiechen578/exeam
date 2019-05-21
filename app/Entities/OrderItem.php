<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = [];
    protected $dates = ['reviewed_at'];
    public $timestamps = false;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function productSku(){
        return $this->belongsTo(ProductSkus::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}

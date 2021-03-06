<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function productSku(){
        return $this->belongsTo(ProductSkus::class);
    }
}

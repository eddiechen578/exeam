<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];

    public function featureds(){
        return $this->hasMany(Featured::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

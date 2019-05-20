<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use SoftDeletes;

    protected $guarded=[];

    protected $dates = ['deleted_at'];

    public function featureds(){
        return $this->hasMany(Featured::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function product_skuses(){
        return $this->hasMany(ProductSkus::class);
    }

    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageUrlAttribute(){

        return "/upload/product_".$this->id.'/'.$this->featureds[0]->name;
    }
}

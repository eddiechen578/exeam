<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductSkus extends Model
{
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function getImgNameAttribute(){
        return $this->product->featureds[0]->name;
    }

    public function getProductNameAttribute(){
        return $this->product->name;
    }

    public function getProductCategoryAttribute(){
        return $this->product->category->name;
    }

    public function getProductDescriptionAttribute(){
        return $this->product->description;
    }

    public function getOnSaleAttribute(){
        if($this->product->on_sale){
            return '是';
        }
        return '否';
    }


}

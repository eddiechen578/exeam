<?php

namespace App\Entities;

use App\Exceptions\InternalException;
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

    public function decreaseStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('減少的庫存量不可小於0');
        }
        return $this->newQuery()->where('id', $this->id)->where('stock', '>=', $amount)->decrement('stock', $amount);
    }

    public function addStock($amount)
    {
        if($amount < 0){
            throw new InternalException('增加庫存量不可小於0.');
        }
        $this->increment('stock', $amount);
    }

}

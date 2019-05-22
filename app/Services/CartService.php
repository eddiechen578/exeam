<?php
namespace App\Services;

use App\Entities\CartItem;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function get(){
        return Auth::user()->cartItems()->with(['productSku.product'])->get();
    }

    public function add($skuId, $amount){
        $user = Auth::user();

        if($item = $user->cartItems()->where('product_sku_id', $skuId)->first()){
            $item->update([
               'amount' => $item->amount + $amount
            ]);
        }else{
            $item = new CartItem(['amount' => $amount]);
            $item->user()->associate($user);
            $item->productSku()->associate($skuId);
            $item->save();
        }
    }
}
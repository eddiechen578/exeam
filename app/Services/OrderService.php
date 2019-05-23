<?php

namespace App\Services;

use App\Jobs\CloseOrder;
use Carbon\Carbon;
use App\User;
use App\Entities\Order;
use App\Entities\ProductSkus;
use App\Entities\UserAddress;
use App\Services\CartService;
use App\Exceptions\InvalidRequestException;

class OrderService{
    public function store(User $user, UserAddress $address, $remark, $items)
    {
        $order = \DB::transaction(function () use ($user, $address, $remark, $items) {

            $address->update(['last_used_at' => Carbon::now()]);

            $order = new Order([
                'address' => [ // 將地址信息放入訂單中
                    'address' => $address->full_address,
                    'zip_code' => $address->zip_code,
                    'contact_name' => $address->contact_name,
                    'contact_phone' => $address->contact_phone,
                ],
                'remark' => $remark,
                'total_amount' => 0,
            ]);
            $order->user()->associate($user);
            $order->save();

            $totalAmount = 0;

            foreach($items as $data){
                $sku = ProductSkus::find($data['sku_id']);

                $item = $order->orderItems()->make([
                   'amount' => $data['amount'],
                   'price'  => $sku->price
                ]);
                $item->product()->associate($sku->product_id);
                $item->productSku()->associate($sku);
                $item->save();
                $totalAmount += $sku->price * $data['amount'];
                if ($sku->decreaseStock($data['amount']) <= 0) {
                    throw new InvalidRequestException('該商品庫存不足');
                }
            }
            $order->update(['total_amount' => $totalAmount]);

            $skuIds = collect($items)->pluck('sku_id')->all();
            app(CartService::class)->remove($skuIds);

            return $order;
        });

        dispatch(new CloseOrder($order, 10 * 60));
        return $order;
    }
}
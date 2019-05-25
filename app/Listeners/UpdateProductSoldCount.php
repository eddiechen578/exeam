<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Entities\OrderItem;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateProductSoldCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderPaid  $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        $order = $event->getOrder();

        $order->load('orderItems.product');

        foreach ($order->orderItems as $item) {
            $product = $item->product;
            $soldCount = OrderItem::where('product_id', $product->id)
                ->where('order_id', $order->id)
                ->whereHas('order', function ($query){
                    $query->whereNotNull('paid_at');
                })->sum('amount');

            $remain = $product->sold_count;
            $soldCount= $remain + $soldCount;
            $product->update(['sold_count' => $soldCount]);
        }

    }
}

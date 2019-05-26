<?php

namespace App\Http\Controllers\Front;

use App\Entities\Order;
use App\Entities\OrderItem;
use App\Entities\UserAddress;
use App\Exceptions\InvalidRequestException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SendReviewRequest;
use App\Events\OrderReviewed;
use App\Http\Requests\ApplyRefundRequest;
use App\Events\OrderRefund;
use App\Notifications\OrderMadeNotification;
class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::with(['orderItems.product', 'orderItems.productSku'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate();
        return view('Front.order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request, OrderService $orderService)
    {
       $user = $request->user();
       $address = UserAddress::find($request->input('address_id'));
       $order = $orderService->store($user, $address, $request->input('remark'),$request->input('items'));
       $notifyOrder = Order::find($order->id);
       $user->notify(new OrderMadeNotification($notifyOrder));
       return $notifyOrder;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $this->authorize('own', $order);
        return view('Front.order.show', [
                'order' => $order->load(['orderItems.productSku', 'orderItems.product'])
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function review(Order $order)
    {
        $this->authorize('own', $order);

        if(!$order->paid_at)
        {
            throw new InvalidRequestException('該訂單未支付, 不可評價.');
        }

        return view('Front.order.review', [
            'order' => $order->load(['orderItems.productSku', 'orderItems.product'])
        ]);
    }

    public function sendReview(Order $order, SendReviewRequest $request){

        $this->authorize('own', $order);

        if ($order->reviewed) {
            throw new InvalidRequestException('該訂單已評價，不可重複提交');
        }

        $reviews = $request->input('reviews');

        DB::transaction(function () use ($reviews, $order){
                foreach($reviews as $review){
                    $orderItem = $order->orderItems()->find($review['id']);
                    $orderItem->update([
                        'rating' => $review['rating'],
                        'review' => $review['review'],
                        'reviewed_at' => Carbon::now(),
                    ]);
                }
                $order->update(['reviewed' => true]);
                event(new OrderReviewed($order));
        });

        return redirect()->back();
    }

    public function applyRefund(Order $order, ApplyRefundRequest $request){

        $this->authorize('own', $order);


        if (!$order->paid_at) {
            throw new InvalidRequestException('該訂單未支付，不可退款');
        }
        if ($order->refund_status !== Order::REFUND_STATUS_PENDING) {
            throw new InvalidRequestException('該訂單已經申請過退款，請勿重複申請');
        }

        $extra = $order->extra ? : [];
        $extra['refund_reason'] = $request->input('reason');

        $order->update([
            'refund_status' => Order::REFUND_STATUS_APPLIED,
            'extra' => $extra,
        ]);

        $order = $order->load('orderItems.product');
        foreach($order->orderItems as $item){
            $product = $item->product;
            $sku = $item->productSku;
            $amount = $item->amount;
            $sku->addStock($amount);
            $Count = OrderItem::where('product_id', $product->id)
                         ->where('order_id', $order->id)
                         ->whereHas('order', function ($query){
                            $query->whereNotNull('extra');
                         })->sum('amount');
            $remain_count = $product->sold_count;
            $soldCount = $remain_count - $Count;
            $product->update(['sold_count' => $soldCount]);
        }

        return $order;
    }
}

<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const REFUND_STATUS_PENDING = 'pending';
    const REFUND_STATUS_APPLIED = 'applied';
    const REFUND_STATUS_PROCESSING = 'processing';
    const REFUND_STATUS_SUCCESS = 'success';
    const REFUND_STATUS_FAILED = 'failed';

    const SHIP_STATUS_PENDING = 'pending';
    const SHIP_STATUS_DELIVERED = 'delivered';
    const SHIP_STATUS_RECEIVED = 'received';

    public static $refundStatusMap = [
        self::REFUND_STATUS_PENDING    => 'primary',
        self::REFUND_STATUS_APPLIED    => 'info',
        self::REFUND_STATUS_PROCESSING => 'warning',
        self::REFUND_STATUS_SUCCESS    => 'success',
        self::REFUND_STATUS_FAILED     => 'danger',
    ];

    public static $shipStatusMap = [
        self::SHIP_STATUS_PENDING   => 'primary',
        self::SHIP_STATUS_DELIVERED => 'danger',
        self::SHIP_STATUS_RECEIVED  => 'success',
    ];

    protected $guarded = [];

    protected $casts = [
        'closed'    => 'boolean',
        'reviewed'  => 'boolean',
        'address'   => 'json',
        'ship_data' => 'json',
        'extra'     => 'json',
    ];

    protected $dates = [
        'paid_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

}

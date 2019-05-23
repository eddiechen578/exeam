<?php

namespace App\Policies;

use App\User;
use App\Entities\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function own(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }
}

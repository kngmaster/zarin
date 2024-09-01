<?php

namespace App\Services\Action;
use App\Models\Order;
use App\Services\Interface\OrderRepositoryInterface;



class OrderRepository implements OrderRepositoryInterface
{
    public function order_follower_submit($quantity, $user_id){
        $order = Order::create([
            'user_id' => $user_id,
            'transaction_id' => null,
            'quantity' => $quantity,
            'status' => 0,
        ]);
        return $order;
    }
 
}
<?php

namespace App\Services\Action;
use App\Models\Order;
use App\Services\Interface\OrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class OrderRepository implements OrderRepositoryInterface
{
    public function order_follower($request){
        $order = Order::create([
            'user_id' => Auth::id(),
            'transaction_id' => null,
            'quantity' => $request->quantity,
            'status' => 0,
        ]);
        return $order;
    }
 
    public function order_list(){}

    public function pay_user(){}
}
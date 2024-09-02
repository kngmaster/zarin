<?php

namespace App\Services\Action;
use App\Models\Order;
use App\Models\Page;
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
 
    public function order_unfollow_list($request){
        $page = Page::where('status', 0)->paginate(10);
        return $page;
    }

    public function pay_user(){}
}
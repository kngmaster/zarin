<?php

namespace App\Services\Action;

use App\Models\Coin;
use App\Models\Order;
use App\Models\Page;
use App\Models\User;
use App\Services\Interface\OrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    public function order_follower($request)
    {
        $order = Order::create([
            'user_id' => Auth::id(),
            'transaction_id' => null,
            'quantity' => $request->quantity,
            'status' => 0,
        ]);
        return $order;
    }

    public function order_unfollow_list($request)
    {
        $page = Page::where('status', 0)->paginate(10);
        return $page;
    }

    public function follow_user($request)
    {
        DB::beginTransaction();
        try {
            $pages_id = $request->pages_id;
            $user = User::where('id', Auth::id())->first();

            $user->pages()->sync($pages_id);

            $page = DB::table('pages')
            ->whereIn('id', $pages_id)
            ->update(['status' => 1]);


            $coin_user = Coin::where('user_id', $user->id)->first();
            if ($coin_user) {
                $coin_user->quantity = $coin_user->quantity + 2;
                $coin_user->save();
            } else {
                Coin::create([
                    "user_id" => $user->id,
                    "qauantity" => 2
                ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}

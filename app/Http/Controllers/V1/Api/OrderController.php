<?php

namespace App\Http\Controllers\V1\Api;

use App\Helpers\JsonResponseHelper;
use App\Services\Interface\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderRepositoryInterface $orderRepository) {}

    public function order_follower(Request $request){
        $res = $this->orderRepository->order_follower($request);
        return JsonResponseHelper::OutputResponse( '', JsonResponseHelper::MESSAGE[ 'success' ], true, 200 );
    }
}

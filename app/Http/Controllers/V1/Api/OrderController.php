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

    public function order_unfollow_list(Request $request){
        $res = $this->orderRepository->order_unfollow_list($request);
        return JsonResponseHelper::OutputResponse( $res, JsonResponseHelper::MESSAGE[ 'success' ], true, 200 );
    }

    public function follow_user(Request $request){
        $res = $this->orderRepository->follow_user( $request );
        if($res == false){
            return JsonResponseHelper::OutputResponse( '', JsonResponseHelper::MESSAGE[ 'login_invalid' ], true, 422 );           
        }
        return JsonResponseHelper::OutputResponse( '', JsonResponseHelper::MESSAGE[ 'success' ], true, 200 );

    }
}

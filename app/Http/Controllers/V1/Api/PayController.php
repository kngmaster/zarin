<?php

namespace App\Http\Controllers\V1\Api;

use App\Helper\JsonResponseHelper;
use App\Services\Interface\OrderRepositoryInterface;
use App\Services\Interface\PayRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function __construct( private PayRepositoryInterface $payRepository, private OrderRepositoryInterface $orderRepository ) {
    }

    public function payment(Request $request){
        $gateway_id = $request->gateway_id;
        $order_id = $request->order_id;
        $res = $this->payRepository->payment($gateway_id, $order_id);
        if($res){

        }
        return  JsonResponseHelper::OutputResponse( '', __( 'common.not_exists', [ 'name'=>'سفارش مورد نظر' ] ),  false, Response::HTTP_BAD_REQUEST );
    }

    public function payment_verify(Request $request){

    }
}

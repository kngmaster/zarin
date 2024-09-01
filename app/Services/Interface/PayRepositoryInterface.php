<?php

namespace App\Services\Interface;

interface PayRepositoryInterface
{
    public function payment( $gateway_id, $order_id );

    public function paymentVerify( Request $request );
   
}
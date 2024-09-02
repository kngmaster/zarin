<?php

namespace App\Services\Interface;

interface OrderRepositoryInterface
{
    public function order_follower($request);

    public function order_list();

    public function pay_user();
   
}
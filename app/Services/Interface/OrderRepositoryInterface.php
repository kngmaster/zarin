<?php

namespace App\Services\Interface;

interface OrderRepositoryInterface
{
    public function order_follower($request);

    public function order_unfollow_list($request);

    public function pay_user();
   
}
<?php

namespace App\Services\Interface;

interface OrderRepositoryInterface
{
    public function order_follower_submit($quantity, $user_id);

    public function order_list();

    public function pay_user();
   
}
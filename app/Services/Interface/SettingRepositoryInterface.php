<?php

namespace App\Services\Interface;

interface SettingRepositoryInterface
{
    public function config();

    public function get_version();
   
}
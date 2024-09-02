<?php

namespace App\Services\Action;

use App\Models\Setting;
use App\Services\Interface\SettingRepositoryInterface;



class SettingRepository implements SettingRepositoryInterface
{
    public function config(){
       $config = Setting::select('slug', 'version', 'status')->where('slug', 'init-config')->first();
       if($config){
            if($config->status == 0){
               return false;     
            }
            return $config;
       }
       return false;
    }
 
}
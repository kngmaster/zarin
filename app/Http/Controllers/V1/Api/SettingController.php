<?php

namespace App\Http\Controllers\V1\Api;

use App\Helpers\JsonResponseHelper;
use App\Http\Resources\ConfigResource;
use App\Services\Interface\SettingRepositoryInterface;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(private SettingRepositoryInterface $settingRepository) {}

    public function config(){
        $res = $this->settingRepository->config();        
        if($res == false){
            return JsonResponseHelper::OutputResponse( '', JsonResponseHelper::MESSAGE[ 'invalid_app' ], false, 422 );           
        }
        return JsonResponseHelper::OutputResponse(new ConfigResource($res), JsonResponseHelper::MESSAGE['success_data'], true, 200 );
    } 
}

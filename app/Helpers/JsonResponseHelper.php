<?php


namespace App\Helper;

class JsonResponseHelper
{
    public const MESSAGE = [
        "success_data" => "با موفقیت ارسال شد",
        "success" => "با موفقیت انجام شد",
        "again" => "از قبل وجود دارد",
        "mobile_repeat" => "تلفن همراه از قبل وجود دارد",
        "fail" => "با خطا انجام شد",
        "login_valid" => 'با موفقیت ورود انجام شد',
        "login_invalid" => 'نام کاربری یا کلمه عبور اشتباه است',        
    ];

    public static function OutputResponse($data = '', $message = '',$status = true , $statusCode = 200)
    {
        $result = [];
        $result['status'] = $status;
        $result['message'] = $message;
        $result['data'] = $data;

        return response()->json($result, $statusCode);
    }
}
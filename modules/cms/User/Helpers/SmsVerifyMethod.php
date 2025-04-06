<?php


namespace CMS\User\Helpers;


use CMS\Sms\Jobs\SendUltraSmsJob;
use CMS\Sms\Services\SmsService;
use SanjabVerify\Contracts\VerifyMethod;

class SmsVerifyMethod implements VerifyMethod
{

    public function send(string $receptor, string $code)
    {
//        try {

            $result = SmsService::ultra('register', [$code], $receptor);
                //SendUltraSmsJob::dispatch('register', [$code], $receptor)->onQueue('sendUltraSms')->delay(now()->addSecond(2));

//            if ($result['IsSuccessful'] == true) {
                return true;
//            }
//        } catch (\Kavenegar\Exceptions\ApiException $e) {
//            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
//            echo $e->errorMessage();
//        } catch (\Kavenegar\Exceptions\HttpException $e) {
//            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
//            echo $e->errorMessage();
//        }
    }
}

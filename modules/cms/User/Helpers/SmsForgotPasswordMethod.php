<?php


namespace CMS\User\Helpers;


use CMS\Sms\Jobs\SendUltraSmsJob;
use CMS\Sms\Services\SmsService;
use CMS\User\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use SanjabVerify\Contracts\VerifyMethod;

class SmsForgotPasswordMethod implements VerifyMethod
{

    public function send(string $receptor, string $code)
    {
//        try{
            //کد لازم برای تغییر رمز (یا به همراه لینک صفحه تغییر رمز عبور) ارسال میگردد عبور به کاربر ارسال میشود تا 10 دقیقه قابل استفاده است و بعد اولین استفاده نیز از بین میرود
        $result = SmsService::ultra('forgotPass', [$code], $receptor);

        //SendUltraSmsJob::dispatch('forgotPass', [$code], $receptor)->onQueue('sendUltraSms')->delay(now()->addSecond(2));

        $cache = Cache::put($receptor.'forgetPass',$code,600);

//            $sender = "10004346";
//            $message = "کد و رمز عبور جدید برای شما ارسال شد و رمز عبور جدید $password . فراموشی رمز عبور خدمات پیام کوتاه کاوه نگار ";
//            $receptor = $receptor;

//            $result = Kavenegar::Send($sender,$receptor,$message);
//            if($result){
//                foreach($result as $r){
//                    echo "messageid = $r->messageid";
//                    echo "message = $r->message";
//                    echo "status = $r->status";
//                    echo "statustext = $r->statustext";
//                    echo "sender = $r->sender";
//                    echo "receptor = $r->receptor";
//                    echo "date = $r->date";
//                    echo "cost = $r->cost";
//                }
//            }
            return true;
//        }
//        catch(\Kavenegar\Exceptions\ApiException $e){
//            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
//            echo $e->errorMessage();
//        }
//        catch(\Kavenegar\Exceptions\HttpException $e){
//            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
//            echo $e->errorMessage();
//        }
    }
}

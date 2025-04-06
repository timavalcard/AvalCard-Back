<?php


namespace CMS\Sms\Services;


class SmsService
{


    public static function send(array $messages, array $numbers)
    {
        $send = new SmsIR_SendMessage(config('Sms.api-key'), config('Sms.secret-key'), config('Sms.line-number'));
        return $send->SendMessage($numbers, $messages);

    }

    public static function ultra(string $ultra, array $data, $number)
    {

        $url = "https://portal.amootsms.com/rest/SendWithPattern";
        $token = "4F10D57FE55D037594C93049AB320A800342364A";
        $patternCodeID = config('Sms.ultra.' . $ultra . '.ultra_code');
        $mobile = $number;
        $values = [];

        foreach (config('Sms.ultra.' . $ultra . '.params') as $key => $param) {
            $values[] = $data[$key];
        }

        $patternValues = implode(",", $values);

        $postFields = [
            'Token' => $token,
            'Mobile' => $mobile,
            'PatternCodeID' => $patternCodeID,
            'PatternValues' => $patternValues,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);



        curl_close($ch);


        return $response;

    }
}

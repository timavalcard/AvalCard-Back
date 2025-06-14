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

        $url = "https://api.sms.ir/v1/send/verify";
        $token = "yYRwU7TxKEZtERtKIfwbTcPLtPLzteyvWrotc9sBbbbxXwUz";

        $patternCode = config('Sms.ultra.' . $ultra . '.ultra_code');
        $mobile = $number;
        $params = config('Sms.ultra.' . $ultra . '.params');

        $parameters = [];

        foreach ($params as $key => $param) {

            $parameters[] = [
                "name" => $param,
                "value" => $data[$key]
            ];
        }

        $postFields = [
            "mobile" => $mobile,
            "templateId" => (int) $patternCode,
            "parameters" => $parameters
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Accept: application/json",
            "X-API-KEY: $token"
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postFields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;


    }
}

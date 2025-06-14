<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Driver
    |--------------------------------------------------------------------------
    |
    | This value determines which of the following gateway to use.
    | You can switch to a different driver at runtime.
    |
    */
    'default' => 'zarinpal',

    /*
    |--------------------------------------------------------------------------
    | List of Drivers
    |--------------------------------------------------------------------------
    |
    | These are the list of drivers to use for this package.
    | You can change the name. Then you'll have to change
    | it in the map array too.
    |
    */
    'drivers' => [
        'asanpardakht' => [
            'apiPurchaseUrl' => 'https://services.asanpardakht.net/paygate/merchantservices.asmx?wsdl',
            'apiPaymentUrl' => 'https://asan.shaparak.ir',
            'apiVerificationUrl' => 'https://services.asanpardakht.net/paygate/merchantservices.asmx?wsdl',
            'apiUtilsUrl' => 'https://services.asanpardakht.net/paygate/internalutils.asmx?wsdl',
            'key' => '',
            'iv' => '',
            'username' => '',
            'password' => '',
            'merchantId' => '',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using asanpardakht',
            'persian_name'=>"آسان پرداخت"
        ],
        'behpardakht' => [
            'apiPurchaseUrl' => 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl',
            'apiPaymentUrl' => 'https://bpm.shaparak.ir/pgwchannel/startpay.mellat',
            'apiVerificationUrl' => 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl',
            'terminalId' => '',
            'username' => '',
            'password' => '',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using behpardakht',
            'persian_name'=>"به پرداخت"
        ],
        'idpay' => [
            'apiPurchaseUrl' => 'https://api.idpay.ir/v1.1/payment',
            'apiPaymentUrl' => 'https://idpay.ir/p/ws/',
            'apiSandboxPaymentUrl' => 'https://idpay.ir/p/ws-sandbox/',
            'apiVerificationUrl' => 'https://api.idpay.ir/v1.1/payment/verify',
            'merchantId' => '',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'ایدی پی',
            'sandbox' => false, // set it to true for test environments
            'persian_name'=>"ایدی پی"
        ],
        'irankish' => [
            'apiPurchaseUrl' => 'https://ikc.shaparak.ir/XToken/Tokens.xml',
            'apiPaymentUrl' => 'https://ikc.shaparak.ir/TPayment/Payment/index/',
            'apiVerificationUrl' => 'https://ikc.shaparak.ir/XVerify/Verify.xml',
            'merchantId' => '',
            'sha1Key' => '',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using irankish',
            'persian_name'=>"ایران کیش"
        ],
        'nextpay' => [
            'apiPurchaseUrl' => 'https://nextpay.org/nx/gateway/token',
            'apiPaymentUrl' => 'https://nextpay.org/nx/gateway/payment/',
            'apiVerificationUrl' => 'https://nextpay.org/nx/gateway/verify',
            'merchantId' => '8804416b-b780-49d4-ad9e-d608330db174',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using nextpay',
            'persian_name'=>"نکست پی"
        ],
        'parsian' => [
            'apiPurchaseUrl' => 'https://pec.shaparak.ir/NewIPGServices/Sale/SaleService.asmx?wsdl',
            'apiPaymentUrl' => 'https://pec.shaparak.ir/NewIPG/',
            'apiVerificationUrl' => 'https://pec.shaparak.ir/NewIPGServices/Confirm/ConfirmService.asmx?wsdl',
            'merchantId' => '',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using parsian',
            'persian_name'=>"پارسیان"
        ],
        'pasargad' => [
            'apiPaymentUrl' => 'https://pep.shaparak.ir/payment.aspx',
            'apiGetToken' => 'https://pep.shaparak.ir/Api/v1/Payment/GetToken',
            'apiCheckTransactionUrl' => 'https://pep.shaparak.ir/Api/v1/Payment/CheckTransactionResult',
            'apiVerificationUrl' => 'https://pep.shaparak.ir/Api/v1/Payment/VerifyPayment',
            'merchantId' => '',
            'terminalCode' => '',
            'certificate' => '', // can be string (and set certificateType to xml_string) or an xml file path (and set cetificateType to xml_file)
            'certificateType' => 'xml_file', // can be: xml_file, xml_string
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'persian_name'=>"پاسارگاد"
        ],
        'payir' => [
            'apiPurchaseUrl' => 'https://pay.ir/pg/send',
            'apiPaymentUrl' => 'https://pay.ir/pg/',
            'apiVerificationUrl' => 'https://pay.ir/pg/verify/',
            'merchantId' => 'test', // set it to `test` for test environments
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using payir',
            'persian_name'=>"پی ای ار"
        ],
        'paypal' => [
            /* normal api */
            'apiPurchaseUrl' => 'https://www.paypal.com/cgi-bin/webscr',
            'apiPaymentUrl' => 'https://www.zarinpal.com/pg/StartPay/',
            'apiVerificationUrl' => 'https://ir.zarinpal.com/pg/services/WebGate/wsdl',

            /* sandbox api */
            'sandboxApiPurchaseUrl' => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
            'sandboxApiPaymentUrl' => 'https://sandbox.zarinpal.com/pg/StartPay/',
            'sandboxApiVerificationUrl' => 'https://sandbox.zarinpal.com/pg/services/WebGate/wsdl',

            'mode' => 'normal', // can be normal, sandbox
            'currency' => '',
            'id' => '', // Specify the email of the PayPal Business account
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using paypal',
            'persian_name'=>"پی پال",

        ],
        'payping' => [
            'apiPurchaseUrl' => 'https://api.payping.ir/v1/pay/',
            'apiPaymentUrl' => 'https://api.payping.ir/v1/pay/gotoipg/',
            'apiVerificationUrl' => 'https://api.payping.ir/v1/pay/verify/',
            'merchantId' => '',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using payping',
            'persian_name'=>"پی پینگ"
        ],
        'paystar' => [
            'apiPurchaseUrl' => 'https://paystar.ir/api/create/',
            'apiPaymentUrl' => 'https://paystar.ir/paying/',
            'apiVerificationUrl' => 'https://paystar.ir/api/verify/',
            'merchantId' => '',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using paystar',
            'persian_name'=>"پی استار"
        ],
        'poolam' => [
            'apiPurchaseUrl' => 'https://poolam.ir/invoice/request/',
            'apiPaymentUrl' => 'https://poolam.ir/invoice/pay/',
            'apiVerificationUrl' => 'https://poolam.ir/invoice/check/',
            'merchantId' => '',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using poolam',
            'persian_name'=>"پو لم"
        ],
        'sadad' => [
            'apiPurchaseUrl' => 'https://sadad.shaparak.ir/vpg/api/v0/Request/PaymentRequest',
            'apiPaymentUrl' => 'https://sadad.shaparak.ir/VPG/Purchase',
            'apiVerificationUrl' => 'https://sadad.shaparak.ir/VPG/api/v0/Advice/Verify',
            'key' => '',
            'merchantId' => '',
            'terminalId' => '',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using sadad',
            'persian_name'=>"صداد"
        ],
        'saman' => [
            'apiPurchaseUrl' => 'https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL',
            'apiPaymentUrl' => 'https://sep.shaparak.ir/payment.aspx',
            'apiVerificationUrl' => 'https://sep.shaparak.ir/payments/referencepayment.asmx?WSDL',
            'merchantId' => '',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using saman',
            'persian_name'=>"سامان"
        ],
        'yekpay' => [
            'apiPurchaseUrl' => 'https://gate.yekpay.com/api/payment/server?wsdl',
            'apiPaymentUrl' => 'https://gate.yekpay.com/api/payment/start/',
            'apiVerificationUrl' => 'https://gate.yekpay.com/api/payment/server?wsdl',
            'fromCurrencyCode' => 978,
            'toCurrencyCode' => 364,
            'merchantId' => '',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using yekpay',
            'persian_name'=>"یک پی"
        ],
        'zarinpal' => [
            /* normal api */
            'apiPurchaseUrl'      => 'https://api.zarinpal.com/pg/v4/payment/request.json',
            'apiPaymentUrl'       => 'https://www.zarinpal.com/pg/StartPay/',
            'apiVerificationUrl'  => 'https://api.zarinpal.com/pg/v4/payment/verify.json',

            /* sandbox api */
            'sandboxApiPurchaseUrl' => 'https://sandbox.zarinpal.com/pg/v4/payment/request.json',
            'sandboxApiPaymentUrl' => 'https://sandbox.zarinpal.com/pg/StartPay/',
            'sandboxApiVerificationUrl' => 'https://sandbox.zarinpal.com/pg/v4/payment/verify.json',

            /* zarinGate api */
            'zaringateApiPurchaseUrl' => 'https://ir.zarinpal.com/pg/services/WebGate/wsdl',
            'zaringateApiPaymentUrl' => 'https://www.zarinpal.com/pg/StartPay/:authority/ZarinGate',
            'zaringateApiVerificationUrl' => 'https://ir.zarinpal.com/pg/services/WebGate/wsdl',

            'mode' => 'normal', // can be normal, sandbox, zaringate
            'merchantId' => 'd769cf76-f02a-4622-b9cb-ce5776f759ca',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => "زرین پال",
            'persian_name'=>"زرین پال",
            "img_src"=>""
        ],
        'zibal' => [
            /* normal api */
            'apiPurchaseUrl' => 'https://gateway.zibal.ir/v1/request',
            'apiPaymentUrl' => 'https://gateway.zibal.ir/start/',
            'apiVerificationUrl' => 'https://gateway.zibal.ir/v1/verify',

            'mode' => 'normal', // can be normal, direct

            'merchantId' => '67f684bb6f38030015fb4595',
            'callbackUrl' => "https://".$_SERVER['SERVER_NAME']."/verify-payment",
            'description' => 'payment using zibal',
            'persian_name'=>"زیبال"
        ],
        'home'=>[
            'persian_name'=>"پرداخت درب منزل",
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Maps
    |--------------------------------------------------------------------------
    |
    | This is the array of Classes that maps to Drivers above.
    | You can create your own driver if you like and add the
    | config in the drivers array and the class to use for
    | here with the same name. You will have to extend
    | Shetabit\Multipay\Abstracts\Driver in your driver.
    |
    */
    'map' => [
        'asanpardakht' => \Shetabit\Multipay\Drivers\Asanpardakht\Asanpardakht::class,
        'behpardakht' => \Shetabit\Multipay\Drivers\Behpardakht\Behpardakht::class,
        'idpay' => \Shetabit\Multipay\Drivers\Idpay\Idpay::class,
        'irankish' => \Shetabit\Multipay\Drivers\Irankish\Irankish::class,
        'nextpay' => \Shetabit\Multipay\Drivers\Nextpay\Nextpay::class,
        'parsian' => \Shetabit\Multipay\Drivers\Parsian\Parsian::class,
        'pasargad' => \Shetabit\Multipay\Drivers\Pasargad\Pasargad::class,
        'payir' => \Shetabit\Multipay\Drivers\Payir\Payir::class,
        'paypal' => \Shetabit\Multipay\Drivers\Paypal\Paypal::class,
        'payping' => \Shetabit\Multipay\Drivers\Payping\Payping::class,
        'paystar' => \Shetabit\Multipay\Drivers\Paystar\Paystar::class,
        'poolam' => \Shetabit\Multipay\Drivers\Poolam\Poolam::class,
        'sadad' => \Shetabit\Multipay\Drivers\Sadad\Sadad::class,
        'saman' => \Shetabit\Multipay\Drivers\Saman\Saman::class,
        'yekpay' => \Shetabit\Multipay\Drivers\Yekpay\Yekpay::class,
        'zarinpal' => \Shetabit\Multipay\Drivers\Zarinpal\Zarinpal::class,
        'zibal' => \Shetabit\Multipay\Drivers\Zibal\Zibal::class,
    ]
];

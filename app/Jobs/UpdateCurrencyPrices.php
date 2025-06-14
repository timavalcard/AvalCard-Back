<?php

namespace App\Jobs;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Queue\Queueable;

class UpdateCurrencyPrices implements ShouldQueue
{
    use Queueable;
    /**
     * فراخوانی API برای دریافت نرخ ارزها
     *
     * @return void
     */
    public function handle()
    {
        //Log::info('Job is starting');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer abuqbk0edz0vh8regmkr'
        ])->get('https://studio.persianapi.com/index.php/web-service/currency/free?format=json&limit=144&page=1');

        // اگر درخواست موفق بود
        if ($response->successful()) {
            $data = $response->json();

            // بررسی داده‌ها
            if (isset($data['result']['data'])) {
                $currencies = $data['result']['data'];

                // ذخیره‌سازی نرخ ارزها در کش
                foreach ($currencies as $currency) {
                    if (isset($currency['عنوان']) && isset($currency['قیمت'])) {
                        $currencyName = $currency['عنوان']; // نام ارز مانند دلار
                        $key = $currency['key']; // نام ارز مانند دلار
                        $currencyPrice = $currency['قیمت']; // قیمت ارز

                        // ذخیره‌سازی نرخ ارز در کش
                        Cache::put("currency_rate_{$key}", $currencyPrice, now()->addMinutes(1115)); // 1 دقیقه مدت زمان ذخیره در کش
                    }
                }
            }
        }
    }
}

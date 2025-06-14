<?php


namespace CMS\Dashboard\Http\Controllers;

use CMS\Sms\Services\SmsService;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\Controller;
use CMS\Comment\Repository\CommentRepository;
use CMS\Order\Models\Order;
use CMS\Order\Repository\OrderRepository;
use CMS\Product\Repository\ProductRepository;
use CMS\RolePermissions\Models\Permission;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
class DashboardController extends Controller
{


    public function index()
    {

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
                        Cache::put("currency_rate_{$key}", $currencyPrice, now()->addMinutes(1000)); // 1 دقیقه مدت زمان ذخیره در کش
                    }
                }
            }
        }
        $orders=Order::query()->where("order_type","==","gift_cart")->get();
        $order_products_id = $orders->pluck("products_id");
        $products_ids = [];
        foreach ($order_products_id as $item) {
            foreach ($item as $parent_product) {
                foreach ($parent_product as $product) {
                    if(isset($products_ids[$product["id"]])){
                        $products_ids[$product["id"]]+=(int) $product["quantity"];

                    } else{
                        $products_ids[$product["id"]]=(int) $product["quantity"];
                    }
                }
            }

        }

        //sort($products_ids);
        uasort($products_ids, function($a, $b) {
            return $b - $a;
        });

        $products_ids=array_slice($products_ids, 0, 10,true);

        $most_selled_product=[];
        foreach ($products_ids as $product_id=>$product_quantity){
            if($product=ProductRepository::find_not_fail($product_id)){
                $product->selled=$product_quantity;
                $most_selled_product[]=$product;
            }

        }
        $all_orders = OrderRepository::getAllCount();
        $datesOrder = collect();
        foreach (range(-30, 0) as $i) {
            $datesOrder->put(now()->addDays($i)->format('Y-m-d'), 0);
        }
        $user_id = auth()->id();
        $summeryOrder = OrderRepository::getDailySummery($datesOrder, $user_id);

        $comments=CommentRepository::get_newest_comments();

        return view('Dashboard::Admin.dashboard',compact("all_orders","datesOrder","summeryOrder","most_selled_product","comments"));
    }
}

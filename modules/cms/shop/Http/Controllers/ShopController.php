<?php

namespace CMS\Shop\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use CMS\Cart\Repository\CartRepository;
use CMS\Category\Repositories\CategoryRepository;
use CMS\Order\Models\Order;
use CMS\Order\Repository\OrderRepository;
use CMS\Product\Repository\ProductRepository;
use CMS\Product\Service\ProductService;
use CMS\Shop\excel\ViewExcel;
use CMS\Shop\Repository\ShopRepository;
use CMS\Shop\Service\ShopService;
use CMS\Transaction\Repository\TransactionRepository;
use CMS\User\Repositories\UserRepository;
use CMS\Wallet\Services\WalletService;

class ShopController extends Controller
{

    // theme functions
    public function shop_page()
    {
        $products=ProductRepository::pagination();
        $categories=CategoryRepository::get_by_type("product");
        $cheapest_product=ProductRepository::order_by_attribute_by_category("regular_price",null,"asc");
        $expensive_product=ProductRepository::order_by_attribute_by_category("regular_price",null,"desc");

        return view("Theme::hidi.shop",["cheapest_product"=>$cheapest_product,"expensive_product"=>$expensive_product,"categories"=>$categories,"products"=>$products]);
    }

    public function checkout(){
        if(!auth()->check()){
            toastMessage("برای ثبت سفارش ابتدا وارد شوید","ابتدا وارد شوید","info");
            return redirect()->route("auth.index",["return_to"=>"shop.checkout"]);
        }
        $cart=CartRepository::get_cart();
        $cart_products=ProductService::get_cart_products($cart);
        $cart_products_total_price=format_price_with_currencySymbol(ShopService::get_order_total_price());
        $active_gateways=ShopRepository::getOption("active_gateways");
        $gateways=[];
        foreach ($active_gateways as $active_gateway_key=>$active_gateway){
            if(isset($active_gateway["active"]) && $active_gateway["active"]==true){
                $gateways[$active_gateway_key]=$active_gateway;
            }
        }

        if(empty($cart_products)){
            toastMessage(" سبد خرید شما خالی است ابتدا محصولی را به سبد خرید اضافه کنید","سبد خرید خالی است","info");
            return redirect()->route("home");
        }
        $billing=UserRepository::get_billing_meta();


        return view("Theme::hidi.checkout",["billing"=>$billing,"cart"=>$cart, "cart_products"=>$cart_products,"cart_products_total_price"=>$cart_products_total_price,"gateways"=>$gateways]);
    }

    public function save_billing_information(Request $request){

        $data=[];
        foreach ($request->all() as $item) {
            if(!is_null($item) && str_contains($item,"billing_")){
                $data[]=$item;
            }
        }
        UserRepository::add_meta($data);
        $user_billing=UserRepository::get_billing_meta(auth()->user());
        if(empty(auth()->user()->name)){
            auth()->user()->name=$user_billing["billing_first_name"]??"";
            auth()->user()->save();
            UserRepository::add_meta([
                ["name"=>"lastname","value"=>$user_billing["billing_last_name"]??""],
            ]);
        }

        $address=get_user_meta(auth()->user()->id,"address");
        if(!$address){
            $data=[];
            foreach ($request->all() as $key=>$item) {

                if(str_contains($key,"billing_")){
                    $data[$key]=$item;
                }
            }
            $address[0]=$data;
            update_user_meta(auth()->user()->id,"address",$address);
        } else{

            $address=$address->meta_value;

            $data=[];
            foreach ($request->all() as $key=>$item) {

                if(str_contains($key,"billing_")){
                    $data[$key]=$item;
                }
            }
            $address[]=$data;

            update_user_meta(auth()->user()->id,"address",$address);
        }
        return redirect()->route("shop.checkout_address");

    }

    public function checkout_address(){
        if(!auth()->check()){
            toastMessage("برای ثبت سفارش ابتدا وارد شوید","ابتدا وارد شوید","info");
            return redirect()->route("auth.index",["return_to"=>"shop.checkout"]);
        }
        $cart=CartRepository::get_cart();
        $cart_products=ProductService::get_cart_products($cart);
        if(empty($cart_products)){
            toastMessage(" سبد خرید شما خالی است ابتدا محصولی را به سبد خرید اضافه کنید","سبد خرید خالی است","info");
            return redirect()->route("home");
        }
        $address=get_user_meta(auth()->user()->id,"address");
        if(!$address){
            return redirect()->route("shop.checkout");
        }

        return view("Theme::hidi.checkout_address",["address"=>$address->meta_value]);

    }

    public function checkout_save_address(Request $request){
        $address=get_user_meta(auth()->user()->id,"address");
        if(!$address){
            return redirect()->route("shop.checkout");
        }
        if(isset($address->meta_value[$request->selected_address])){
            $selected_address=$address->meta_value[$request->selected_address];
        } else{
            return redirect()->route("shop.checkout");
        }
        update_user_meta(auth()->user()->id,"selected_address",$selected_address);
        if($request->selected_delivery=="free"){
           if($selected_address["billing_city"]!="ساوه"){
               toastMessage("شما از شهر ساوه نیستید لطفا پست پیشتاز را انتخاب کنید!");
               return back();
           }
        }


        update_user_meta(auth()->user()->id,"selected_delivery",$request->selected_delivery);
        return redirect()->route("shop.checkout_bill");
    }

    public function checkout_save_bill(){
        if(!auth()->check()){
            toastMessage("برای ثبت سفارش ابتدا وارد شوید","ابتدا وارد شوید","info");
            return redirect()->route("auth.index",["return_to"=>"shop.checkout"]);
        }
        $cart=CartRepository::get_cart();
        $cart_products=ProductService::get_cart_products($cart);
        if(empty($cart_products)){
            toastMessage(" سبد خرید شما خالی است ابتدا محصولی را به سبد خرید اضافه کنید","سبد خرید خالی است","info");
            return redirect()->route("home");
        }

        $selected_address=get_user_meta(auth()->user()->id,"selected_address");
        $cart=CartRepository::get_cart();
        $cart_products=ProductService::get_cart_products($cart);
        $cart_products_total_price=format_price_with_currencySymbol(ShopService::get_order_total_price());
        $active_gateways=ShopRepository::getOption("active_gateways");
        $gateways=[];
        foreach ($active_gateways as $active_gateway_key=>$active_gateway){
            if(isset($active_gateway["active"]) && $active_gateway["active"]==true){
                $gateways[$active_gateway_key]=$active_gateway;
            }
        }
        $wallet=WalletService::user_has_amount_in_wallet();
        return view("Theme::hidi.checkout_bill",["selected_address"=>$selected_address->meta_value,"cart"=>$cart, "cart_products"=>$cart_products,"cart_products_total_price"=>$cart_products_total_price,"gateways"=>$gateways,"wallet"=>$wallet]);

    }

    public function checkout_received($id){
        $order=OrderRepository::user_find_order($id);
        $products=ProductService::get_cart_products($order->products_id);

        return view("Theme::hidi.checkout_received",["order"=>$order,"products"=>$products]);

    }

    //admin functions

    public function index(){
        $orders=Order::query()->where("order_type","!=","currency_income")->get();

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
        $past_7_days_orders = OrderRepository::getOrderByPeriod(now(), now()->addDays(-7));
        $past_30_days_orders = OrderRepository::getOrderByPeriod(now(), now()->addDays(-30));
        $get_Orders_today = OrderRepository::getOrdersByDays(now());
        $datesOrder = collect();
        foreach (range(-30, 0) as $i) {
            $datesOrder->put(now()->addDays($i)->format('Y-m-d'), 0);
        }
        $user_id = auth()->id();
        $summeryOrder = OrderRepository::getDailySummery($datesOrder, $user_id);

        return view("Shop::Admin.index",compact('summeryOrder','datesOrder','all_orders','past_7_days_orders', 'past_30_days_orders', 'get_Orders_today','most_selled_product'));

    }

    public function setting()
    {
        $delivery_country=ShopRepository::getOption("country_in_delivery");
        $gateways=config("payment.drivers");
        $active_gateways=ShopRepository::getOption("active_gateways");

        return view("Shop::Admin.setting",compact("delivery_country","gateways","active_gateways"));
    }

    public function gateway($gateway){
        $gateway_data=config("payment.drivers.".$gateway);
        return view("Shop::Admin.gateway",compact("gateway_data","gateway"));
    }

    public function save_gateway($gateway,Request $request){
        $active_gateways=ShopRepository::getOption("active_gateways");
        $data=[];
        $active=$request->active==="on" ? true : false;

        $data["active_gateways"]=$active_gateways;

        $data["active_gateways"][$gateway]=[

            "name"  =>$request->name,
            "active"  =>$active,
        ];
        if(isset($request->merchant_id)){
            $data["active_gateways"][$gateway]["merchant_id"]=$request->merchant_id;
        }
        ShopRepository::create_setting($data);


        return back();

    }

    public function set_setting(Request $request)
    {

        ShopRepository::create_setting($request->except("_token"));
        return back();
    }


    public function delete_delivery_country($country)
    {
        $delivery_countrys=ShopRepository::getOption("country_in_delivery");
        foreach ($delivery_countrys as $key=>$delivery_country){
            if(key($delivery_country)== $country) unset($delivery_countrys[$key]);
        }
        ShopRepository::delete_delivery_country($delivery_countrys);

        return back();
    }


    public function edit_deliver_country_form($country)
    {
        $delivery_countrys=ShopRepository::getOption("country_in_delivery");
        $current_country="";
        foreach ($delivery_countrys as $key=>$delivery_country){
            if(key($delivery_country)==$country) $current_country=$delivery_country;
        }
        $data=["delivery_active"=>ShopRepository::getOption("delivery_active"), "delivery_price"=>ShopRepository::getOption("delivery_price"),"delivery_free_active"=>ShopRepository::getOption("delivery_free_active"),"delivery_free_price"=>ShopRepository::getOption("delivery_free_price")];
        return view("Shop::Admin.edit_delivery_country",compact("current_country","data"));
    }

    public function delivery_save(Request $request){
        if($request->delivery_active == "on"){
            $delivery_price=$request->delivery_price;
            if($delivery_price <=0 || empty($delivery_price)){
                $delivery_price=0;
            }
            $data=["delivery_active"=>$request->delivery_active, "delivery_price"=>$delivery_price,];

            if($request->delivery_free_active == "on"){
                $delivery_free_price=$request->delivery_free_price;
                if($delivery_free_price <=0 || empty($delivery_free_price)){
                    $delivery_free_price=0;
                }
                $data["delivery_free_active"]=$request->delivery_free_active;
                $data["delivery_free_price"]=$delivery_free_price;
            } else{
                ShopRepository::create_setting([
                    "delivery_free_active"=>false,
                    "delivery_free_price"=>false,
                ]);
            }
            ShopRepository::create_setting($data);

        } else{
            ShopRepository::create_setting([
                "delivery_active"=>null,
                "delivery_price"=>null,
                "delivery_free_active"=>null,
                "delivery_free_price"=>null,
            ]);
        }

        return back();

    }

    public function transactions(){
        $transactions=TransactionRepository::get_transactions_by_type("order");
        return view("Shop::Admin.transactions",compact("transactions"));
    }

    public function customers()
    {
        $customers=ShopRepository::customers();
        return view("Shop::Admin.customers",compact("customers"));
    }

    public function excel(Request $request){
        return Excel::download(new ViewExcel(), 'shop_transactions.xlsx');

    }

}

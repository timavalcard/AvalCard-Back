<?php

namespace CMS\Shop\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Category\Models\Category;
use CMS\Product\Models\Product;
use CMS\Product\policies\ProductPolicy;
use CMS\Shop\Repository\ShopRepository;

class ShopServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Shop");
        $this->loadRoutesFrom(__DIR__."/../routes/shop_route.php");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if (Schema::hasTable('shop_setting')) {
            $active_gateways=ShopRepository::getOption("active_gateways");
            if($active_gateways){
                foreach($active_gateways as $active_gateway_key=>$active_gateway) {
                    if (config("payment.drivers." . $active_gateway_key)) {
                        if(isset($active_gateway["merchant_id"])){
                            config(["payment.drivers." . $active_gateway_key . ".merchantId" => $active_gateway["merchant_id"]]);

                        }
                        config(["payment.drivers." . $active_gateway_key . ".persian_name" => $active_gateway["name"]]);
                        config(["payment.drivers." . $active_gateway_key . ".active" => $active_gateway["active"]]);
                    }
                }
            }
        }

        $this->app->booted(function (){
            config()->set("AdminSidebar.shop",[
                "name" => "فروشگاه",
                "link" => route("admin_shop_index"),
                "icon" => "fa-home",
                "children" => [
                    //["name"=>"خانه", "link" => route("admin_shop_index")],
                   // ["name"=>"سفارش ها", "link" => route("admin_orders")],
                    ["name"=>"کوپن های تخفیف","link"=>route("admin_coupon_list","product")],
                    ["name"=>"مشتریان", "link" => route("admin_customers_list")],
                    ["name"=>"تراکنش ها", "link" => route("admin_transaction_list")],
                   // ["name"=>"تنظیمات", "link" => route("admin_shop_setting")],
                ],
                "permission"=>\CMS\RolePermissions\Models\Permission::PERMISSION_MANAGE_SHOP
            ]);
        });


    }
}

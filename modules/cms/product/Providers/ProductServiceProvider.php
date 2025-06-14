<?php

namespace CMS\Product\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use CMS\Brand\Models\Brand;
use CMS\Category\Models\Category;
use CMS\Product\Models\Product;
use CMS\Product\policies\ProductPolicy;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__."/../Resources/Views/","Product");
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__."/../routes/product_route.php");
        $this->loadRoutesFrom(__DIR__."/../routes/coupon_route.php");

        if(Schema::hasTable('products')) {
            config()->set("MenuItem.items.محصولات", ["items" => Product::get(), "type" => "product"]);
            Gate::policy(Product::class,ProductPolicy::class);
        }

        Category::$post_type[]="product";
        Brand::$post_type[]="product";

        $this->app->booted(function (){
            config()->set("AdminSidebar.product",[
                "name" => "گیفت کارت ها",
                "link" => route("admin_product_list",["product_type"=>"gift_cart"]),
                "icon" => "fa-shopping-basket",
                "children"=>[
                    ["name"=>"لیست گیفت کارت ها ","link"=>route("admin_product_list",["product_type"=>"gift_cart"])],
                    ["name"=>"افزودن گیفت کارت  ","link"=>route("admin_product_add",["product_type"=>"gift_cart"])],
                    ["name"=>" دسته بندی گیفت کارت ها ","link"=>route("admin_add_category",['post_type' => 'product',"product_type"=>"gift_cart"])],
                    ["name"=>"ویژگی ها","link"=>route("admin_add_attribute",['post_type' => 'product',"product_type"=>"gift_cart"]) ],
                    ["name"=>"سفارش ها", "link" => route("admin_orders",["order_type"=>"gift_cart"])],

                ],
                "permission"=>\CMS\RolePermissions\Models\Permission::PERMISSION_MANAGE_SHOP
            ]);


            config()->set("AdminSidebar.buy_product",[
                "name" => "خرید کالا و تحویل در ایران",
                "link" => route("admin_product_list",["product_type"=>"buy_product"]),
                "icon" => "fa-shopping-basket",
                "children"=>[
                    ["name"=>"لیست سایت ها","link"=>route("admin_product_list",["product_type"=>"buy_product"])],
                    ["name"=>"افزودن سایت","link"=>route("admin_product_add",["product_type"=>"buy_product"])],
                    ["name"=>" دسته بندی ها ","link"=>route("admin_add_category",['post_type' => 'product',"product_type"=>"buy_product"])],
                    //["name"=>"ویژگی ها","link"=>route("admin_add_attribute",['post_type' => 'product',"product_type"=>"buy_product"]) ],
                    ["name"=>"سفارش ها", "link" => route("admin_orders",["order_type"=>"buy_product"])],

                ],
                "permission"=>\CMS\RolePermissions\Models\Permission::PERMISSION_MANAGE_SHOP
            ]);


            config()->set("AdminSidebar.inter_payment",[
                "name" => "پرداخت سایت های خارجی",
                "link" => route("admin_product_list",["product_type"=>"inter_payment"]),
                "icon" => "fa-shopping-basket",
                "children"=>[
                    ["name"=>"لیست سایت ها","link"=>route("admin_product_list",["product_type"=>"inter_payment"])],
                    ["name"=>"افزودن سایت","link"=>route("admin_product_add",["product_type"=>"inter_payment"])],
                    ["name"=>" دسته بندی ها ","link"=>route("admin_add_category",['post_type' => 'product',"product_type"=>"inter_payment"])],
                    //["name"=>"ویژگی ها","link"=>route("admin_add_attribute",['post_type' => 'product',"product_type"=>"buy_product"]) ],
                    ["name"=>"سفارش ها", "link" => route("admin_orders",["order_type"=>"inter_payment"])],

                ],
                "permission"=>\CMS\RolePermissions\Models\Permission::PERMISSION_MANAGE_SHOP
            ]);


            config()->set("AdminSidebar.currencyIncome",[
                "name" => "نقد کردن درآمد",
                "link" => route("admin_product_list",["product_type"=>"currency_income"]),
                "icon" => "fa-shopping-basket",
                "children"=>[
                    ["name"=>"سفارش ها", "link" => route("admin_orders",["order_type"=>"currency_income"])],
                    ["name"=>"تنظیمات", "link" => route("admin_currency_income_setting")],

                ],
                "permission"=>\CMS\RolePermissions\Models\Permission::PERMISSION_MANAGE_SHOP
            ]);
        });




    }
}

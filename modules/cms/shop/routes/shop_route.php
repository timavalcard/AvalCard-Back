<?php

use Illuminate\Support\Facades\Route;

Route::group([
        "namespace"=>"CMS\Shop\Http\Controllers",
        "middleware"=>"web"
    ],function (){
        //admin panel routes
        Route::group(get_information_for_admin_panel_route_group(),function () {
            Route::get("/shop","ShopController@index")->name("admin_shop_index");
            Route::get("/shop/setting","ShopController@setting")->name("admin_shop_setting");
            Route::post("/shop/setting","ShopController@set_setting")->name("admin_shop_set_settings");
            Route::get("/theme-settings/delivery-country/edit/{country?}","ShopController@edit_deliver_country_form")->name("admin_delivery_country_edit");
            Route::put("/theme-settings/delivery-country/edit/{country?}","ShopController@delivery_save")->name("admin_delivery_save");
            Route::delete("/theme-settings/delivery-country/delete/{country?}","ShopController@delete_delivery_country")->name("admin_delivery_country_delete");
            Route::get("/shop/customers","ShopController@customers")->name("admin_customers_list");
            Route::get("/shop/transaction","ShopController@transactions")->name("admin_transaction_list");
            Route::get("/shop/transaction_excel","ShopController@excel")->name("admin_transaction_excel");

            Route::get("/shop/gateway/{gateway}","ShopController@gateway")->name("admin_gateway_edit");
            Route::post("/shop/gateway/{gateway}","ShopController@save_gateway")->name("admin_gateway_edit");

        });

        //front routes

        Route::get("/shop","ShopController@shop_page")->name("shop.index");
        Route::get("/checkout","ShopController@checkout")->name("shop.checkout");
        Route::get("/checkout/address","ShopController@checkout_address")->name("shop.checkout_address");
        Route::post("/checkout/address","ShopController@checkout_save_address")->name("shop.checkout_save_address");
        Route::get("/checkout/bill","ShopController@checkout_save_bill")->name("shop.checkout_bill");
        Route::get("/checkout/received/{id}","ShopController@checkout_received")->name("shop.checkout_received");
        Route::post("/save-billing","ShopController@save_billing_information")->name("shop.save_billing");
});

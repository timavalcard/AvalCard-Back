<?php
use Illuminate\Support\Facades\Route;

Route::group(["namespace"=>"API\Product\Http\Controllers","middleware"=>"web"],function(){
    //admin panel routes
    Route::group(get_information_for_api_route_group(),function (){
        Route::get("/recent-products","ProductController@recent_products")->name("api.recent_product");
        Route::get("/categories-with-products","ProductController@categories_with_products")->name("api.categories_with_products");
        Route::get("/product/{slug?}","ProductController@product_detail")->name("api.product_detail");
        Route::post("/search-product","ProductController@search")->name("api.search_product");
        Route::middleware('auth:sanctum')->post("/apply-coupon","ProductController@apply_coupon")->name("api.apply_coupon");
        Route::middleware('auth:sanctum')->post("/apply-coupon-on-order","ProductController@apply_coupon_on_order")->name("api.apply_coupon_on_order");
        Route::post("/related-product/{slug?}","ProductController@product_detail")->name("api.product_detail");
        Route::middleware('auth:sanctum')->post("/saved-product/","ProductController@saved_product")->name("api.saved_product");
        Route::middleware('auth:sanctum')->post("/check-saved-product/","ProductController@check_saved_product")->name("api.check_saved_product");
        Route::middleware('auth:sanctum')->post("/saved-product-list/","ProductController@saved_product_list")->name("api.saved_product_list");
        Route::post("/like-product/","ProductController@like")->name("api.like_product");
        Route::post("/view-product/","ProductController@add_view")->name("api.view_product");
        Route::post("/check-like-product/","ProductController@check_like")->name("api.check_like_product");

        Route::middleware('auth:sanctum')->post("/add-to-cart/","ProductController@add_to_cart")->name("api.add_to_cart");
        Route::middleware('auth:sanctum')->delete("/delete-from-cart/","ProductController@delete_from_cart")->name("api.delete_from_cart");
        Route::middleware('auth:sanctum')->post("/increase-cart/","ProductController@increase_cart")->name("api.increase_cart");
        Route::middleware('auth:sanctum')->post("/decrease-cart/","ProductController@decrease_cart")->name("api.decrease_cart");
        Route::middleware('auth:sanctum')->post("/get-cart/","ProductController@get_cart")->name("api.get_cart");
        Route::middleware('auth:sanctum')->post("/add-order/","ProductController@add_order")->name("api.add_order");
        Route::middleware('auth:sanctum')->post("/pay-order/","ProductController@pay_order")->name("api.pay_order");
        Route::middleware('auth:sanctum')->get("/orders/","ProductController@orders")->name("api.orders");
        Route::middleware('auth:sanctum')->get("/order-detail/","ProductController@order_detail")->name("api.order_detail");
        Route::middleware('auth:sanctum')->post("/verify-payment/","ProductController@verify_payment")->name("api.verify_payment");
        Route::middleware('auth:sanctum')->post("/order-comment/","ProductController@order_comment")->name("api.order_comment");
        Route::middleware('auth:sanctum')->post("/add-currency-income-order/","ProductController@add_currency_income_order")->name("api.add_currency_income_order");
        Route::middleware('auth:sanctum')->get("/currency-income-orders/","ProductController@currency_income_orders")->name("api.currency_income_orders");
        Route::middleware('auth:sanctum')->get("/currency-income-order-detail/","ProductController@currency_income_detail")->name("api.currency_income_detail");
        Route::post("/get-currencies-price/","ProductController@get_currencies_price")->name("api.get_currencies_price");
        Route::get("/get-currency-income-fee/","ProductController@get_currency_income_fee")->name("api.get_currency_income_fee");


        Route::middleware('auth:sanctum')->post("/add-buy-product-order/","ProductController@add_buy_product_order");
        Route::middleware('auth:sanctum')->post("/add-inter-payment-order/","ProductController@add_inter_payment_order");
    });

    Route::domain(env("FRONT_URL"))->get("/panel/gift-cards/{slug}","ProductController@index")->name("product.gift_cart");
    Route::domain(env("FRONT_URL"))->get("/panel/buy-deliver-iran/{slug}","ProductController@index")->name("product.buy_product");
    Route::domain(env("FRONT_URL"))->get("/panel/foreign-payment/{slug}","ProductController@index")->name("product.inter_payment");
    Route::domain(env("FRONT_URL"))->get("/group-product/{slug}","ProductController@group_product")->name("group_product.index");



});

<?php
use Illuminate\Support\Facades\Route;

Route::group(["namespace"=>"API\Product\Http\Controllers","middleware"=>"web"],function(){
    //admin panel routes
    Route::group(get_information_for_api_route_group(),function (){
        Route::post("/recent-products","ProductController@recent_products")->name("api.recent_product");
        Route::post("/product/{slug?}","ProductController@product_detail")->name("api.product_detail");
        Route::post("/group-product/{slug?}","ProductController@group_product_detail")->name("api.group_product_detail");
        Route::post("/search-product","ProductController@search")->name("api.search_product");
        Route::middleware('auth:sanctum')->post("/apply-coupon","ProductController@apply_coupon")->name("api.apply_coupon");
        Route::post("/related-product/{slug?}","ProductController@product_detail")->name("api.product_detail");
        Route::middleware('auth:sanctum')->post("/saved-product/","ProductController@saved_product")->name("api.saved_product");
        Route::middleware('auth:sanctum')->post("/check-saved-product/","ProductController@check_saved_product")->name("api.check_saved_product");
        Route::middleware('auth:sanctum')->post("/saved-product-list/","ProductController@saved_product_list")->name("api.saved_product_list");
        Route::post("/like-product/","ProductController@like")->name("api.like_product");
        Route::post("/view-product/","ProductController@add_view")->name("api.view_product");
        Route::post("/check-like-product/","ProductController@check_like")->name("api.check_like_product");

        Route::middleware('auth:sanctum')->post("/add-to-cart/","ProductController@add_to_cart")->name("api.add_to_cart");
        Route::middleware('auth:sanctum')->post("/delete-from-cart/","ProductController@delete_from_cart")->name("api.delete_from_cart");
        Route::middleware('auth:sanctum')->post("/increase-cart/","ProductController@increase_cart")->name("api.increase_cart");
        Route::middleware('auth:sanctum')->post("/decrease-cart/","ProductController@decrease_cart")->name("api.decrease_cart");
        Route::middleware('auth:sanctum')->post("/get-cart/","ProductController@get_cart")->name("api.get_cart");
        Route::middleware('auth:sanctum')->post("/add-order/","ProductController@add_order")->name("api.add_order");
        Route::middleware('auth:sanctum')->post("/verify-payment/","ProductController@verify_payment")->name("api.verify_payment");
    });

    Route::domain(env("FRONT_URL"))->get("/product/{slug}","ProductController@index")->name("product.index3");
    Route::domain(env("FRONT_URL"))->get("/group-product/{slug}","ProductController@group_product")->name("group_product.index");



});

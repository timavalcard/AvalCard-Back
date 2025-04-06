<?php


use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Product\Http\Controllers",
        "middleware"=>"web"
    ],function (){

//admin panel routes
Route::group(get_information_for_admin_panel_route_group(),function (){
    Route::get("/coupon/{type}","CouponController@create_coupon_form")->name("admin_coupon_list");
    Route::post("/coupon","CouponController@create_coupon")->name("admin_add_coupon");
    Route::get("/coupon/edit/{coupon}","CouponController@edit_coupon_form")->name("admin_coupon_edit");
    Route::put("/coupon/edit/{coupon}","CouponController@edit_coupon")->name("admin_coupon_edit");
    Route::delete("/coupon/delete/{couponId}","CouponController@delete_coupon")->name("admin_delete_coupon");


});

Route::post("/apply-coupon","CouponController@apply")->name("coupon.apply")->middleware("auth");
Route::post("/service-apply-coupon","CouponController@service_apply")->name("coupon.apply-service")->middleware("auth");
//front routes

});

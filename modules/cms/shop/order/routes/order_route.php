<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Order\Http\Controllers",
        "middleware"=>"web"
    ],function (){

    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/orders","OrderController@index")->name("admin_orders");
        Route::post("/orders/group-action","OrderController@group_action")->name("admin_orders_group_action");
        Route::get("/orders/add","OrderController@admin_add_order_form")->name("admin_add_order");
        Route::post("/orders/add","OrderController@admin_add_order")->name("admin_add_order");
        Route::get("/orders/edit/{id}","OrderController@edit_form")->name("admin_order_edit");
        Route::put("/orders/edit/{id}","OrderController@admin_edit_order")->name("admin_order_edit");
        Route::delete("/orders/delete/{id}","OrderController@admin_delete_order")->name("admin_delete_order");
        });


    //front routes

        Route::post("/add-order","OrderController@add")->name("order.add")->middleware("auth");
        Route::get("/pay-order/{id}","OrderController@pay")->name("order.pay")->middleware("auth");


});

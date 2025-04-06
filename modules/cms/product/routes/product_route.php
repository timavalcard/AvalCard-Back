<?php


use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Product\Http\Controllers",
        "middleware"=>"web"
    ],function (){

//admin panel routes
Route::group(get_information_for_admin_panel_route_group(),function (){
    Route::get("/product","ProductController@product_list")->name("admin_product_list");
    Route::post("/product/group_action","ProductController@group_action")->name("admin_product_group_action");
    Route::get("/product/add","ProductController@product_add_form")->name("admin_product_add");
    Route::post("/product/add","ProductController@product_add")->name("admin_product_add");
    Route::post("/product/edit/{id}","ProductController@product_edit")->name("admin_product_edit");
    Route::get("/product/edit/{id}","ProductController@product_edit_form")->name("admin_product_edit");
    Route::delete("/product/delete/{id}","ProductController@product_delete")->name("admin_delete_product");
    Route::delete("/product/attribute/delete/{id?}","ProductController@attribute_delete")->name("remove_product_attribute_value");
    Route::delete("/product/variation/delete/","ProductController@variation_delete")->name("remove_product_variation");
    Route::post("/product/get_attr","ProductController@product_get_attr")->name("get_product_attribute_value");
    Route::post("/product/get_attribute_for_variable/{product?}","ProductController@get_product_attribute_use_for_variable")->name("get_product_attribute_use_for_variable");
    Route::post("/product/save_product_attribute/","ProductController@save_product_attribute")->name("save_product_attribute");


});


//front routes
    Route::get("/product/{category?}/{slug}","ProductController@index")->name("product.index");
    Route::get("/product/{slug}","ProductController@index")->name("product.index2");
    //Route::get("/product/{slug}","ProductController@index")->name("product.index");
    Route::post("/product/add-to-wishlist/{id?}","ProductController@add_wishlist")->name("product.add_wishlist");

});

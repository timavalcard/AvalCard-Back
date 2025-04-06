<?php

use Illuminate\Support\Facades\Route;

Route::group([
        "namespace"=>"CMS\ProductAttr\Http\Controllers",
        "middleware"=>"web"
    ],function (){
        //admin panel routes
        Route::group(get_information_for_admin_panel_route_group(),function () {
            Route::get("/product/add_attribute/","ProductAttrController@attribute_add_form")->name("admin_add_attribute");
            Route::post("/product/add_attribute/","ProductAttrController@attribute_add")->name("admin_add_attribute");
            Route::delete("/product/delete_attribute/{id}","ProductAttrController@attribute_delete")->name("admin_delete_attribute");
            Route::get("/product/edit_attribute/{id}","ProductAttrController@attribute_edit_form")->name("admin_edit_attribute");
            Route::get("/product/edit_attribute_value/{id}","ProductAttrController@attribute_value_edit_form")->name("admin_edit_attribute_value");
            Route::post("/product/edit_attribute/{id}","ProductAttrController@attribute_edit")->name("admin_edit_attribute");
            Route::post("/product/add_attribute_value/{id}","ProductAttrController@attribute_value_add")->name("admin_add_attribute_value");
            Route::get("/product/add_attribute_value/{id}","ProductAttrController@attribute_value_add_form")->name("admin_add_attribute_value");

        });

        //front routes
});

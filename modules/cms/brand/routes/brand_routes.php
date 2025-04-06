<?php


use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Brand\Http\Controllers",
        "middleware"=>"web"
    ],function (){

//admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/add-brand","BrandController@brand_add_form")->name("admin_add_brand");
        Route::post("/add-brand","BrandController@brand_add")->name("admin_add_brand");
        Route::get("/edit-brand/{id}","BrandController@brand_edit_form")->name("admin_edit_brand");
        Route::put("/edit-brand/{id}","BrandController@brand_edit")->name("admin_edit_brand");
        Route::delete("/delete-brand/{id}","BrandController@brand_delete")->name("admin_delete_brand");

    });


//front routes

    Route::get("/brand/{slug}","BrandController@index")->name("brand.index");

});

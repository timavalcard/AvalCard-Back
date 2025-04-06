<?php


use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Category\Http\Controllers",
        "middleware"=>"web"
    ],function (){

//admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/add-category","CategoryController@category_add_form")->name("admin_add_category");
        Route::post("/add-category","CategoryController@category_add")->name("admin_add_category");
        Route::get("/edit-category/{id}","CategoryController@category_edit_form")->name("admin_edit_category");
        Route::put("/edit-category/{id}","CategoryController@category_edit")->name("admin_edit_category");
        Route::delete("/delete-category/{id}","CategoryController@category_delete")->name("admin_delete_category");

    });


//front routes

    Route::get("/category/{slug}","CategoryController@index")->name("category.index");
    Route::get("/category/{parent}/{slug}","CategoryController@index")->name("category.index2");

});

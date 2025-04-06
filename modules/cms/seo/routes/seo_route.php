<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Seo\Http\Controllers",
        "middleware"=>"web"
    ],function (){

    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/seo","SeoController@index")->name("admin_seo");
        Route::get("/seo/redirect","SeoController@redirect")->name("admin_seo_redirect");
        Route::get("/seo/redirect/add","SeoController@redirect_add_form")->name("admin_seo_redirect_add");
        Route::post("/seo/redirect/add","SeoController@redirect_add")->name("admin_seo_redirect_add");
        Route::delete("/seo/redirect/delete/{id}","SeoController@redirect_delete")->name("admin_seo_redirect_delete");
        Route::get("/seo/redirect/edit/{id}","SeoController@redirect_edit_form")->name("admin_seo_redirect_edit");
        Route::put("/seo/redirect/edit/{id}","SeoController@redirect_edit")->name("admin_seo_redirect_edit");
        Route::get("/seo/google","SeoController@google")->name("admin_seo_google");
        Route::post("/seo/google","SeoController@google_save")->name("admin_seo_google");
        Route::get("/seo/bing","SeoController@bing")->name("admin_seo_bing");
        Route::post("/seo/bing","SeoController@bing_save")->name("admin_seo_bing");
        Route::get("/seo/local","SeoController@local")->name("admin_seo_local");
        Route::post("/seo/local","SeoController@local_save")->name("admin_seo_local");
        });


    //front routes


});

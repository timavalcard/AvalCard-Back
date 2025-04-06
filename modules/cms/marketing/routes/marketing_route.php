<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Marketing\Http\Controllers",
        "middleware"=>"web"
    ],function (){

    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/marketing","AffiliateController@admin_index")->name("admin_marketing");
        Route::get("/marketing/wait","AffiliateController@admin_index_wait")->name("admin_marketing_wait");
        Route::get("/marketing/wait/accept/{id}","AffiliateController@admin_index_wait_accept")->name("admin_accept_marketer");
        Route::get("/marketing/setting","AffiliateController@setting")->name("admin_marketing_setting");
        Route::post("/marketing/setting","AffiliateController@setting_store")->name("admin_marketing_setting");
        });


    //front routes
    Route::get("/affiliate/submit","AffiliateController@submit")->name("affiliate.submit");
    Route::group(["middleware"=>"affiliate"],function (){
        Route::get("/affiliate","AffiliateController@index")->name("affiliate.index");
        Route::get("/affiliate/links","AffiliateController@links")->name("affiliate.links");
        Route::post("/affiliate/links","AffiliateController@store_link")->name("affiliate.links");
        Route::get("/affiliate/bank","AffiliateController@bank")->name("affiliate.bank");
        Route::post("/affiliate/bank","AffiliateController@bank_store")->name("affiliate.bank");
        Route::get("/affiliate/settled","AffiliateController@settled_form")->name("affiliate.settled");
        Route::post("/affiliate/settled","AffiliateController@settled")->name("affiliate.settled");
        Route::get("/affiliate/settlements","AffiliateController@settlements")->name("affiliate.settlements");
    });


});

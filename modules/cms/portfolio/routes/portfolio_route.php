<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Portfolio\Http\Controllers",
        "middleware"=>"web"
    ],function (){

    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/portfolio","PortfolioController@index")->name("admin_list_portfolio");
        });


    //front routes


});

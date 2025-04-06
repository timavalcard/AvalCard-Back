<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Menu\Http\Controllers",
        "middleware"=>"web"
    ],function (){

        //admin panel routes
            Route::group(get_information_for_admin_panel_route_group(),function (){
                Route::get("/menu","MenuController@add_menu_form")->name("admin_add_menu");
                Route::post("/menu","MenuController@add_menu")->name("admin_add_menu");
            });


        //front routes


});

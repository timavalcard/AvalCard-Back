<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Tools\Http\Controllers",
        "middleware"=>"web"
    ],function (){

    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/tools","ToolsController@index")->name("admin_tools");
        });


    //front routes


});

<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Email\Http\Controllers",
        "middleware"=>"web"
    ],function (){

    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/email","EmailController@index")->name("admin_email");
        Route::post("/email","EmailController@save")->name("admin_save_email_setting");
        });


    //front routes


});

<?php

use Illuminate\Support\Facades\Route;

Route::group([
        "namespace"=>"CMS\Setting\Http\Controllers",
        "middleware"=>"web"
    ],function (){
        //admin panel routes
        Route::group(get_information_for_admin_panel_route_group(),function () {
            Route::get("/settings","SettingController@index")->name("admin_setting_list");
            Route::get("/tel_bot","SettingController@tel_bot")->name("admin_tel_bot");
            Route::post("/tel_bot","SettingController@tel_bot_save")->name("admin_save_tel_bot_setting");
        });

        //front routes
});

<?php

use Illuminate\Support\Facades\Route;

Route::group([
        "namespace"=>"CMS\ThemeSetting\Http\Controllers",
        "middleware"=>"web"
    ],function (){
        //admin panel routes
        Route::group(get_information_for_admin_panel_route_group(),function () {
            Route::get("/theme-settings","ThemeSettingController@index")->name("admin_theme_setting_list");
            Route::post("/theme-settings","ThemeSettingController@create")->name("admin_theme_setting_add");


        });

        //front routes
});

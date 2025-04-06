<?php

use Illuminate\Support\Facades\Route;

Route::group([
    "namespace"=>"CMS\Club\Http\Controllers",
    "middleware"=>"web"
],function (){
    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function () {
        Route::get("/club","ClubController@admin_index")->name("admin_club_index");
        Route::get("/club/setting","ClubController@settings")->name("admin_club_settings");
        Route::post("/club/setting","ClubController@settings_save")->name("admin_save_club_setting");
        Route::delete("/club/remove/{id}","ClubController@remove")->name("admin_club_remove");
        Route::get("/club/edit/{id}","ClubController@edit_form")->name("admin_edit_club");
        Route::put("/club/edit/{id}","ClubController@edit")->name("admin_edit_club");

    });
//front routes

});

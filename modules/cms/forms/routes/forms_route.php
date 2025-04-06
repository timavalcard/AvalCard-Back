<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Forms\Http\Controllers",
        "middleware"=>"web"
    ],function (){

    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/forms","FormController@index")->name("admin_list_forms");
        Route::get("/forms/create","FormController@create")->name("admin_create_form");
        Route::post("/forms/create","FormController@store")->name("admin_create_form");
        Route::get("/forms/{id}/edit","FormController@edit")->name("admin_form_edit");
        Route::put("/forms/{id}/edit","FormController@update")->name("admin_form_edit");
        Route::delete("/forms/{id}/delete","FormController@delete")->name("admin_delete_form");
        Route::get("/forms/entrances/{id}","FormController@entrances")->name("admin_form_entrances");
        Route::get("/forms/entrance/{id}","FormController@show_entrance")->name("admin_form_entrance_show");
        Route::delete("/forms/entrances/{id}/delete","FormController@destroy_entrance")->name("admin_delete_form_entrance");
        Route::get("/forms/entrances/{id}/status","FormController@status_entrance")->name("admin_form_entrance_status");
          });


    //front routes
    Route::post("/form_save","FormController@add_entrance")->name("form_add_entrance");


});

<?php

use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::group(["namespace"=>"CMS\Page\Http\Controllers","middleware"=>"web"],function(){
    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/page/add","PageController@add_page_form")->name("admin_add_page");
        Route::post("/page/add","PageController@add_page")->name("admin_add_page");
        Route::get("/page/edit/{id}","PageController@edit_page_form")->name("admin_edit_page");
        Route::post("/page/edit/{id}","PageController@edit_page")->name("admin_edit_page");
        Route::delete("/page/delete/{id}","PageController@delete_page")->name("admin_delete_page");
        Route::get("/page/list","PageController@list_page")->name("admin_list_page");

    });
    Route::group(["middleware"=>"web"],function(){
        //admin panel routes
        Route::group(get_information_for_admin_panel_route_group(),function (){
            Route::get('logs', [LogController::class, 'index'])->name("log.index");
            Route::delete('logs/{id}', [LogController::class, 'destroy'])->name("log.delete");
        });

        });

    // front routes

    Route::domain(env("FRONT_URL"))->get("/{slug}","PageController@index")->name("page.index");
});

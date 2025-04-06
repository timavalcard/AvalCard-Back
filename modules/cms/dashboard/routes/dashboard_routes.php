<?php


use Illuminate\Support\Facades\Route;
use CMS\Dashboard;
use CMS\Dashboard\Http\Controllers\DashboardController;

Route::group([],function (){

    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function () {
        Route::get("/dashboard",[DashboardController::class,'index'])->name("admin.dashboard");
    });

    //front routes
});

<?php

use Illuminate\Support\Facades\Route;

Route::group([
    "namespace"=>"CMS\Wallet\Http\Controllers",
    "middleware"=>"web"
],function (){
    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function () {
        Route::get("/wallet","WalletController@admin_index")->name("admin_wallet_index");
        Route::get("/wallet/transactions","WalletController@transactions")->name("admin_wallet_transactions");
        Route::get("/wallet/transaction_excel","WalletController@excel")->name("admin_wallet_excel");

        Route::delete("/wallet/remove/{id}","WalletController@remove")->name("admin_wallet_remove");
        Route::get("/wallet/edit/{id}","WalletController@edit_form")->name("admin_edit_wallet");
        Route::put("/wallet/edit/{id}","WalletController@edit")->name("admin_edit_wallet");

    });

    //front routes
    Route::get("/use_club","\CMS\Club\Http\Controllers\ClubController@use_club")->name("club.use");
    Route::post("/service_use_club","\CMS\Club\Http\Controllers\ClubController@service_use")->name("club.service_use");

    Route::get("/cancel_club","\CMS\Club\Http\Controllers\ClubController@cancel_use")->name("club.cancel_use");

    Route::post("/wallet","WalletController@increase")->name("wallet.increase");
    Route::get("/use-wallet","WalletController@use")->name("wallet.use");
    Route::get("/cancel-wallet","WalletController@cancel_use")->name("wallet.cancel_use");

});

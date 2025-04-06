<?php


use Illuminate\Support\Facades\Route;
use CMS\Settlement\Http\Controllers\SettlementController;

Route::group(
    get_information_for_admin_panel_route_group()
    , function () {
    //ADMIN ROUTES
    Route::get('settlement',[SettlementController::class,'index'])->name('settlement.index');
    Route::get('settlement/create',[SettlementController::class,'create'])->name('settlement.create');

    Route::get('settlement/edit/{settlement}',[SettlementController::class,'edit'])->name('settlement.edit');
    Route::post('settlement/update/{settlement}',[SettlementController::class,'update'])->name('settlement.update');

});

Route::group(
    []
    , function () {

    //Front ROUTES

});

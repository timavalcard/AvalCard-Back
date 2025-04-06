<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Transaction\Http\Controllers",
        "middleware"=>"web"
    ],function (){

    Route::get("/verify-payment","TransactionController@verify")->name("transaction.verify");

});

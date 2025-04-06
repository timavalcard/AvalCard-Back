<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Theme\Http\Controllers",
        "middleware"=>"web"
    ],function (){



        Route::get("/","ThemeController@index")->name("home");





});

<?php
use Illuminate\Support\Facades\Route;

Route::group(["namespace"=>"API\Page\Http\Controllers","middleware"=>"web"],function(){
    //admin panel routes
    Route::group(get_information_for_api_route_group(),function (){
        Route::post("/page-content","PageController@page_content")->name("api.page_content");
        Route::post("/add-form-entrance","PageController@addFormEntrance")->name("api.add_form_entrance");

    });




});

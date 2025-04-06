<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\NewsletterEmail\Http\Controllers",
        "middleware"=>"web"
    ],function (){

//admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/newsletter","NewsletterEmailController@newsletter_list")->name("admin_newsletter_list");
        Route::get("/newsletter/search","NewsletterEmailController@newsletter_search")->name("admin_newsletter_search");
        Route::delete("/newsletter/delete/{id}","NewsletterEmailController@delete_newsletter")->name("admin_newsletter_delete");

    });


//front routes
    Route::post("/newsletter/add","NewsletterEmailController@add")->name("newsletter.index");


});

<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Newsletter\Http\Controllers",
        "middleware"=>"web"
    ],function (){

//admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/newsletter/add","NewsletterController@newsletter_add_form")->name("admin_newsletter_add");
        Route::post("/newsletter/add","NewsletterController@newsletter_add")->name("admin_newsletter_add");
        Route::get("/newsletter/sent_list","NewsletterController@newsletter_list_sent")->name("admin_newsletter_list_sent");
        Route::get("/newsletter/send/again/{id}","NewsletterController@newsletter_send_again")->name("admin_newsletter_send_again");
        Route::get("/newsletter/send/edit/{id}","NewsletterController@newsletter_send_edit_form")->name("admin_newsletter_send_edit");
        Route::post("/newsletter/send/edit/{id}","NewsletterController@newsletter_send_edit")->name("admin_newsletter_send_edit");
        Route::delete("/newsletter/send/delete/{id}","NewsletterController@delete_newsletter_send")->name("admin_newsletter_send_delete");

    });


//front routes


});

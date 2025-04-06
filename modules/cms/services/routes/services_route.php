<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Services\Http\Controllers",
        "middleware"=>"web"
    ],function (){

    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/services","ServicesController@index")->name("admin_services");
        Route::get("/services/add","ServicesController@create_form")->name("admin_services_add");
        Route::post("/services/add","ServicesController@create")->name("admin_services_add");
        Route::get("/services/edit/{id}","ServicesController@edit_form")->name("admin_service_edit");
        Route::put("/services/edit/{id}","ServicesController@edit")->name("admin_service_edit");
        Route::delete("/services/delete/{id}","ServicesController@delete")->name("admin_delete_service");


        Route::get("/sub-services/{parent}","ServicesController@sub_index")->name("admin_sub_services");
        Route::post("/sub-services/add/{parent}","ServicesController@sub_create")->name("admin_sub_services_add");
        Route::get("/sub-services/add/{parent}","ServicesController@sub_create_form")->name("admin_sub_services_add");
        Route::get("/sub-services/edit/{id}","ServicesController@sub_edit_form")->name("admin_sub_service_edit");
        Route::put("/sub-services/edit/{id}","ServicesController@sub_edit")->name("admin_sub_service_edit");
        Route::delete("/sub-services/delete/{id}","ServicesController@sub_delete")->name("admin_delete_sub_service");

        Route::get("/sub-services/questions/{id}","ServicesController@sub_questions")->name("admin_sub_service_questions");
        Route::post("/sub-services/questions/{id}","ServicesController@add_sub_questions")->name("admin_sub_service_add_questions");


    });


    //front routes


});

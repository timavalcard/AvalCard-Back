<?php

use Illuminate\Support\Facades\Route;

Route::group([
        "namespace"=>"CMS\Tag\Http\Controllers",
        "middleware"=>"web"
    ],function (){
        //admin panel routes
        Route::group(get_information_for_admin_panel_route_group(),function () {
            Route::get("/add-tag", "TagController@tag_add_form")->name("admin_add_tag");
            Route::post("/add-tag", "TagController@tag_add")->name("admin_add_tag");
            Route::get("/edit-tag/{id}", "TagController@tag_edit_form")->name("admin_edit_tag");
            Route::put("/edit-tag/{id}", "TagController@tag_edit")->name("admin_edit_tag");
            Route::delete("/delete-tag/{id}", "TagController@tag_delete")->name("admin_delete_tag");
        });

        //front routes
});

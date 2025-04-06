<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Media\Http\Controllers",
        "middleware"=>"web"
    ],function (){

    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/media","MediaController@list_media")->name("admin_list_media");
        Route::get("/get-all-media","MediaController@get_all_media")->name("admin_get_all_media");
        Route::delete("/media/delete/{media?}","MediaController@delete_media")->name("admin_delete_media");
        Route::get("/media/add","MediaController@add_media_form")->name("admin_add_media");
        Route::post("/media/add","MediaController@add_media")->name("admin_add_media");
        Route::post("/media/save-alt","MediaController@save_alt")->name("admin_save_media_alt");

    });


    //front routes
    Route::get('/media/{media}/download', 'MediaController@download')->name('media.download');
});

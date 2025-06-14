<?php
use Illuminate\Support\Facades\Route;

Route::group(["namespace"=>"CMS\Article\Http\Controllers","middleware"=>"web"],function(){
    //admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/post","ArticleController@article_list")->name("admin_article_list");
        Route::get("/post/add","ArticleController@article_add_form")->name("admin_article_add");
        Route::post("/post/add","ArticleController@article_add")->name("admin_article_add");
        Route::post("/post/edit/{id}","ArticleController@article_edit")->name("admin_article_edit");
        Route::get("/post/edit/{id}","ArticleController@article_edit_form")->name("admin_article_edit");
        Route::delete("/post/delete/{id}","ArticleController@article_delete")->name("admin_delete_article");
        Route::post("/post/group-action","ArticleController@group_action")->name("admin_articles_group_action");

    });


    Route::get("/mag/{category?}/{slug}","ArticleController@index")->name("article.index2");
    Route::domain(env("FRONT_URL"))->get("/mag/{slug}","ArticleController@index")->name("article.index");


});

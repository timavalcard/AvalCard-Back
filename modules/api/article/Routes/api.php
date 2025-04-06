<?php
use Illuminate\Support\Facades\Route;

Route::group(["namespace"=>"API\Article\Http\Controllers","middleware"=>"web"],function(){
    //admin panel routes
    Route::group(get_information_for_api_route_group(),function (){
        Route::post("/recent-articles","ArticleController@recent_articles")->name("api.recent_articles");
        Route::post("/article/{slug?}","ArticleController@article_detail")->name("api.article_detail");
        Route::post("/search-articles","ArticleController@search")->name("api.search_article");
        Route::post("/related-article/{slug?}","ArticleController@article_detail")->name("api.article_detail");
        Route::middleware('auth:sanctum')->post("/saved-article/","ArticleController@saved_article")->name("api.saved_article");
        Route::middleware('auth:sanctum')->post("/check-saved-article/","ArticleController@check_saved_article")->name("api.check_saved_article");
        Route::middleware('auth:sanctum')->post("/saved-articles-list/","ArticleController@saved_articles_list")->name("api.saved_articles_list");
        Route::post("/like-article/","ArticleController@like")->name("api.like_article");
        Route::post("/view-article/","ArticleController@add_view")->name("api.view_article");
        Route::post("/check-like-article/","ArticleController@check_like")->name("api.check_like_article");
    });

    Route::domain(env("FRONT_URL"))->get("/blog/{slug}","ArticleController@index")->name("article.index");



});

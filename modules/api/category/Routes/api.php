<?php
use Illuminate\Support\Facades\Route;

Route::group(["namespace"=>"API\Category\Http\Controllers","middleware"=>"web"],function(){
    //admin panel routes
    Route::group(get_information_for_api_route_group(),function (){
        Route::post("/parent-cat-list","CategoryController@parent_cat_list")->name("api.parent_cat_list");
        Route::post("/category-with-articles","CategoryController@category_with_articles")->name("api.category_with_articles");
        Route::post("/category-detail/{slug?}","CategoryController@category_detail")->name("api.category_detail");
        Route::post("/product-category-detail/{slug?}","CategoryController@product_category_detail")->name("api.product_category_detail");
        Route::post("/category-top-articles/{slug?}","CategoryController@category_top_articles")->name("api.category_top_articles");
    });




});

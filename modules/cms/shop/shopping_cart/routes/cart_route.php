<?php

use Illuminate\Support\Facades\Route;

Route::group([
    "namespace"=>"CMS\Cart\Http\Controllers",
    "middleware"=>"web"
],function (){

    //front routes
    Route::get("/cart","CartController@index")->name("cart.index");
    Route::post("/add-to-cart/{product}","CartController@group_add_to_cart")->name("add_to_cart");
    Route::get("/add-to-cart/{product}","CartController@add_to_cart")->name("add_to_cart");
    Route::get("/course-add-to-cart/{course}","CartController@course_add_to_cart")->name("course_add_to_cart");
    Route::get("/lesson-add-to-cart/{lesson}","CartController@lesson_add_to_cart")->name("lesson_add_to_cart");
    Route::get("/delete-cart/{id}","CartController@delete_cart")->name("delete_cart");
    Route::get("/course-delete-cart/{id}","CartController@course_delete_cart")->name("course_delete_cart");
    Route::get("/increase-cart/{id}","CartController@increase")->name("increase_cart");
    Route::get("/decrease-cart/{id}","CartController@decrease")->name("decrease_cart");
});

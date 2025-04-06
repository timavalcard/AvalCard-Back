<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Comment\Http\Controllers",
        "middleware"=>"web"
    ],function (){

        //admin panel routes
            Route::group(get_information_for_admin_panel_route_group(),function (){
                Route::get("/product_comments","CommentController@product_comments")->name("product_comments.index");
                Route::get("/product_questions","CommentController@product_questions")->name("product_questions.index");
                Route::get("/article_comments","CommentController@article_comments")->name("article_comments.index");
                Route::delete("/comment/delete/{id}","CommentController@delete_comment")->name("admin_delete_comment");
                Route::get("/comment/ChangeState/{id}","CommentController@ChangeState_comment")->name("admin_ChangeState_comment");

                Route::get("/comment/answer/{id}","CommentController@answer_comment_form")->name("admin_answer_comment");
                Route::post("/comment/answer/{id}","CommentController@answer_comment")->name("admin_answer_comment");
                Route::get("/comment/edit/{id}","CommentController@edit_comment_form")->name("admin_edit_comment");
                Route::post("/comment/edit/{id}","CommentController@edit_comment")->name("admin_edit_comment");

            });


        //front routes

    Route::post("/add-comment","CommentController@add")->name("comment.add")->middleware(["throttle:2,1"]);

});

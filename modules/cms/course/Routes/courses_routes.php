<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace" => "CMS\Course\Http\Controllers", 'middleware' => 'web'
    ], function () {
    Route::group(get_information_for_admin_panel_route_group(),function ($router) {
        $router->resource('courses', 'CourseController');
        $router->patch('courses/{course}/accept', 'CourseController@accept')->name('courses.accept');
        $router->patch('courses/{course}/reject', 'CourseController@reject')->name('courses.reject');
        $router->patch('courses/{course}/lock', 'CourseController@lock')->name('courses.lock');
        $router->get('courses/{course}/details', 'CourseController@details')->name('courses.details');
        $router->post('courses/{course}/buy', 'CourseController@buy')->name('courses.buy');
        $router->get('courses/{course}/download-links', 'CourseController@downloadLinks')->name('courses.downloadLinks');
    });

    Route::get("/academy/{slug}", 'CourseController@single')->name("singleCourse");
    Route::get("/academy/{id}/demo", 'CourseController@demo_link')->name("singleCourse_demo_link");
    Route::get("/courses/pay","CourseController@pay")->name("course.pay")->middleware("auth");

});

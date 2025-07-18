<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace" => "CMS\Course\Http\Controllers", 'middleware' => 'web'
    ], function () {
    Route::group(get_information_for_admin_panel_route_group(),function ($router) {    $router->patch('seasons/{season}/accept', 'SeasonController@accept')->name('seasons.accept');
        $router->patch('seasons/{season}/reject', 'SeasonController@reject')->name('seasons.reject');
        $router->post('seasons/{course}', 'SeasonController@store')->name('seasons.store');
        $router->get('seasons/{season}', 'SeasonController@edit')->name('seasons.edit');
        $router->patch('seasons/{season}', 'SeasonController@update')->name('seasons.update');
        $router->delete('seasons/{season}', 'SeasonController@destroy')->name('seasons.destroy');
        $router->patch('seasons/{season}/accept', 'SeasonController@accept')->name('seasons.accept');
        $router->patch('seasons/{season}/reject', 'SeasonController@reject')->name('seasons.reject');
        $router->patch('seasons/{season}/lock', 'SeasonController@lock')->name('seasons.lock');
        $router->patch('seasons/{season}/unlock', 'SeasonController@unlock')->name('seasons.unlock');
    });

    Route::get("seasons/{id}/buy", 'SeasonController@buy')->name('seasons.buy');
});

<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\RolePermissions\Http\Controllers",
        "middleware"=>"web"
    ],function () {

//admin panel routes
    Route::group(get_information_for_admin_panel_route_group(), function ($router) {
        $router->resource('role-permissions', 'RolePermissionsController')->except("show");

    });

});

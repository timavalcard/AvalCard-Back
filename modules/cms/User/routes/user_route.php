<?php


use Illuminate\Support\Facades\Route;
use CMS\User\Http\Controllers\Auth\AuthController;
use CMS\User\Models\User;

Route::group(
    [
        "namespace"=>"CMS\User\Http\Controllers",
        "middleware"=>"web"
    ],function (){

//admin panel routes
    Route::group(get_information_for_admin_panel_route_group(),function (){
        Route::get("/user","UserController@list_user")->name("admin_list_user");
        Route::get("/user/add","UserController@add_user_form")->name("admin_add_user");
        Route::post("/user/add","UserController@add_user")->name("admin_add_user");
        Route::get("/user/edit/{id}","UserController@edit_user_form")->name("admin_edit_user");
        Route::post("/user/edit/{id}","UserController@edit_user")->name("admin_edit_user");
        Route::get('update_profile_info',"UserController@update_profile_info")->name('users.update_profile_info');
        Route::post('update_profile', "UserController@update_profile")->name('users.update_profile');
        Route::post('update_password', "UserController@update_password")->name('users.update_password');
        Route::post("/user/group-action","UserController@group_action")->name("admin_users_group_action");

        Route::delete("/user/delete/{id}","UserController@delete_user")->name("admin_delete_user");

    });

//front routes
    Route::post('logout', 'Auth\AuthController@logout')->name('logout');

//Auth route
    Route::group([
            'prefix' => 'authenticate',
            'middleware' => ['web']
        ]
        , function () {
            Route::get('/', [AuthController::class, 'index'])->name('auth.index');
            Route::post('/check_exists_and_status', [AuthController::class, 'check_exists_and_status'])->name('auth.check_exists_and_status');

            Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
            Route::post('/check_code', [AuthController::class, 'check_code'])->name('auth.check_code');
            Route::post('/check_login_code', [AuthController::class, 'check_login_code'])->name('auth.check_login_code');

            Route::post('/login_user', [AuthController::class, 'login_user'])->name('auth.login');
            Route::post('/login_code', [AuthController::class, 'login_code'])->name('auth.login_code');

            Route::post('/logout_user', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');

//        Route::get('/forgot_password_view', [AuthController::class, 'forgot_password_view'])->name('auth.forgot_password_view');
            Route::post('/forgot_password_send', [AuthController::class, 'forgot_password_send'])->name('auth.forgot_password_send');
            Route::post('/forgot_password_check_code', [AuthController::class, 'forgot_password_check_code'])->name('auth.forgot_password_check_code');
        });


    Route::group(["prefix"=>"account","middleware"=>"auth"],function (){
        Route::get("/","UserController@account")->name("user.account");
        Route::get("/edit","UserController@edit_account_form")->name("user.edit");
        Route::post("/edit","UserController@edit_account")->name("user.save");
        Route::get("/orders","UserController@orders")->name("user.orders");
        Route::get("/courses","UserController@courses")->name("user.courses");
        Route::get("/order/{id}","UserController@order")->name("user.order");
        Route::get("/comments","UserController@comments")->name("user.comments");
        Route::get("/address","UserController@address")->name("user.address");
        Route::post("/address","UserController@add_address")->name("user.address");
        Route::get("/address/delete/{index}","UserController@delete_address")->name("user.delete_address");
        Route::get("/wishlist","UserController@wishlist")->name("user.wishlist");
        Route::post("/edit_avatar","UserController@edit_avatar")->name("user.edit_avatar")->middleware("throttle:3,10");
        Route::get("/wallet","\CMS\Wallet\Http\Controllers\WalletController@index")->name("user.wallet");
        Route::get("/transactions","UserController@transactions")->name("user.transactions");

    });


});


<?php
use Illuminate\Support\Facades\Route;

Route::group(["namespace"=>"API\User\Http\Controllers","middleware"=>"web"],function(){
    //admin panel routes
    Route::group(get_information_for_api_route_group(),function (){
        Route::post('/register', "UserController@register");
        Route::post('/register-check-code', "UserController@register_check_code");
        Route::post('/login', "UserController@login");
        Route::post('register-send-code', 'UserController@sendRegisterEmail')->name("api.registerEmail");
        Route::post('reset-password-send-code', 'UserController@sendResetPasswordEmail')->name("api.resetEmail");
        Route::post('reset-password-check-code', 'UserController@ResetPasswordCheckCode')->name("api.resetCheckCOde");
        Route::post('reset-password-update', 'UserController@updatePassword')->name("api.updatePassword");

        Route::post('change-email-send-email', 'UserController@changeEmailSendCode')->name("api.resetEmail");
        Route::post('change-email-check-code', 'UserController@changeEmailCheckCode')->name("api.resetCheckCOde");

        Route::post('login-send-code', 'UserController@loginSendCode')->name("api.loginSendCode");
        Route::post('login-check-code', 'UserController@loginCheckCode')->name("api.loginCheckCode");


        Route::middleware('auth:sanctum')->get('/check-login-status','UserController@checkLoginStatus');
        Route::post('/check-email', "UserController@checkEmail");
        Route::post('/check-email-or-phone', "UserController@checkEmailOrPhone");
        Route::middleware('auth:sanctum')->post('/update-profile', "UserController@updateProfile");
        Route::middleware('auth:sanctum')->post('/change-newsletter', "UserController@changeNewsletter");
        Route::middleware('auth:sanctum')->post('/get-newsletter', "UserController@getNewsletter");
        Route::middleware('auth:sanctum')->post('/submit-author-medical', "UserController@submit");
        Route::middleware('auth:sanctum')->post('/upload-profile', "UserController@upload_profile");
        Route::middleware('auth:sanctum')->post('/delete-profile', "UserController@delete_profile");
        Route::middleware('auth:sanctum')->post('/upload-documents', "UserController@upload_documents");
        Route::middleware('auth:sanctum')->post('/uploaded-documents', "UserController@uploaded_documents");
        Route::middleware('auth:sanctum')->post('/delete-document', "UserController@delete_documents");
        Route::middleware('auth:sanctum')->post('/wallet-transactions', "UserController@wallet_transactions");
        Route::middleware('auth:sanctum')->post('/increase-wallet', "UserController@increase_wallet");
        Route::middleware('auth:sanctum')->post('/update-password', "UserController@update_password");
        Route::middleware('auth:sanctum')->post('/update-profile', "UserController@update_profile");
        Route::middleware('auth:sanctum')->post('/add-address', "UserController@add_address");
        Route::middleware('auth:sanctum')->post('/update-address', "UserController@update_address");
        Route::middleware('auth:sanctum')->post('/delete-address', "UserController@delete_address");
        Route::middleware('auth:sanctum')->post('/add-bank-cart', "UserController@add_bank_cart");
        Route::middleware('auth:sanctum')->post('/update-bank-cart', "UserController@update_bank_cart");
        Route::middleware('auth:sanctum')->post('/delete-bank-cart', "UserController@delete_bank_cart");

        Route::middleware('auth:sanctum')->post('/authorize', "UserController@add_authorize");


        Route::post('/add-newsletter', "UserController@add_newsletter");

        Route::post('/logout', "UserController@logout")->middleware('auth:sanctum');
    });




});

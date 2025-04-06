<?php
use Illuminate\Support\Facades\Route;

Route::group(["namespace"=>"API\User\Http\Controllers","middleware"=>"web"],function(){
    //admin panel routes
    Route::group(get_information_for_api_route_group(),function (){
        Route::post('/register', "UserController@register");
        Route::post('/register-check-code', "UserController@register_check_code");
        Route::post('/login', "UserController@login");
        Route::post('reset-password-send-email', 'UserController@sendResetPasswordEmail')->name("api.resetEmail");
        Route::post('reset-password-check-code', 'UserController@ResetPasswordCheckCode')->name("api.resetCheckCOde");
        Route::post('reset-password-update', 'UserController@updatePassword')->name("api.updatePassword");

        Route::post('change-email-send-email', 'UserController@changeEmailSendCode')->name("api.resetEmail");
        Route::post('change-email-check-code', 'UserController@changeEmailCheckCode')->name("api.resetCheckCOde");

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
        Route::post('/add-newsletter', "UserController@add_newsletter");

        Route::post('/logout', "UserController@logout")->middleware('auth:sanctum');
    });




});

<?php
use Illuminate\Support\Facades\Route;

Route::group(["namespace"=>"API\Ticket\Http\Controllers","middleware"=>"web"],function(){
    //admin panel routes
    Route::group(get_information_for_api_route_group(),function (){
        Route::post("/tickets","TicketController@tickets")->middleware('auth:sanctum')->name("api.tickets");
        Route::post("/ticket-detail","TicketController@ticket_detail")->middleware('auth:sanctum')->name("api.ticket_detail");
        Route::post("/close-ticket","TicketController@close_ticket")->middleware('auth:sanctum')->name("api.close_ticket");
        Route::post("/add-ticket","TicketController@add_ticket")->middleware('auth:sanctum')->name("api.add_ticket");
        Route::post("/answer-ticket","TicketController@answer_ticket")->middleware('auth:sanctum')->name("api.answer_ticket");

    });




});

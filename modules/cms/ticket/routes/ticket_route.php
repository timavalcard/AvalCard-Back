<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        "namespace"=>"CMS\Ticket\Http\Controllers",
        "middleware"=>"web"
    ],function (){

        //admin panel routes
            Route::group(get_information_for_admin_panel_route_group(),function (){
                Route::get("/tickets","TicketController@tickets")->name("tickets.index");
                Route::delete("/ticket/delete/{id}","TicketController@delete_ticket")->name("admin_delete_ticket");
                Route::get("/ticket/ChangeState/{id}","TicketController@ChangeState_ticket")->name("admin_ChangeState_ticket");

                Route::get("/ticket/answer/{id}","TicketController@answer_ticket_form")->name("admin_answer_ticket");
                Route::post("/ticket/answer/{id}","TicketController@answer_ticket")->name("admin_answer_ticket");
                Route::get("/ticket/edit/{id}","TicketController@edit_ticket_form")->name("admin_edit_ticket");
                Route::post("/ticket/edit/{id}","TicketController@edit_ticket")->name("admin_edit_ticket");

            });


        //front routes


});

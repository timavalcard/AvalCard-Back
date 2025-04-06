<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/1/2020
 * Time: 2:13 PM
 */

namespace CMS\Ticket\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Ticket\Http\Requests\TicketRequest;
use CMS\Ticket\Models\Ticket;
use CMS\Ticket\Repository\TicketRepository;
use CMS\Common\Services\CommonService;

class TicketController extends Controller
{

    // admin functions
    public function tickets(Request $request){
        $this->authorize("index",Ticket::class);
        $tickets=TicketRepository::order_ticket($request->orderBy);
        return view("Ticket::Admin.list_ticket",["tickets"=>$tickets]);
    }

    public function delete_ticket($id)
    {
        $this->authorize("delete",Ticket::class);
        TicketRepository::destroy($id);
        return back();
    }
    public function changeState_ticket($id)
    {
        $this->authorize("changeState",Ticket::class);
        $ticket=TicketRepository::find($id);
        TicketRepository::change_state($ticket);
        return back();
    }

    public function answer_ticket_form($id){
        $this->authorize("answer",Ticket::class);
        $ticket=TicketRepository::find($id);
        return view("Ticket::Admin.answer_ticket",["ticket"=>$ticket]);
    }

    public function answer_ticket(TicketRequest $request)
    {
        $this->authorize("answer",Ticket::class);
        TicketRepository::create($request);
        $ticket=Ticket::query()->find($request->ticket_id);
        $ticket->update([
            "status"=>"باز"

        ]);
        return redirect()->route("tickets.index");
    }

    public function edit_ticket_form($id){
        $this->authorize("edit",Ticket::class);
        $ticket=TicketRepository::find($id);
        return view("Ticket::Admin.edit_ticket",["ticket"=>$ticket]);
    }

    public function edit_ticket (TicketRequest $request)
    {

        $this->authorize("update",Ticket::class);
        $ticket=TicketRepository::find($request->id);

       TicketRepository::update($ticket,$request);

        return redirect()->route("tickets.index");
    }
}

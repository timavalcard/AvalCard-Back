<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/1/2020
 * Time: 2:13 PM
 */

namespace CMS\Ticket\Http\Controllers;


use App\Http\Controllers\Controller;
use CMS\Media\Services\MediaFileService;
use CMS\Sms\Services\SmsService;
use CMS\Ticket\Http\Requests\AddTicketRequest;
use CMS\Ticket\Models\TicketMessage;
use CMS\User\Models\User;
use Illuminate\Http\Request;
use CMS\Ticket\Http\Requests\TicketRequest;
use CMS\Ticket\Models\Ticket;
use CMS\Ticket\Repository\TicketRepository;
use CMS\Common\Services\CommonService;
use Illuminate\Support\Str;

class TicketController extends Controller
{

    // admin functions
    public function tickets(Request $request){
        $this->authorize("index",Ticket::class);
        $tickets=TicketRepository::order_ticket($request->status);
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
        if (request()->hasFile('file')) {
            $file = request()->file('file');
            $media=MediaFileService::privateUpload($file);
            $media_id=$media->id;
            $request->request->add(["media_id"=>$media_id]);
        }
        TicketRepository::create($request);
        $ticket=Ticket::query()->find($request->ticket_id);
        $ticket->update([
            "status"=>"پاسخ داده شده"

        ]);
        if($ticket->user){
            $result = SmsService::ultra('answerTicket', [$ticket->id], $ticket->user->mobile);
        }

        return redirect()->back();
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


    public function add_form()
    {
        $this->authorize("answer",Ticket::class);

        $users=User::get()->except("user",auth()->id());

        return view("Ticket::Admin.add_ticket",["users"=>$users]);
    }

    public function add(AddTicketRequest $request)
    {
        $this->authorize("answer",Ticket::class);


        $ticket=Ticket::create([
            "subject" => request()->subject,
            "user_id" => request()->user_id,
            "status" => "در انتظار پاسخ کاربر",
            "department" => request()->department ?? null,
        ]);
        $media_id=null;
        if (request()->hasFile('file')) {
            $file = request()->file('file');
            $media=MediaFileService::privateUpload($file);
            $media_id=$media->id;
        }
        if($ticket->user){
            $result = SmsService::ultra(
                'addTicket',
                [Str::limit(request()->subject, 22)],
                $ticket->user->mobile
            );  }
        $ticketMessage=TicketMessage::create([
            "ticket_id" => $ticket->id,
            "user_id" =>  auth()->id(),
            "message" => request()->message,
            "is_admin" => 1,
            "media_id" => $media_id,
        ]);

        return redirect()->route("tickets.index")->with(["success"=>"تیکت با موفقیت ارسال شد"]);

    }
}

<?php

namespace API\Ticket\Http\Controllers;

use API\Ticket\Http\Resources\TicketResource;
use API\Ticket\Repositories\APITicketRepository;
use App\Http\Controllers\Controller;
use CMS\Common\Services\CommonService;
use CMS\Forms\Repository\FormsRepository;
use CMS\Media\Services\MediaFileService;
use CMS\Ticket\Models\Ticket;
use CMS\Ticket\Models\TicketMessage;
use Illuminate\Http\Request;


class TicketController extends Controller
{
    public function add_ticket(){
        $ticket=Ticket::create([
            "subject" => request()->subject,
            "user_id" => request()->user()->id,
            "status" => "در حال بررسی",
            /*"priority" => ,*/
            "department" => request()->department ?? null,
        ]);
        $media_id=null;
        if (request()->hasFile('file')) {
            $file = request()->file('file');
            $media=MediaFileService::privateUpload($file);
            $media_id=$media->id;
        }

        CommonService::tel_bot("ticket",request()->subject);
        $ticketMessage=TicketMessage::create([
            "ticket_id" => $ticket->id,
            "user_id" =>  request()->user()->id,
            "message" => request()->message,
            "is_admin" => 0,
            "media_id" => $media_id,
        ]);
        return new TicketResource($ticket);
    }

    public function answer_ticket(){
        $ticket=Ticket::query()->where("user_id",request()->user()->id)->where("id",request()->id)->firstOrFail();
        $ticket->update([
            "status"=>"در حال بررسی"
        ]);

        $media_id=null;
        if (request()->hasFile('file')) {
            $file = request()->file('file');
            $media=MediaFileService::privateUpload($file);
            $media_id=$media->id;
        }
        CommonService::tel_bot("ticket",$ticket->subject);
        $ticketMessage=TicketMessage::create([
            "ticket_id" => $ticket->id,
            "user_id" => request()->user()->id ?? null,
            "message" => request()->message,
            "is_admin" => 0,
            "media_id" => $media_id,
        ]);
        return new TicketResource($ticket);
    }


    public function tickets(){
        $tickets=Ticket::query()->where("user_id",request()->user()->id)->orderByDesc("created_at")->get();
        if($tickets){
            return  TicketResource::collection($tickets);
        }
        return null;
    }

    public function ticket_detail(Request $request){

        $ticket=Ticket::query()->where("user_id",$request->user()->id)->findOrFail(request()->id);
        if($ticket){
            return new TicketResource($ticket);
        }


    }

    public function close_ticket(Request $request){
        $ticket=Ticket::query()->where("user_id",$request->user()->id)->findOrFail(request()->id);
        if($ticket){
            $ticket->status="بسته شده";
            $ticket->save();
        }
    }
}











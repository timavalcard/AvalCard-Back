<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/1/2020
 * Time: 2:37 PM
 */

namespace CMS\Ticket\Repository;


use CMS\Ticket\Models\Ticket;
use CMS\Ticket\Models\TicketMessage;

class TicketRepository
{
    public static function find($id)
    {
        return Ticket::findOrFail($id);
    }
    public static function order_ticket($order="all")
    {
        $order=$order==null ? "all" : $order;
        switch ($order){
            case "all":
                $tickets = Ticket::query()->orderByDesc("created_at")->paginate(10);
                break;
            case "unapproved":
                $tickets = Ticket::query()->orderByDesc("created_at")->paginate(10);
                break;
            case "approved":
                $tickets = Ticket::query()->orderByDesc("created_at")->paginate(10);
                break;
        }

        return $tickets;
    }

    public static function destroy($id)
    {
        Ticket::destroy($id);
    }

    public static function whereIn($ids)
    {
        return Ticket::whereIn("id",$ids)->get();
    }

    public static function update_ticket_to_unApprove(Ticket $ticket)
    {
        $ticket->update([
            "status"=>false,

        ]);
    }

    public static function update_ticket_to_Approve(Ticket $ticket)
    {
        $ticket->update([
            "status"=>true,

        ]);
    }

    public static function change_state(Ticket $ticket)
    {
        $ticket->update([
            "status"=>!$ticket->status,

        ]);
    }


    public static function create($data,$status=0)
    {
        return TicketMessage::create([
            "ticket_id" => $data->ticket_id,
            "user_id" => $data->user_id ?? null,
            "message" => $data->message,
            "is_admin" => $data->is_admin ?? false,
            "media_id" => $data->media_id ?? null,
        ]);
    }

    public static function update(Ticket $ticket,$data)
    {
        $ticket->update([
            "text"=>$data->text,
            "email"=>$data->email,
            "name"=>$data->name,
        ]);
    }
    public static function get_newest_tickets()
    {
        return Ticket::query()->limit(7)->get();
    }
}

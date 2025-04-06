<?php


namespace API\Ticket\Http\Resources;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'subject' => $this->subject,
            'status' => $this->status,

            'department' => $this->department,
            'messages' => TicketMessageResource::collection($this->messages),
            'updated_at' => Carbon::parse($this->updated_at)->format("d-m-Y"),
            'created_at' => Carbon::parse($this->created_at)->format("d-m-Y"),

        ];
    }
}

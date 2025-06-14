<?php


namespace API\Ticket\Http\Resources;


use API\User\Http\Resources\UserResource;
use Carbon\Carbon;
use CMS\User\Repositories\UserRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;

class TicketMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user=UserRepository::find($this->user_id);
        return [
            'id' => $this->id,
            'ticket_id' => $this->ticket_id,
            'user'=>new UserResource($user),
            'message' => $this->message,
            'is_admin' => $this->is_admin,
            'media' => [
                "alt"=>$this->media->alt ?? null,
                "url"=>$this->media->url ?? null,
            ],
            'updated_at' => IR_TimestampToDate(Carbon::parse($this->updated_at)->format("d-m-Y H:i"), 'Y/n/j H:i'),
            'created_at' => IR_TimestampToDate(Carbon::parse($this->created_at)->format("d-m-Y H:i"), 'Y/n/j H:i'),

        ];
    }
}

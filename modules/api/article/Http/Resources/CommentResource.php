<?php


namespace API\Article\Http\Resources;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;

class CommentResource extends JsonResource
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
            'text' => $this->text,
            'name' => $this->name,
            'parent_id' => $this->parent_id,
            'children' => CommentChildrenResource::collection($this->children),
            'email' => $this->email,
            'avatar'=>$this->user ?$this->user->profile_avatar : "",
            'created_at' => IR_TimestampToDate(Carbon::parse($this->created_at)->format("d-m-Y"),'Y/n/j'),
            'updated_at' => IR_TimestampToDate(Carbon::parse($this->updated_at)->format("d-m-Y"),'Y/n/j'),

        ];
    }
}

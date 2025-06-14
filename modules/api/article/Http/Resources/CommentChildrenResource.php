<?php


namespace API\Article\Http\Resources;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;

class CommentChildrenResource extends JsonResource
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
            'email' => $this->email,
            'avatar'=>$this->user ?$this->user->profile_avatar : "",
            'created_at' => toShamsi($this->created_at),
            'updated_at' => Carbon::parse($this->updated_at)->format("d-m-Y"),

        ];
    }
}

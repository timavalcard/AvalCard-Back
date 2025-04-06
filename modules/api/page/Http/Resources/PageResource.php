<?php


namespace API\Page\Http\Resources;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;

class PageResource extends JsonResource
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
            'content' => $this->content,
            'url' => $this->url,
            'updated_at' => Carbon::parse($this->updated_at)->format("d-m-Y"),
            'meta_description'=>isset($this->post_meta_array["meta_description"]) && !is_null($this->post_meta_array["meta_description"]) ? $this->post_meta_array["meta_description"]  : '',
            'meta_title'=>isset($this->post_meta_array["meta_title"]) && !is_null($this->post_meta_array["meta_title"]) ? $this->post_meta_array["meta_title"]  : $this->title ,
            'meta_index'=>isset($this->post_meta_array["meta_index"]) && !is_null($this->post_meta_array["meta_index"]) ? $this->post_meta_array["meta_index"]  : "index" ,
            'meta_follow'=>isset($this->post_meta_array["meta_follow"]) && !is_null($this->post_meta_array["meta_follow"]) ? $this->post_meta_array["meta_follow"]  : "follow" ,

        ];
    }
}

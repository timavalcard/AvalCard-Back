<?php


namespace API\Article\Http\Resources;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $author=[];
        if($this->user){
            $author=[
                "name"=>$this->user->name,
                "avatar"=>$this->user->profile_avatar,
                "last_name"=>$this->user->last_name,
                "url"=>$this->user->url,
                "id"=>$this->user->id,
            ];
        }



        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'url' => $this->url,
            'excerpt' => $this->post_excerpt,
            'content' => $this->content,
            "resource"=>$this->getAttribute('resource'),
            'created_at' => toShamsi($this->created_at),
            'updated_at' => Carbon::parse($this->updated_at)->format("d-m-Y"),
            'author' => $author,
            'media' => [
                "alt"=>$this->media->alt ?? null,
                "url"=>$this->media->url ?? null,
            ],
            'category' => CategoryResource::collection($this->category),
            'meta_description'=>isset($this->post_meta_array["meta_description"]) && !is_null($this->post_meta_array["meta_description"]) ? $this->post_meta_array["meta_description"]  : strip_tags(substrwords($this->content,160)),
            'meta_title'=>isset($this->post_meta_array["meta_title"]) && !is_null($this->post_meta_array["meta_title"]) ? $this->post_meta_array["meta_title"]  : $this->title ,
            'meta_index'=>isset($this->post_meta_array["meta_index"]) && !is_null($this->post_meta_array["meta_index"]) ? $this->post_meta_array["meta_index"]  : "index" ,
            'meta_follow'=>isset($this->post_meta_array["meta_follow"]) && !is_null($this->post_meta_array["meta_follow"]) ? $this->post_meta_array["meta_follow"]  : "follow" ,

        ];
    }
}

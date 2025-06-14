<?php


namespace API\Product\Http\Resources;


use Carbon\Carbon;
use CMS\Product\Repository\ProductRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;

class ChildrenProductResource extends JsonResource
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
        $attributes=ProductRepository::get_use_for_product_attribute($this);



        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'url' => $this->url,
            'excerpt' => $this->post_excerpt,
            'content' => $this->content,

            'created_at' => IR_TimestampToDate(Carbon::parse($this->created_at)->format("d-m-Y"),'Y/n/j'),
            'updated_at' => Carbon::parse($this->updated_at)->format("d-m-Y"),
            'author' => $author,
            'attributes' => $attributes,
            'price' => $this->product_price(),
            'offerpercent' => $this->offerpercent,
            'media' => [
                "alt"=>$this->media->alt ?? null,
                "url"=>$this->media->url,
            ],

        ];
    }
}

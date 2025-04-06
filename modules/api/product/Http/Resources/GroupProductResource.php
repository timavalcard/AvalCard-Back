<?php


namespace API\Product\Http\Resources;


use Carbon\Carbon;
use CMS\Group_Product\Models\GroupChildrenProduct;
use CMS\Product\Models\Product;
use CMS\Product\Repository\ProductRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;

class GroupProductResource extends JsonResource
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
        $products=null;
        foreach ($this->children_products as $children_product){
            $product=GroupChildrenProduct::find($children_product);
            //dd($product);
            if($product){
                $products[]=new ChildrenProductResource($product);
            }
        }


        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'url' => $this->url,
            'excerpt' => $this->post_excerpt,
            'content' => $this->content,
             "resource"=>$this->getAttribute('resource'),
            'created_at' => IR_TimestampToDate(Carbon::parse($this->created_at)->format("d-m-Y"),'Y-n-j'),
            'updated_at' => Carbon::parse($this->updated_at)->format("d-m-Y"),
            'author' => $author,
            'price' => "",
            'offerpercent' => false,
            'products'=>$products,
            'media' => [
                "alt"=>$this->media->alt ?? null,
                "url"=>$this->media->url,
            ],
            'category' => CategoryResource::collection($this->category),
            'meta_description'=>isset($this->post_meta_array["meta_description"]) && !is_null($this->post_meta_array["meta_description"]) ? $this->post_meta_array["meta_description"]  : strip_tags(substrwords($this->content,160)),
            'meta_title'=>isset($this->post_meta_array["meta_title"]) && !is_null($this->post_meta_array["meta_title"]) ? $this->post_meta_array["meta_title"]  : $this->title ,
            'meta_index'=>isset($this->post_meta_array["meta_index"]) && !is_null($this->post_meta_array["meta_index"]) ? $this->post_meta_array["meta_index"]  : "index" ,
            'meta_follow'=>isset($this->post_meta_array["meta_follow"]) && !is_null($this->post_meta_array["meta_follow"]) ? $this->post_meta_array["meta_follow"]  : "follow" ,

        ];
    }
}

<?php


namespace API\Category\Http\Resources;


use API\Product\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Article\Http\Resources\ArticleResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $products=null;
        if($this->type == "product"){
            $products=ProductResource::collection($this->products()->orderByDesc("created_at")->get());
        }

        return [
            'id' => $this->id,
            'title' => $this->name,
            'slug' => $this->slug,
            'url' => $this->url,
            /*'parent' => $this->parent2,
            'children' => $this->children,*/
            'media' => [
                "alt"=>$this->media->alt ?? null,
                "url"=>$this->media->url ?? null,
            ],
            "products"=>$products

        ];
    }
}

<?php


namespace API\Category\Http\Resources;


use API\Product\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Article\Http\Resources\ArticleResource;

class CategoryWithoutProductResource extends JsonResource
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
            'title' => $this->name,
            'slug' => $this->slug,
            'url' => $this->url,
            /*'parent' => $this->parent2,
            'children' => $this->children,*/
            'media' => [
                "alt"=>$this->media->alt ?? null,
                "url"=>$this->media->url ?? null,
            ],

        ];
    }
}

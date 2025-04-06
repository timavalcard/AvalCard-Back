<?php


namespace API\Category\Http\Resources;


use API\Category\Repositories\APICategoryRepository;
use API\Product\Http\Resources\GroupProductResource;
use API\Product\Http\Resources\ProductResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use API\Article\Http\Resources\ArticleResource;
use Illuminate\Support\Str;

class SingleProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $parent=[];
        if($this->type=="group_product") {
            $products = GroupProductResource::collection(APICategoryRepository::latest_products($this, request()->limit));
        } else{
            $products = ProductResource::collection(APICategoryRepository::latest_products($this, request()->limit));

        }
        if($products->resource instanceof LengthAwarePaginator){
            $pagination=[
                'per_page'=>$products->perPage() ,
                'total'=>$products->total() ,
                'last_page'=>$products->lastPage() ,
                'current_page'=>$products->currentPage() ,
            ];
        }
        return [
            'id' => $this->id,
            'title' => $this->name,
            'slug' => $this->slug,
            'url' => $this->url,
            'parent' => $parent,
            'description' => $this->contents,
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d'),

            'children' => $this->children,
            'products' => $products,
            'media' => [
                "alt"=>$this->media->alt ?? null,
                "url"=>$this->media->url ?? null,
            ],
            'meta_description'=>isset($this->post_meta_array["meta_description"]) && !is_null($this->post_meta_array["meta_description"]) ? $this->post_meta_array["meta_description"]  : strip_tags(substrwords($this->contents,160)),
            'meta_title'=>isset($this->post_meta_array["meta_title"]) && !is_null($this->post_meta_array["meta_title"]) ? $this->post_meta_array["meta_title"]  : $this->name ,
            'meta_index'=>isset($this->post_meta_array["meta_index"]) && !is_null($this->post_meta_array["meta_index"]) ? $this->post_meta_array["meta_index"]  : "index" ,
            'meta_follow'=>isset($this->post_meta_array["meta_follow"]) && !is_null($this->post_meta_array["meta_follow"]) ? $this->post_meta_array["meta_follow"]  : "follow" ,
            'pagination'=>$pagination??null

        ];
    }
}

<?php


namespace API\Product\Http\Resources;


use API\Category\Http\Resources\CategoryWithoutProductResource;
use Carbon\Carbon;
use CMS\Product\Repository\ProductRepository;
use CMS\Product\Repository\ProductVariationRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;

class ProductResource extends JsonResource
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
        $table_variations=false;
        $in_stock_variations=[];
        if($this->type== $this->type_variable){
            $variations=ProductVariationRepository::get_product_variation($this);
            foreach ($variations as $variation) {
                if(ProductRepository::in_stock($this,1,$variation["id"])){
                    $variation['price']=convertToRial($variation['price'],$variation['currency']);

                    $variation['offer_price']=convertToRial($variation['offer_price'],$variation['currency']);
                    $in_stock_variations[]=$variation;
                }
            }

            $table_variations=[];
            foreach ($in_stock_variations as $variation){
                foreach ($variation["variations"] as $variation_id=>$variation_item) {
                    if(isset($table_variations[$variation_id])){

                        $duplicate_variation=true;

                        foreach ($table_variations[$variation_id]["item"] as $item) {
                            if(isset($item["id"]) && (is_array($variation_item[0]) || $variation_item[0]->isNotEmpty())){

                                if($item["id"] == $variation_item[0]["id"]){
                                    $duplicate_variation=false;
                                }
                            }

                        }
                        if($duplicate_variation) $table_variations[$variation_id]["item"][]=$variation_item[0];

                    } else{
                        $table_variations[$variation_id]["item"]=[$variation_item[0]];
                        $table_variations[$variation_id]["parentName"]=$variation_item["parentName"]["name"];
                    }
                }

            }


        }



        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'url' => $this->url,
            'type' => $this->type,
            'fee_percent' => $this->fee_percent ?? 0,
            'excerpt' => $this->post_excerpt,
            'content' => $this->content,
             "resource"=>$this->getAttribute('resource'),
            'created_at' => IR_TimestampToDate(Carbon::parse($this->created_at)->format("d-m-Y"),'Y/n/j'),
            'updated_at' => Carbon::parse($this->updated_at)->format("d-m-Y"),
            'author' => $author,
            'attributes' => $attributes,
            'table_variations' => $table_variations,
            'in_stock_variations' => $in_stock_variations,
            'time_to_send' => $this->time_to_send,
            'send_price' => $this->send_price,
            'user_info' => $this->user_info,
            'regular_price' => convertToRial($this->regular_price,$this->currency),
            'currency_price' => $this->regular_price,
            'offer_price' => convertToRial($this->offer_price,$this->currency),
            'currency'=>$this->currency,
            'dollar_price' => convertToRial(1,"137203"),
            'offerpercent' => $this->offerpercent,
            'faq' => $this->faq,
            'media' => [
                "alt"=>$this->media->alt ?? null,
                "url"=>$this->media->url?? "https://avalcard.com/img/Placeholder_view_vector.svg.png",
            ],
            'category' => CategoryWithoutProductResource::collection($this->category),
            'meta_description'=>isset($this->post_meta_array["meta_description"]) && !is_null($this->post_meta_array["meta_description"]) ? $this->post_meta_array["meta_description"]  : strip_tags(substrwords($this->content,160)),
            'meta_title'=>isset($this->post_meta_array["meta_title"]) && !is_null($this->post_meta_array["meta_title"]) ? $this->post_meta_array["meta_title"]  : $this->title ,
            'meta_index'=>isset($this->post_meta_array["meta_index"]) && !is_null($this->post_meta_array["meta_index"]) ? $this->post_meta_array["meta_index"]  : "index" ,
            'meta_follow'=>isset($this->post_meta_array["meta_follow"]) && !is_null($this->post_meta_array["meta_follow"]) ? $this->post_meta_array["meta_follow"]  : "follow" ,

        ];
    }
}

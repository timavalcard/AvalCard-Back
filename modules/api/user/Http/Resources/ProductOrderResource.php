<?php


namespace API\User\Http\Resources;


use API\Product\Http\Resources\ProductResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;
use CMS\Order\Repository\OrderRepository;
use CMS\Product\Service\ProductService;

class ProductOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $products=ProductService::get_cart_products($this->products_id);
        $products_array=[];
        foreach($this->products_id as $parent2_cart_product){
                if(isset($parent2_cart_product["id"])){
                    $product=$products->where("id",$parent2_cart_product["id"])->first();
                    if($product){
                        $products_array[]=$product;
                    }
                }


        }


        return [
            "price"=>$this->formated_price,
            "status"=>$this->status_html,
            "id"=>$this->id,
            "created_at"=>toShamsi($this->created_at),
            "products"=>ProductResource::collection($products_array),
        ];
    }
}

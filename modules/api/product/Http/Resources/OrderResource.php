<?php


namespace API\Product\Http\Resources;


use Carbon\Carbon;
use CMS\Cart\Repository\CartRepository;
use CMS\Product\Models\Product;
use CMS\Product\Repository\ProductRepository;
use CMS\Product\Repository\ProductVariationRepository;
use CMS\Product\Service\ProductService;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $cart_products=ProductService::get_cart_products($this->products_id,$this->user);
        $cart_products_total_price=ProductService::get_cart_products_total_price();
        $cart_products_total_number=ProductService::get_cart_products_total_number();
        $order_variations="";
        $products=[];
        foreach ($this->products_id as $cartItem){
            $firstItem = reset($cartItem);
            $product=Product::find($firstItem["id"]);
            $variations=null;
            if(isset($firstItem["variation"])){
                $variations=$product->get_variation_by_value($firstItem["variation"]);
            }
            $product["price"]=$product->product_price_with_quantity($firstItem["quantity"],$firstItem["variation"]);
            $product["variations"]=$variations;
            if($variations){
                $order_variations=$variations;
            }
            $product["variation_id"]=$firstItem["variation"];
            $product["quantity2"]=$firstItem["quantity"];
            $product["media_data"]= [
                "alt"=>$product->media->alt ?? null,
                "url"=>$product->media->url?? "https://avalcard.com/img/Placeholder_view_vector.svg.png",
            ];
            $products[]=$product;
        }

        $order_title=$cart_products[0]->title;
        return [
            'id' => $this->id,
            'order_type' => $this->order_type,
            'order_title' => $order_title,
            'variations' => $order_variations,
            'price' => format_price_with_currencySymbol($this->price),
            'coupon_name' => $this->coupon_name,
            'coupon_discount' => $this->coupon_discount,
            'status' => $this->status,
            'comment' => $this->comment,
            'payment_type' => $this->payment_type,
            'delivery_status' => $this->delivery_status,
            'post_tracking_code' => $this->post_tracking_code,
            'address' => $this->address,
            'factor' => $this->factor,
            'products' => $products,
            'created_at' => IR_TimestampToDate(Carbon::parse($this->created_at)->format("d-m-Y"),'Y/n/j'),
            'updated_at' => Carbon::parse($this->updated_at)->format("d-m-Y"),
        ];
    }
}

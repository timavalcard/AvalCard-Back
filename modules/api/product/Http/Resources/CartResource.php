<?php


namespace API\Product\Http\Resources;


use Carbon\Carbon;
use CMS\Cart\Repository\CartRepository;
use CMS\Club\Services\ClubService;
use CMS\Group_Product\Models\GroupChildrenProduct;
use CMS\Product\Models\Product;
use CMS\Product\Repository\ProductRepository;
use CMS\Product\Service\CouponService;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;
use CMS\Product\Service\ProductService;
use CMS\Shop\Service\ShopService;
use CMS\Wallet\Services\WalletService;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product=Product::find($this["id"]);

            $productObj=new ProductResource($product);

        $cart=CartRepository::get_cart($request->user());
        ProductService::get_cart_products($cart);
        $amount=ProductService::get_cart_products_total_price(false);

        $cart_products_total_price=ProductService::get_cart_products_total_price(true,null,false);
        $total_price=ShopService::add_delivery_price_to_amount($amount);
        $total_price=format_price_with_currencySymbol($total_price);
        $cart_products_offer_price=ProductService::get_cart_products_offer_price();
        $delivery_price=ShopService::get_delivery_price($amount);

        if($product){
            return [
                "id"=>$this["id"],
                "product"=>$productObj,
                "quantity"=>$this["quantity"],
                "total_price"=>$total_price,
                "coupon_price"=>$total_price,
                "cart_products_offer_price"=>$cart_products_offer_price,
                "delivery_price"=>$delivery_price,
                "cart_products_total_price"=>$cart_products_total_price,
            ];
        }
        return [];


    }
}

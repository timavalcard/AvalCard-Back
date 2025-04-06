<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/17/2020
 * Time: 1:09 PM
 */

namespace CMS\Product\Service;


use CMS\Cart\Repository\CartRepository;
use CMS\Group_Product\Repository\GroupProductRepository;
use CMS\Product\Models\Product;
use CMS\Product\Repository\ProductRepository;
use CMS\Product\Repository\ProductVariationRepository;
use CMS\ProductAttr\Repository\ProductAttrRepository;

class ProductService
{
    public static $products=[];
    public static $product_quantity=[];
    public static $product_variation=[];
    public static $product_group=[];
    public static function get_product_attribute_parent_and_value_id_and_name($attributes)
    {
        $attributeItem=[];
        foreach ($attributes as $attribute){
            $attributeItem[$attribute->id]["parent"]=$attribute->attribute->only("id","name");
            foreach($attribute->values as $value){
                $attributeItem[$attribute->id]["values"][]=ProductAttrRepository::find($value)->only("id","name");
            }

        }
        return $attributeItem;
    }


    public static function get_cart_products($cart)
    {
        if($cart) {

            foreach ($cart as $parent2_cart_product) {
                foreach ($parent2_cart_product as $parent_cart_product) {
                    $product = Product::query()->where("id", $parent_cart_product["id"])->first();

                    if(!$product){
                        CartRepository::delete_cart_item($parent_cart_product["id"]);
                        unset($cart[$parent_cart_product["id"]]);
                    } else{
                        $variation_id=$parent_cart_product["variation"];

                        if($variation_id){
                            $variation=ProductVariationRepository::find_variation($variation_id,false);
                            if(!$variation){
                                CartRepository::delete_cart_item($parent_cart_product["id"],$variation_id);
                                unset($cart[$parent_cart_product["id"]][$variation_id]);
                                if(empty($cart[$parent_cart_product["id"]])){
                                    unset($cart[$parent_cart_product["id"]]);
                                }
                            }
                        }

                    }
            }
        }

            $product_id=array_keys($cart);
            $product_quantity=[];
            $product_variation=[];
            $product_group=[];

            foreach ($cart as $cart_item_product_id=>$cart_item) {
                foreach ($cart_item as $item){

                    $product_quantity[$cart_item_product_id][$item["variation"]]=$item["quantity"];
                    $product_variation[$cart_item_product_id]=$item["variation"] ?? null;
                    $product_group[$cart_item_product_id]=$item["group_product"]?? null;
                }

            }
            $products=ProductRepository::get_multiple_product_prices($product_id);
            self::$products=$products;
            foreach (self::$products as $key=>$product) {
                if($product->product_type=="group_product"){
                    $products[$key]=ProductRepository::get_group_product_prices($product->id);
                }
            }



            self::$product_variation=$product_variation;
            self::$product_quantity=$product_quantity;
            self::$product_group=$product_group;
            return $products;
        }

    }

    public static function get_cart_products_total_price($format=true,$product=null,$with_coupon=true,$variation=null)
    {
        if(!empty(session()->get("coupon_amount")) && $with_coupon){
            $amount=session()->get("coupon_amount");
            if($format){
                return format_price_with_currencySymbol($amount);

            }
            return $amount;
        } else{
            $products=self::$products;
            if($product){
                $products=$product;
            }
            $cart=CartRepository::get_cart();
            $product_quantity=self::$product_quantity;
            $product_variation=self::$product_variation;
            $product_group=self::$product_group;

            if($products){
                $total_price=0;
                if($cart){
                    foreach ($cart as $parent2_cart_product) {
                        foreach($parent2_cart_product as $parent_cart_product){
                            $product=$products->where("id",$parent_cart_product["id"])->first();
                            if(!$product){
                                unset($parent_cart_product["id"]);
                            }
                            elseif((!$variation && !$product_variation[$product->id]) || $product->type != $product->type_variable) {

                                $products_meta = $product->post_meta;

                                $product_price=$product->offer_price;
                                if(!$product_price){
                                    $product_price=$product->regular_price;
                                }
                                $total_price+=$product_price * $product_quantity[$products_meta[0]->post_metaable_id][null];

                            }

                            else{
                                $variation=$parent_cart_product["variation"];
                                $variation=ProductVariationRepository::find_variation($variation);


                                if(isset($variation->offer_price) && !empty($variation->offer_price)){
                                    $product_price=$variation->offer_price;

                                } elseif (isset($variation->price)){
                                    $product_price=$variation->price;
                                }
                                $total_price+=$product_price * $parent_cart_product["quantity"];
                            }


                        }
                    }
                }


                if($format){
                    return format_price_with_currencySymbol($total_price);

                } else{
                    return  $total_price;
                }
            }

        }
        return null;
    }


    public static function get_cart_products_offer_price($variation=null){
        $products=self::$products;
        $product_quantity=self::$product_quantity;
        $product_variation=self::$product_variation;

        if($products){
            $total_offer_price=0;
            foreach ($products as $product) {
                if((!$variation && !$product_variation[$product->id]) || $product->type != $product->type_variable) {
                    $products_meta = $product->post_meta;
                    if (isset($products_meta[1])) {
                        $offer_price = $products_meta[1]->meta_value;
                        $price = $products_meta[0]->meta_value;
                        $new_price = ($price - $offer_price) * $product_quantity[$products_meta[0]->post_metaable_id][null];
                        $total_offer_price += $new_price;

                    }
                } else{
                    if(!$variation) $variation=$product_variation[$product->id];
                    $variation=ProductVariationRepository::find_variation($variation);
                    if(isset($variation->offer_price) && !empty($variation->offer_price)){
                        $offer_price = $variation->offer_price;
                        $price = $variation->price;
                        $new_price = ($price - $offer_price) * $product_quantity[$variation->product_id][$variation->id];
                        $total_offer_price += $new_price;
                    }
                }


            }
            return format_price_with_currencySymbol($total_offer_price);
        }

    }

    public static function get_cart_products_total_number()
    {
        $product_quantity=self::$product_quantity;
        $total_quantity=0;
        if(!empty($product_quantity)){
            foreach ($product_quantity as $parent_quantity){
                foreach ($parent_quantity as $quantity){
                    $total_quantity+=$quantity;
                }
            }
        }
        return $total_quantity;

    }

    public static function if_product_in_stock_decrease_stock_number($products,$cart=null){
        if(!$cart)$cart=CartRepository::get_cart();
        foreach($cart as $parent2_cart_product){
            foreach($parent2_cart_product as $parent_cart_product){
                $cart_product=$products->where("id",$parent_cart_product["id"])->first();
                $quantity=$parent_cart_product["quantity"];

                if(ProductRepository::in_stock($cart_product,$quantity,$parent_cart_product["variation"])){
                    ProductRepository::decrease_stock_number($cart_product,$quantity,$parent_cart_product["variation"]);
                } else{
                    $message="در انبار موجود نیست".$quantity."به تعداد: ".$cart_product->title."محصول : ";
                    toastMessage($message,"در انبار موجود نیست" ,"info");
                    return redirect()->route("cart.index");
                }
            }

        }



    }
}

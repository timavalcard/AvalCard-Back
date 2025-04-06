<?php
namespace CMS\Product\Repository;

use Illuminate\Support\Str;
use CMS\Category\Models\Category;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Models\Product;
use CMS\Product\Models\ProductAttribute;
use CMS\Product\Models\ProductVariation;
use CMS\Product\Service\ProductService;
use CMS\ProductAttr\Models\Attribute;
use CMS\ProductAttr\Repository\ProductAttrRepository;

class ProductVariationRepository
{
    public static function create_product_variation($product,$request)
    {
        foreach ($request->variable_price as $key=>$price) {

            $id=false;
            if(isset($request->variable_id[$key])){
                $id=$request->variable_id[$key];
            }
            $offer_price=null;
            $offer_1_min=null;
            $offer_1_percent=null;
            $offer_2_min=null;
            $offer_2_percent=null;
            if(isset($request->variable_offer_price[$key])){
                $offer_price=$request->variable_offer_price[$key];

            }
            $width=$request->variable_width[$key];
            $height=$request->variable_height[$key];
            $weight=$request->variable_weight[$key];
            $length=$request->variable_length[$key];
            $priority=$request->variation_priority[$key];
            $currency=$request->variation_currency[$key];
            if(isset($request->variable_offer_1_min[$key])){
                $offer_1_min=$request->variable_offer_1_min[$key];
                $offer_1_percent=$request->variable_offer_1_percent[$key];
                $offer_2_min=$request->variable_offer_2_min[$key];
                $offer_2_percent=$request->variable_offer_2_percent[$key];
            }


            $variations=$request->attribute_select[$key];

            $sku=$request->variable_sku[$key];
            isset($request->variable_manage_stock[$key]) ? $manage_stock=$request->variable_manage_stock[$key] : $manage_stock=false;
            if($manage_stock){
                $stock_number=$request->variable_stock_number[$key];
                $low_stock_amount=$request->variable_low_stock_amount[$key];
            } else{
                $stock_number=null;
                $low_stock_amount=null;
            }
            if($id){
                $product->variations()->where("id",$id)->update([
                    "variations"=>$variations,
                    "offer_price"=>$offer_price,
                    "weight"=>$weight,
                    "width"=>$width,
                    "height"=>$height,
                    "length"=>$length,
                    "price"=>$price,
                    "sku"=>$sku,
                    "priority"=>$priority,
                    "currency"=>$currency,
                    "manage_stock"=>$manage_stock,
                    "stock_number"=>$stock_number,
                    "low_stock_amount"=>$low_stock_amount,

                ]);
            } else{
                $product->variations()->create([
                        "variations"=>$variations,
                        "offer_price"=>$offer_price,
                        "weight"=>$weight,
                        "width"=>$width,
                        "height"=>$height,
                        "length"=>$length,
                        "price"=>$price,
                        "sku"=>$sku,
                        "currency"=>$currency,
                        "manage_stock"=>$manage_stock,
                        "stock_number"=>$stock_number,
                        "low_stock_amount"=>$low_stock_amount,

                    ]
                );

            }
        }
    }

    public static function get_product_variation($product)
    {
        $variations = $product->variations()->orderBy("priority")->get()->toArray();
        foreach ($variations as $key => $variation) {
            foreach ($variation["variations"] as $keyItem => $value) {
                $variations[$key]["variations"][$keyItem] = [
                    "parentName" => self::find($keyItem)->only("name"),
                    self::find($value) ? self::find($value)->only("name", "id","color") : null
                ];
            }
        }

        return $variations;

    }

    public static function find($id)
    {
        return Attribute::find($id)?: collect([]);
    }

    public static function find_variation($id,$callback=true){
        $variation= ProductVariation::find($id);
        if($variation) return $variation;
        if($callback){
            toastMessage("متغیر مورد نظر شما موجود نیست","","info");
            return back();
        }
        return null;

    }


    public static function delete_product_variation($product)
    {
        $product->variations()->delete();
    }

    public static function delete_product_one_variation($variationId)
    {
        return ProductVariation::destroy($variationId);
    }

    public static function get_biggest_price_variation($product){
        return $product->variations()->whereNotNull("price")->orderBy("price")->orderBy("offer_price")->first();
    }
    public static function get_first_price_variation($product){
        return $product->variations()->orderBy("priority")->whereNotNull("price")->first();
    }
    public static function get_first_currency_variation($product){
        return $product->variations()->orderBy("priority")->whereNotNull("currency")->first();
    }
    public static function get_one_in_stock_variation($product){
        return $product->variations()->where("manage_stock","on")->orderBy("stock_number")->first();
    }

    public static function update_stock_number($variation,$number){
        if(is_numeric($variation)) $variation=ProductVariationRepository::find_variation($variation);
        $variation->update(["stock_number"=>$number]);
    }


    public static function get_attribute_by_variation_id($variation_id){
        $variation=ProductVariationRepository::find_variation($variation_id);

        $variation_attributes_id=$variation->attributes;
        $attributes=[];
        foreach ($variation_attributes_id as $attribute_id=>$attribute_value) {
            $attribute=ProductAttrRepository::get_attr_with_children($attribute_id,$attribute_value);
            $attributes[]=$attribute;
        }
        return $attributes;

    }
}

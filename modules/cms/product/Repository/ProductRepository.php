<?php
namespace CMS\Product\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use CMS\Brand\Models\Brand;
use CMS\Category\Models\Category;
use CMS\Group_Product\Models\GroupChildrenProduct;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Models\Product;
use CMS\Product\Models\ProductAttribute;
use CMS\Product\Models\Wishlist;
use CMS\Product\Service\ProductService;
use CMS\ProductAttr\Repository\ProductAttrRepository;

class ProductRepository
{
    public static function find($id)
    {
        return Product::findOrFail($id);
    }
    public static function find_not_fail($id)
    {
        return Product::find($id);
    }
    public static function find2($id)
    {
        return Product::find($id);
    }
    public static function get()
    {
        return Product::get();
    }
    public static function getPublished()
    {
        return Product::query()->where("status","publish")->get();
    }
    public static function getShowedProduct(){
        return Product::query()->where("status","publish")->where("product_type","product");
    }
    public static function find_by_slug($slug)
    {
        return Product::query()->where("status","publish")->where("slug",$slug)->firstOrFail();
    }

    public static function pagination($num=12)
    {
        return Product::query()->where("status","publish")->where("product_type","product")->paginate($num);
    }

    public static function limit($limit=10)
    {

        return self::getShowedProduct()->get()->filter(function ($product) {
            if($product->manage_stock){
                if($product->stock_number > 0){
                    return true;
                }
            } else{
                return true;
            }
        })->take($limit);
    }
    public static function limit_by_random($limit=10){
        return self::getShowedProduct()->inRandomOrder()->get()->filter(function ($product) {
            if($product->manage_stock){
                if($product->stock_number > 0){
                    return true;
                }
            } else{
                return true;
            }
        })->take($limit);

    }

    public static function order_product($order="asc",$name=null,$product_type=null)
    {
        $order=$order==null ? "asc" : $order;
        $products=Product::query();
        if($name){
            $products=$products->where("title","LIKE","%".$name."%");
        }
        if($product_type){
            $products=$products->where("product_type",$product_type);
        }
        switch ($order){
            case "asc":
                $products = $products->orderByDesc("created_at")->paginate(10);
                break;
            case "desc":
                $products = $products->orderBy("created_at")->paginate(10);
                break;
            case "name":
                $products = $products->orderBy("title")->paginate(10);
                break;
        }

        return $products;
    }

    public static function create($data)
    {
        return Product::create([
            "title"=>$data->title,
            "content"=>$data->contents,
            "post_excerpt"=>$data->excerpt,
            "media_id"=>$data->thumbnail,
            "status"=>$data->status,
            "product_type"=>$data->product_type,
            "slug"=>$data->slug,
        ]);
    }

    public static function update(Product $product,$data)
    {

        return $product->update([
            "title"=>$data->title,
            "content"=>$data->contents,
            "post_excerpt"=>$data->excerpt,
            "media_id"=>$data->thumbnail,
            "status"=>$data->status,
            "product_type"=>$data->product_type,
            "slug"=>$data->slug,
        ]);
    }

    public static function create_product_category($product,$category)
    {
        foreach ($category as $catId){

            $cat= Category::find($catId);
            if(is_object($cat)){
                $cat->products()->save($product);

            }

        }

    }

    public static function create_product_brand($product,$brands)
    {
        foreach ($brands as $brandId){

            $brand= Brand::find($brandId);
            if(is_object($brand)){
                $brand->products()->save($product);

            }

        }

    }

    public static function get_product_cats( $product){
        return $product->category()->pluck("category_id")->toArray();
    }
    public static function get_product_brands( $product){
        return $product->brand()->pluck("brand_id")->toArray();
    }

    public static function delete_product_cats( $product)
    {
        $product->category()->detach();
    }

    public static function delete_product_brands( $product)
    {
        $product->brand()->detach();
    }

    public static function destroy($id)
    {
        Product::destroy($id);
    }

    public static function set_price( $product,$price,$offer_price)
    {
        $product->set_price($price,$offer_price);
    }

    public static function update_currency( $product,$currency)
    {
        $product->update([
            "currency"=>$currency
        ]);
    }
    public static function get_gallery_image(Product $product)
    {
        if(!PostMetaRepository::get_post_meta($product,"gallery")){
            return false;
        }
        $galleryItem= preg_replace_callback(
            '/s:([0-9]+):"(.*?)"/', function($match) {
            return "s:".mb_strlen($match[2]).":\"".$match[2]."\"";
        },
            get_post_meta($product,"gallery")->meta_value
        );

        $galleryItem=unserialize($galleryItem);

        return $galleryItem;
    }

    public static function add_attr_to_product($product,$request)
    {

        if(!empty($request->attribute_name) || !empty($request->attribute_value) || !empty($request->new_attribute_name) || !empty($request->new_attribute_value)){

            if($request->new_attribute_name && $request->new_attribute_value){
                foreach ($request->new_attribute_name as $key=>$newAttr){

                    if(!empty($newAttr)){
                        $newAttr=(object) ["name"=>$newAttr,"slug"=>Str::slug($newAttr)];
                        $attr= ProductAttrRepository::create($newAttr);
                        $attr_values=[];
                        $values=explode("|",$request->new_attribute_value[$key]);
                        if(is_array($values) && !empty($values)) {
                            foreach ($values as $value) {
                                $value = (object)["name" => $value, "slug" => Str::slug($value)];
                                $attr_values[]=ProductAttrRepository::create_value($value, $attr->id)->only("id")["id"];
                            }
                        }
                        $use_in_variable=false;

                        if($request->type == "variable" && isset($request->new_use_in_variable[$key]) && $request->use_in_variable[$key]== "on"){
                            $use_in_variable=true;
                        }
                        ProductAttribute::create([
                            "attribute_id"=>$attr->id,
                            "product_id"=>$product->id,
                            "values"=>$attr_values,
                            "use_in_product"=>isset($request->use_in_product[$key]) && $request->use_in_product[$key]=="on",
                            "use_in_variable"=>$use_in_variable,
                        ]);
                    }

                }
            }

            if($request->attribute_name && $request->attribute_value){
                foreach ($request->attribute_name as $key=>$attributeName){

                    $attribute=ProductAttrRepository::find($attributeName);
                    if(!empty($attribute)){
                        $values=$request->attribute_value[$attributeName];
                        $attr_values=[];
                        foreach ($values as $value){
                            $attributeValue=ProductAttrRepository::where_name($value,$attribute->id);
                            if($attributeValue->isNotEmpty()){
                                $attr_values[]=$attributeValue[0]->only("id")["id"];
                            }
                            if($attributeValue->isEmpty()){

                                $attr_values[]=ProductAttrRepository::create_value((object) ["name"=>$value,"slug"=>Str::slug($value)],$attribute->id)->only("id")["id"];
                            }
                        }
                        $use_in_variable=false;
                        if($request->type == "variable" && isset($request->use_in_variable[$attributeName]) && $request->use_in_variable[$attributeName]== "on"){

                            $use_in_variable=true;
                        }
                        ProductAttribute::updateOrCreate(["attribute_id"=>$attribute->id,"product_id"=>$product->id],[
                            "attribute_id"=>$attribute->id,
                            "product_id"=>$product->id,
                            "values"=>$attr_values,
                            "use_in_product"=>isset($request->use_in_product[$attributeName]) && $request->use_in_product[$attributeName]=="on",
                            "use_in_variable"=>$use_in_variable,
                        ]);
                    }
                }
            }
            return "ok";
        }
        return false;
    }


    public static function detachAttr($product)
    {
        if(is_object($product)) {
            $product->attributes()->delete();
        }
        else{
            ProductAttribute::where("product_id",$product)->delete();
        }
    }

    public static function get_use_for_variable_attribute($product)
    {
        if(is_object($product)){
            $attributes= $product->attributes()->where("use_in_variable",1)->get();

        } else{
            $attributes= ProductAttribute::where("product_id",$product)->where("use_in_variable",1)->get();
        }
        $attributeItem=ProductService::get_product_attribute_parent_and_value_id_and_name($attributes);
        return $attributeItem;
    }

    public static function get_use_for_product_attribute($product)
    {
        if(is_object($product)){
            $attributes= $product->attributes()->where("use_in_product",1)->get();

        } else{
            $attributes= ProductAttribute::where("product_id",$product)->where("use_in_product",1)->get();
        }
        $attributeItem=ProductService::get_product_attribute_parent_and_value_id_and_name($attributes);
        return $attributeItem;
    }

    public static function get_products_by_category(Category $category)
    {
        $catIds=[$category->id];
        foreach ($category->children as $child){
            $catIds[]=$child->id;
        }
        $products=Product::query()->whereHas('category',function(Builder $query) use ($catIds){
            $query->whereIn( 'category_id' , $catIds );
        })->where("status","publish")
            ->get()
            ->sortByDesc(function($product){
                if(!$product->manage_stock) return 1;
                return $product->stock_number;
            });

        $perPage = 12;

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $products->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $products = new LengthAwarePaginator($currentPageItems, $products->count(), $perPage, $currentPage);

        return $products;
    }


    public static function get_multiple_product_prices($product_ids)
    {
        return Product::query()->whereIn("id",$product_ids)->with(["post_meta"=>function($query){
            $query->where("meta_key","price")
                ->orWhere("meta_key","offer_price");
        }])->get();
    }

    public static function get_group_product_prices($product_id)
    {
        return GroupChildrenProduct::query()->where("id",$product_id)->with(["post_meta"=>function($query){
            $query->where("meta_key","price")
                ->orWhere("meta_key","offer_price");
        }])->first();
    }


    public static function in_stock($product,$quantity=1,$variation=null){
        if(is_numeric($product)){
            $product=self::find($product);
        }
        if(!$variation){
            $product_manage_stock=$product->manage_stock;
            $product_stock_number=$product->stock_number;

        } elseif(is_object($variation)){
            if($product->id != $variation->product_id){
                return false;
            }
            $product_manage_stock=$variation->manage_stock;
            $product_stock_number=$variation->stock_number;
        } elseif (is_numeric($variation)){
            $variation=ProductVariationRepository::find_variation($variation);
            $product_manage_stock=$variation->manage_stock;
            $product_stock_number=$variation->stock_number;
        }
        else{
            return false;
        }

        if($product_manage_stock && $product_stock_number>=$quantity){
            return true;
        } elseif (!$product_manage_stock){
            return true;
        } else{
            return false;
        }

    }



    public static function decrease_stock_number($product,$quantity,$variation=null){

        if(is_numeric($product)){
            $product=self::find($product);
        }
        $product_manage_stock=$product->manage_stock;
        if($product_manage_stock){
            $product_stock_number=$product->stock_number;
            if(!$variation){
                PostMetaRepository::update($product, "stock_number", $product_stock_number - $quantity);
            } else{
                ProductVariationRepository::update_stock_number($variation,$product_stock_number - $quantity);
            }

        }

    }

    public static function get_related_product_by_category($product){
        $catIds = $product->category->pluck('id')->toArray();

        $related_articles = Product::query()->whereHas('category', function ($query) use ($catIds) {
            return $query->whereIn('category.id', $catIds);
        })->where('id', '!=', $product->id)
            ->where("status","publish")
            ->limit(10)
            ->get();

        return $related_articles;
    }

    public static function get_product_offered_category($product){
        return $product->category()->whereNotNull("offer")->where("offer",">",0)->orderByDesc("offer")->first();
    }

    public static function get_product_offered_brand($product){
        return $product->brand()->whereNotNull("offer")->where("offer",">",0)->orderByDesc("offer")->first();
    }
    public static function get_product_and_user_wishlist($product_id){
        return Wishlist::query()->where("product_id",$product_id)->where("user_id",auth()->id())->first();
    }
    public static function add_to_wishlist($product_id){
        if(!$wishlist=self::get_product_and_user_wishlist($product_id)){
            return Wishlist::create([
                "product_id"=>$product_id,
                "user_id"=>auth()->id(),
            ]);
        } else{
            $wishlist->delete();
        }
    }

    public static function like($name=null,$num=12)
    {
        $products=collect();
        if($name){
            $products=Product::query()->where("status","publish")->where("title","LIKE","%".$name."%")->paginate($num);
        }


        return $products;
    }

    public static function order_by_attribute_by_category($attr,$category,$direction="asc"){
        if(is_object($category)){
            if($direction=="asc"){
                return $category->products->sortBy($attr)->first();
            }
            if($direction=="desc"){
                return $category->products->sortByDesc($attr)->first();
            }
        } else{
            if($direction=="asc"){
                return self::get()->sortBy($attr)->first();
            }
            if($direction=="desc"){
                return self::get()->sortByDesc($attr)->first();
            }
        }
    }

    public static function get_products_by_meta_key_and_order_by_stock_number($key,$limit=10){
        $products=PostMetaRepository::limit_by_key_order_by_stock_number($limit,$key,(new Product())->getMorphClass(),Product::class);
        return $products;
    }

    public static function like_not_paginate($name=null)
    {
        $products=collect();
        if($name){
            $products=Product::query()->where("status","publish")->where("title","LIKE","%".$name."%")->get();
        }


        return $products;
    }
    public static function get_products_by_categories($paginate=true,$allCatId=null,$typeCatId=null,$brandId=null)
    {

        if($allCatId){

            $products=Product::query()->whereHas('category',function(Builder $query) use ($allCatId){
                $query->where( 'category_id' , $allCatId );
            })->where("status","publish");
        }



        if($typeCatId){
            if(isset($products)  && $products->get()->isNotEmpty()){

                $products=$products->whereHas('category',function(Builder $query) use ($typeCatId){
                    $query->where( 'category_id' , $typeCatId );
                });

            } else{
                $products=Product::query()->whereHas('category',function(Builder $query) use ($typeCatId){
                    $query->where( 'category_id' , $typeCatId );
                })->where("status","publish");
            }

        }


        if($brandId){
            if(isset($products) ){
                $products=$products->whereHas('brand',function(Builder $query) use ($brandId){
                    $query->where( 'brand_id' , $brandId );
                });
            } else{
                $products=Product::query()->whereHas('brand',function(Builder $query) use ($brandId){
                    $query->where( 'brand_id' , $brandId );
                })->where("status","publish");
            }

        }

        if($paginate){
            $products=$products->paginate(12);
        } else{
            $products=$products->get();
        }
        return $products;
    }

}


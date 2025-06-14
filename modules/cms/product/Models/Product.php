<?php

namespace CMS\Product\Models;

use Illuminate\Database\Eloquent\Model;
use CMS\Brand\Models\Brand;
use CMS\Category\Models\Category;
use CMS\Comment\Models\Comment;
use CMS\Media\Models\Media;
use CMS\Media\Service\MediaService;
use CMS\PostMeta\Models\Post_meta;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Repository\ProductRepository;
use CMS\Product\Repository\ProductVariationRepository;
use CMS\Product\Service\ProductVariationService;

class Product extends Model
{
    protected $fillable=["title","product_type","currency","post_excerpt","content","media_id","slug","status"];
    public  $type_variable="variable";

    public function category()
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }
    public function post_meta(){
        return $this->morphMany(Post_meta::class, 'post_metaable');
    }
    public function getPostMetaArrayAttribute(){
        return $this->post_meta->pluck("meta_value","meta_key");
    }
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class,"product_id");
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
    public function brand()
    {
        return $this->morphToMany(Brand::class, 'brandable');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class,"product_id");
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,"commentable","comment_able_type","comment_able_id");
    }

    public function set_price($price,$offer_price){
        PostMetaRepository::update($this,"price",$price);
        PostMetaRepository::update($this,"offer_price",$offer_price);
    }
    public function getTypeAttribute(){
        return PostMetaRepository::get_post_meta_value($this,"type");

    }

    public function getRegularPriceAttribute(){
        if($this->type == $this->type_variable){
            $biggest_variation=ProductVariationRepository::get_first_price_variation($this);
            if(is_object($biggest_variation)){
            return $biggest_variation->price;

            }
            return 0;
        }
    return PostMetaRepository::get_post_meta_value($this,"price");

}


    public function getOriginalOfferPriceAttribute(){
        if($this->type == $this->type_variable){
            return 0;
        }
        return PostMetaRepository::get_post_meta_value($this,"offer_price");

    }
    public function getOfferPriceAttribute(){
        $offer_price=false;
        if($this->type == $this->type_variable){
            $biggest_variation=ProductVariationRepository::get_first_price_variation($this);
            if(is_object($biggest_variation)){
                $offer_price= $biggest_variation->offer_price;
            } else{
                return 0;

            }

        } else{
            $offer_price=PostMetaRepository::get_post_meta_value($this,"offer_price");
        }

        $price=$this->regular_price;
        if($offer_price){
            $price=$offer_price;
        }
        if($price<=0) return null;


        if($offer_category=ProductRepository::get_product_offered_category($this)){
            $category_offer_percent=$offer_category->offer;
            $offer_price=(int) ceil(($category_offer_percent / 100) * $this->regular_price);
            return $this->regular_price - $offer_price;

        }
        if($offer_price<=0) return null;
        if($offer_brand=ProductRepository::get_product_offered_brand($this)){
            $brand_offer_percent=$offer_brand->offer;
            $offer_price=(int) ceil(($brand_offer_percent / 100) * $this->regular_price);
            return $this->regular_price - $offer_price;

        }

        return $price;

    }


    public function getSmallImage()
    {
        if($this->media){
            $file=$this->media->files["original"];
            if(isset($this->media->files["100"])) $file=$this->media->files["100"];

            return store_image_link().'/'.$file;
        }

    }

    //stock

    public function getManageStockAttribute()
    {

        if($this->type == $this->type_variable){
            $biggest_variation=ProductVariationRepository::get_one_in_stock_variation($this);
            if(is_object($biggest_variation)){
                return $biggest_variation->manage_stock == "on";

            } return false;

        }
        return PostMetaRepository::get_post_meta_value($this,"manage_stock") == "on";
    }

    public function getStockNumberAttribute()
    {

        if($this->type == $this->type_variable){
            $biggest_variation=ProductVariationRepository::get_one_in_stock_variation($this);
            if(is_object($biggest_variation)){
                return $biggest_variation->stock_number ;

            } return 0;

        }
        return PostMetaRepository::get_post_meta_value($this,"stock_number");
    }


    public function post_meta_where($postMeta)
    {
        if($meta=$this->post_meta()->where("meta_key",$postMeta)->first()){
            return $meta;
        }else{
            return (object) ["meta_value"=>null];
        }
    }

    public function stock_number()
    {
        if ($this->manage_stock) {

           if($meta=$this->stock_number > 0){
               return $meta . " عدد  ";
        } else {
            return "در انبار موجود نیست";
        }
    } else{
            return  "مدیریت انبار خاموش است";
        }

    }

    public function product_price()
    {
        $price=$this->regular_price;
        if ($price >  0) {
            $offer_price=$this->offer_price;
            if(!$offer_price){
                return format_price_with_currencySymbol($price,$this->currency_symbol);
            } else {
                return "<del>".format_price_with_currencySymbol($price,$this->currency_symbol)."</del>"."<ins class='d-block ' style='text-decoration: none'>".format_price_with_currencySymbol($offer_price,$this->currency_symbol)."</ins>";
            }
        } else{
            return  "رایگان";
        }

    }

    public function product_price_with_quantity($quantity,$variation=null){
        $price=$this->regular_price;
        if($variation && $this->type == $this->type_variable){
            $variation=ProductVariationRepository::find_variation($variation);
            $price=$variation->price;
        }
        if ($price >  0) {
            $offer_price=$this->offer_price;
            if($variation && $this->type == $this->type_variable){
                $offer_price=$variation->offer_price;
            }
            if(!$offer_price){
                $price =$price * $quantity;
                $price=convertToRial($price,$this->currency_symbol);
                return $price;
            } else {
                $offer_price=$offer_price * $quantity;
                $offer_price=convertToRial($offer_price,$this->currency_symbol);
                return $offer_price;
            }
        } else{
            return  "رایگان";
        }
    }

    protected static function booted()
    {
        parent::boot();
        static::created(function ($product) {
            $product_attr=ProductAttribute::where("product_id",request()->product_nick_name);
           $product_attr->update(["product_id"=>$product->id]);
        });

    }

    public function getUrlAttribute()
    {
        if($this->product_type == "gift_cart"){
            return route("product.gift_cart",["slug"=>$this->slug]);
        }

        if($this->product_type == "buy_product"){
            return route("product.buy_product",["slug"=>$this->slug]);
        }

        if($this->product_type == "inter_payment"){
            return route("product.inter_payment",["slug"=>$this->slug]);
        }
    }


    public function getOfferPercentAttribute()
    {
        $price=$this->regular_price;
        $offer_price=$this->offer_price;
        if($offer_price){

            $discounted_price = 100 - ceil(($offer_price/$price) * 100) . "%";
            if($discounted_price > 0){
                return $discounted_price;

            }
        }


    }

    public function getOfferedPriceAttribute()
    {
        $price=$this->regular_price;
        $offer_price=$this->offer_price;
        if($offer_price){

            $discounted_price = $price-$offer_price;
            if($discounted_price > 0){
                return $discounted_price;

            }
        }


    }

    public function get_variation_by_value($variation_id){
        if($variation_id){
            $varitaion_attribute_name=ProductVariationRepository::get_attribute_by_variation_id($variation_id);
            $varitaion_html=ProductVariationService::get_variations_name_html($varitaion_attribute_name);
            return $varitaion_html;
        }
        return null;
    }
    public function getBuyerCountAttribute(){
        return PostMetaRepository::get_post_meta_value($this,"buyer_count");

    }
    public function getFeePercentAttribute(){
        return PostMetaRepository::get_post_meta_value($this,"fee_percent");

    }
    public function getFaqAttribute(){
        return json_decode(PostMetaRepository::get_post_meta_value($this,"FAQ"));

    }
    public function getGuideSizeAttribute(){
        return PostMetaRepository::get_post_meta_value($this,"guide_size");

    }
    public function getGuideSizeImageAttribute(){
        $guide_size=$this->guide_size;

        if($guide_size){
            return asset(store_image_link($guide_size));
        }

    }
    public function getAffiliatePercentAttribute(){
        if($meta=$this->post_meta()->where("meta_key","affiliate_percent")->first()){
            return $meta->meta_value;
        }
    }
    public function getTimeToSendAttribute(){

        if($meta=$this->post_meta()->where("meta_key","time_to_send")->first()){
            return $meta->meta_value;
        }
    }
    public function getUserInfoAttribute(){

        if($meta=$this->post_meta()->where("meta_key","user_info")->first()){
            return json_decode($meta->meta_value);
        }
    }
    public function getSendPriceAttribute(){

        if($meta=$this->post_meta()->where("meta_key","send_price")->first()){
            return $meta->meta_value;
        }
    }
    public function getCurrencySymbolAttribute(){
        if($this->type == $this->type_variable){
            $biggest_variation=ProductVariationRepository::get_first_currency_variation($this);
            if(is_object($biggest_variation)){
                return $biggest_variation->currency;

            }
            return 0;
        }
        return $this->currency;

    }

}

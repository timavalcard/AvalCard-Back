<?php

namespace CMS\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use CMS\Article\Models\Article;
use CMS\Category\Repositories\CategoryRepository;
use CMS\Course\Models\Course;
use CMS\Group_Product\Models\GroupProduct;
use CMS\Media\Models\Media;
use CMS\PostMeta\Models\Post_meta;
use CMS\Product\Models\Product;

class Category extends Model
{
    protected $table="category";
    protected $fillable=["name","product_type","slug","parent","contents","type","media_id","offer"];
    public static $post_type=[];

    public function articles() {
        return $this->morphedByMany(Article::class, 'categoryable');
    }
    public function children()
    {

        return $this->hasMany(self::class,"parent","id");
    }
    public function parent2()
    {
        return $this->hasOne(self::class,"id","parent");
    }
    public function post_meta(){
        return $this->morphMany(Post_meta::class, 'post_metaable');
    }

    public function getPostMetaArrayAttribute(){
        return $this->post_meta->pluck("meta_value","meta_key");
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'categoryable');
    }
    public function publishedProducts()
    {
        return Category::products()->where("status","publish")->get();
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function group_products()
    {
        return $this->morphedByMany(GroupProduct::class, 'categoryable');
    }
    public function media()
    {
        return $this->belongsTo(Media::class);
    }
    public function scopeType($query,$type)
    {

        return $query->where('type', $type);
    }

    public  function getParentCatAttribute()
    {
        return  $this->parent == 0 ? "دسته اصلی" : $this->parent2->name;
    }


    public function getParentCategory()
    {
        return $this->hasOne(self::class,"parent","id");
    }

    public function getSubCategory()
    {
        return $this->hasMany(self::class,"parent","id");
    }

    protected static function booted()
    {
        parent::boot();
        static::creating(function ($comment) {
            if(request()->parent==0){
                Schema::disableForeignKeyConstraints();
            }
        });

        static::created(function ($comment) {
                Schema::enableForeignKeyConstraints();
        });
    }

    public function getUrlAttribute()
    {

        if($this->product_type == "gift_cart"){
            return route("category.gift_cart",["slug"=>$this->slug]);
        }

        if($this->product_type == "buy_product"){
            return route("category.buy_product",["slug"=>$this->slug]);
        }

        if($this->product_type == "inter_payment"){
            return route("category.inter_payment",["slug"=>$this->slug]);
        }
    }

}

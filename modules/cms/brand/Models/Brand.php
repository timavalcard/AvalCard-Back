<?php

namespace CMS\Brand\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use CMS\Article\Models\Article;
use CMS\Group_Product\Models\GroupProduct;
use CMS\Media\Models\Media;
use CMS\PostMeta\Models\Post_meta;
use CMS\Product\Models\Product;

class Brand extends Model
{
    protected $table="brands";
    protected $fillable=["name","slug","parent","contents","type","media_id","offer"];
    public static $post_type=[];


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
    public function products()
    {
        return $this->morphedByMany(Product::class, 'brandable');
    }
    public function group_products()
    {
        return $this->morphedByMany(GroupProduct::class, 'brandable');
    }
    public function media()
    {
        return $this->belongsTo(Media::class);
    }
    public function scopeType($query,$type)
    {

        return $query->where('type', $type);
    }

    public  function getParentBrandAttribute()
    {
        return  $this->parent == 0 ? "برند اصلی" : $this->parent2->name;
    }


    public function getParentBrand()
    {
        return $this->hasOne(self::class,"parent","id");
    }

    public function getSubBrand()
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
        return route("brand.index",["slug"=>$this->slug]);
    }

}

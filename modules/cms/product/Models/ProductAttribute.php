<?php

namespace CMS\Product\Models;

use Illuminate\Database\Eloquent\Model;
use CMS\Category\Models\Category;
use CMS\Media\Service\MediaService;
use CMS\PostMeta\Models\Post_meta;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\ProductAttr\Models\Attribute;

class ProductAttribute extends Model
{
    protected $table="product_attribute";
    protected $fillable=["attribute_id","product_id","values","use_in_product","use_in_variable"];
    protected $casts=["values"=>"json"];
    public function attribute()
    {
        return $this->belongsTo(Attribute::class,"attribute_id");
    }
    public function product()
{
    return $this->belongsToMany(Product::class,"product_attribute");
}
}

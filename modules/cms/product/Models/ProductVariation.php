<?php

namespace CMS\Product\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $table="product_variation";
    protected $fillable=["product_id","currency","variations","priority","price","offer_price","width","height","weight","length","sku","manage_stock","stock_number","low_stock_amount"];
    protected $casts=["variations"=>"json"];

    public function product()
    {
        return $this->belongsToMany(Product::class,"product_variation");
    }

    public function getAttributesAttribute() {
       $attributes_id=$this->variations;
       return $attributes_id;
    }
}

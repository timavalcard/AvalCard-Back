<?php

namespace CMS\ProductAttr\Models;

use Illuminate\Database\Eloquent\Model;
use CMS\Product\Models\Product;

class Attribute extends Model
{
    protected $fillable=["name","product_type","slug","parent","color","image"];

    public function parents_attr()
    {
        return $this->belongsTo(self::class,"parent","id");
    }

    public function sub_attr()
    {
        return $this->hasMany( self::class,"parent","id");
    }

    public function product()
    {
        return $this->belongsToMany(Product::class,"product_attribute","product_id","attribute_id");
    }


    public function scopeAllParent($query)
    {
        return $query->where('parent', 0);
    }

}

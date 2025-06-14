<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/29/2020
 * Time: 9:39 PM
 */

namespace CMS\ProductAttr\Repository;


use CMS\Product\Models\ProductAttribute;
use CMS\ProductAttr\Models\Attribute;

class ProductAttrRepository
{
    public static function all($product_type)
    {
        return Attribute::query()->where("product_type",$product_type)->get();
    }

    public static function get_children_attr($attribute,$name=null)
    {
        if($name){
            return $attribute->sub_attr()->where("name","LIKE","%".$name."%")->get();
        }

        return $attribute->sub_attr;
    }
    public static function get_children_attr_by_id($attribute,$id)
    {
        return $attribute->sub_attr()->where("id",$id)->first();
    }

    public static function get_attr_with_children($parent_id,$children_id)
    {
        return Attribute::query()->where("id",$parent_id)->with(["sub_attr"=>function($query) use($children_id){
            $query->where("id",$children_id);
        }])->first();

    }

    public static function get_sibling_attr_value($attribute)
    {
        return $attribute->parents_attr->sub_attr;
    }


    public static function get_all_parent_attr($product_type)
    {
        return Attribute::query()->allParent()->where("product_type",$product_type)->get();
    }

    public static function find($id)
    {
        return Attribute::find($id);
    }

    public static function create($data)
    {

        return Attribute::create([
            "name"=>$data->name,
            "slug"=>$data->slug,
            "product_type"=>$data->product_type,
            "parent"=>0
        ]);
    }

    public static function create_value($data,$id,$colorOrImage=[])
    {
        $data=array_merge(["name"=>$data->name,"product_type"=>$data->product_type, "slug"=>$data->slug, "parent"=>$id],$colorOrImage);

        return Attribute::create($data);
    }

    public static function update(Attribute $attribute,$data,$colorOrImage=[])
    {
        $data=array_merge(["name"=>$data->name, "slug"=>$data->slug],$colorOrImage);
       return $attribute->update($data);
    }

    public static function destroy_children($parentId)
    {
        Attribute::query()
            ->where("parent",$parentId)
            ->delete()
        ;
    }

    public static function destroy($id)
    {
        Attribute::destroy($id);
    }

    public static function delete_product_attr($attr_id,$productId)
    {
       return ProductAttribute::query()->where("product_id",$productId)->where("attribute_id",$attr_id)->delete();
    }

    public static function where_name($name,$parent)
    {
        return Attribute::where("name",$name)->where("parent",$parent)->get();
    }

}

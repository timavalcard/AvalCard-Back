<?php
namespace CMS\Brand\Repositories;


use CMS\Brand\Models\Brand;

class BrandRepository
{
    public static function find($id)
    {
        return Brand::findOrFail($id);
    }


    public static function get_by_type($type)
    {
       return Brand::query()->type($type)->orderByDesc("created_at")->get();
    }
    public static function get_all_by_type_except_id($type,$id)
    {
        return Brand::query()->where("id","!=",$id)->type($type)->orderByDesc("created_at")->get();
    }
    public static function get_parent_with_children_by_type($type)
    {
        return Brand::query()->where("parent",0)->type($type)->orderByDesc("created_at")->with("children")->get();
    }

    public static function find_by_slug($slug)
    {
        return Brand::query()->where("slug",$slug)->with(["parent2","children"])->firstOrFail();
    }

    public static function create($data)
    {
        return Brand::create([
            "type"=>$data->type,
            "name"=>$data->name,
            "slug"=>$data->slug,
            "parent"=>$data->parent,
            "offer"=>$data->offer,
            "media_id"=>$data->thumbnail,
            "contents"=>$data->contents
        ]);
    }

    public static function update(Brand $Brand,$data)
    {
        $Brand
            ->update(
                ["name"=>$data->name,
                    "slug"=>$data->slug,
                    "parent"=>$data->parent,
                    "contents"=>$data->contents,
                    "offer"=>$data->offer,
                    "type"=>$data->type,
                    "media_id"=>$data->thumbnail,
                ]);


    }

    public static function destroy($id)
    {
        Brand::destroy($id);
    }
}

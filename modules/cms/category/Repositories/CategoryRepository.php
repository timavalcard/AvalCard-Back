<?php
namespace CMS\Category\Repositories;


use CMS\Category\Models\Category;

class CategoryRepository
{
    public static function find($id)
    {
        return Category::findOrFail($id);
    }
    public static function findNotFail($id)
    {
        return Category::find($id);
    }
    public static function get(){
        return Category::get();
    }

    public static function get_by_type($type,$name=null,$product_type=null)
    {
        $category=Category::query()->type($type);
        if($name){
            $category=$category->where("name","LIKE","%".$name."%");
        }
        if($product_type){
            $category=$category->where("product_type",$product_type);
        }
       return $category->orderByDesc("created_at")->get();
    }
    public static function get_all_by_type_except_id($type,$id)
    {
        return Category::query()->where("id","!=",$id)->type($type)->orderByDesc("created_at")->get();
    }
    public static function get_parent_with_children_by_type($type)
    {
        return Category::query()->where("parent",0)->type($type)->orderByDesc("created_at")->with("children")->get();
    }

    public static function find_by_slug($slug)
    {
        return Category::query()->where("slug",$slug)->with(["parent2","children"])->firstOrFail();
    }

    public static function create($data)
    {
        return Category::create([
            "type"=>$data->type,
            "name"=>$data->name,
            "slug"=>$data->slug,
            "parent"=>$data->parent,
            "product_type"=>$data->product_type,
            "offer"=>$data->offer,
            "media_id"=>$data->thumbnail,
            "contents"=>$data->contents
        ]);
    }

    public static function update(Category $category,$data)
    {
        $category
            ->update(
                ["name"=>$data->name,
                    "slug"=>$data->slug,
                    "parent"=>$data->parent,
                    "contents"=>$data->contents,
                    "type"=>$data->type,
                    "offer"=>$data->offer,
                    "media_id"=>$data->thumbnail,
                ]);


    }

    public static function destroy($id)
    {
        Category::destroy($id);
    }
}

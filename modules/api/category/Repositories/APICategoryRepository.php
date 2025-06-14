<?php
namespace API\Category\Repositories;

use CMS\Article\Models\Article;
use CMS\Category\Models\Category;
use CMS\Group_Product\Models\GroupProduct;
use CMS\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;


class APICategoryRepository
{

    public static function get_parent_categories()
    {
        return Category::query()->type("article")->where("parent",0)->get();
    }
    public static function get_sub_categories()
    {
        return Category::query()->where("parent","!=",0)->get();
    }

    public static function latest_articles($category,$limit=5){
        if($category->parent !=0){
            return $category->articles()->orderByDesc('created_at')->paginate((int) $limit,['*'],"page",request()->page??1);

        }
        $catIds=[$category->id];


        foreach ($category->children as $child){
            $catIds[]=$child->id;
        }
        $articles=Article::query()->whereHas('category',function(Builder $query) use ($catIds){
            $query->whereIn( 'category_id' , $catIds );
        })->orderByDesc('created_at')->limit($limit)->get();
        return $articles;


    }


    public static function latest_products($category,$limit=5){
        if($category->parent !=0){
            return $category->products()->orderByDesc('created_at')->paginate((int) $limit,['*'],"page",request()->page??1);

        }
        $catIds=[$category->id];


        foreach ($category->children as $child){
            $catIds[]=$child->id;
        }

        $products=Product::query()->whereHas('category',function(Builder $query) use ($catIds){
            $query->whereIn( 'category_id' , $catIds );
        })->orderByDesc('created_at')->limit($limit)->get();


        return $products;


    }
}

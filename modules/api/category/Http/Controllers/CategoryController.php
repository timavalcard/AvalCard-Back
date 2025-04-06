<?php

namespace API\Category\Http\Controllers;

use API\Category\Http\Resources\SingleProductCategoryResource;
use App\Http\Controllers\Controller;
use API\Article\Http\Resources\ArticleResource;
use API\Category\Http\Resources\CategoryResource;
use API\Category\Http\Resources\SingleCategoryResource;
use CMS\Category\Repositories\CategoryRepository;
use API\Category\Repositories\APICategoryRepository;


class CategoryController extends Controller
{
    public function parent_cat_list(){
        return CategoryResource::collection(APICategoryRepository::get_parent_categories());
    }
    public function category_with_articles(){
        return SingleCategoryResource::collection(APICategoryRepository::get_parent_categories());
    }
    public function category_top_articles(){
        $category=CategoryRepository::find_by_slug(request()->slug);
        if($category){
            return ArticleResource::collection($category->LatestArticles());
        }
        if (!$category) {
            abort(404);
        }
    }
    public function category_detail(){
        $category=CategoryRepository::find_by_slug(request()->slug,"article");
        if($category){
            return new SingleCategoryResource($category);
        }
        if (!$category) {
            abort(404);
        }
    }

    public function product_category_detail(){
        $category=CategoryRepository::find_by_slug(request()->slug);
        if($category){
            return new SingleProductCategoryResource($category);
        }
        if (!$category) {
            abort(404);
        }
    }





}











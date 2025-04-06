<?php

namespace CMS\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Article\Repositories\ArticleRepository;
use CMS\Category\Http\Requests\CategoryRequest;
use CMS\Category\Models\Category;
use CMS\Category\Repositories\CategoryRepository;
use CMS\Page\Services\CreateService;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Repository\ProductRepository;

class CategoryController extends Controller
{
    //front routes
    public function index($parent=null,$slug=null){

        if(!$slug) $slug2=$parent;
        if($slug) $slug2=$slug;

        $category=CategoryRepository::find_by_slug($slug2);
        if($category->parent!=0 && !$slug){
            return  abort(404);
        }
        if($category){
            $data=["category"=>$category];
            if($category->type=="product"){
                $categories=CategoryRepository::get_by_type("product");
                $data["products"]=ProductRepository::get_products_by_category($category,true);
                if(isset(request()->page) && !$data["products"]->items()){
                    return  abort(404);
                }
                $data["categories"]=$categories;
            } elseif ($category->type=="article"){
                $data["articles"]=ArticleRepository::get_articles_by_category($category);
            }elseif ($category->type=="group_product" && $category->children->isEmpty()){
                $data["group_products"]=$category->group_products;
            }

            return view("Theme::hidi.category-".$category->type,$data);
        }
    }

    //admin routes
    public function category_add_form(Request $request){
        $this->authorize("index",Category::class);
        if(!in_array($request->post_type,Category::$post_type)){
            return abort(404);
        }

        $categories=CategoryRepository::get_by_type($request->post_type,$request->name,$request->product_type);
        return view("Category::Admin.category_add",["categories"=>$categories]);
    }

    public function category_add(CategoryRequest $request){

        $this->authorize("create",Category::class);
        $slug=make_slug_for_data($request->name,$request->slug);
        $request->request->add(["slug"=>$slug]);

        $cat=CategoryRepository::create($request);
        PostMetaRepository::update_meta_tag($cat,$request);
        CreateService::create($cat->url."/");
        if($request->ajax()){
            return $cat;
        } else {
            return back();
        }
    }

    public function category_edit_form(Request $request, $id){
        $this->authorize("edit",Category::class);
        if(!in_array($request->post_type,Category::$post_type)){
            return abort(404);
        }
        $category=CategoryRepository::find($id);
        $categories=CategoryRepository::get_all_by_type_except_id($request->post_type,$id);
        return view("Category::Admin.category_edit",["category"=>$category,"categories"=>$categories]);
    }

    public function category_edit(CategoryRequest $request){
        $this->authorize("edit",Category::class);
        $slug=make_slug_for_data($request->name,$request->slug);
        $request->request->add(["slug"=>$slug]);
        $category=CategoryRepository::find($request->id);
        PostMetaRepository::update_meta_tag($category,$request);

        CategoryRepository::update($category,$request);
        CreateService::create($category->url."/");
        return back();
    }

    public function category_delete($id)
    {
        $this->authorize("delete",Category::class);
        $cat=CategoryRepository::find($id);
        CategoryRepository::destroy($id);
        CreateService::remove($cat->url."/");
        return back();
    }
}

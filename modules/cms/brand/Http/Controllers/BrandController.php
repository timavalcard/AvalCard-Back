<?php

namespace CMS\Brand\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Article\Repositories\ArticleRepository;
use CMS\Brand\Http\Requests\BrandRequest;
use CMS\Brand\Models\Brand;
use CMS\Brand\Repositories\BrandRepository;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Repository\ProductRepository;

class BrandController extends Controller
{
    //front routes
    public function index($slug)
    {
        $brand=BrandRepository::find_by_slug($slug);
        if($brand){
            $data=["brand"=>$brand];
            if($brand->type=="product"){
                $categories=BrandRepository::get_by_type("product");
                $data["products"]=ProductRepository::get_products_by_brand($brand);
                $data["categories"]=$categories;
            } elseif ($brand->type=="article"){
                $data["articles"]=ArticleRepository::get_articles_by_brand($brand);
            }elseif ($brand->type=="group_product" && $brand->children->isEmpty()){
                $data["group_products"]=$brand->group_products;
            }

            return view("Theme::hidi.brand-".$brand->type,$data);
        }
    }

    //admin routes
    public function brand_add_form(Request $request){
        $this->authorize("index",Brand::class);
        if(!in_array($request->post_type,Brand::$post_type)){
            return abort(404);
        }

        $categories=BrandRepository::get_by_type($request->post_type);
        return view("Brand::Admin.brand_add",["categories"=>$categories]);
    }

    public function brand_add(BrandRequest $request){

        $this->authorize("create",Brand::class);
        $slug=make_slug_for_data($request->name,$request->slug);
        $request->request->add(["slug"=>$slug]);

        $brand=BrandRepository::create($request);
        PostMetaRepository::update_meta_tag($brand,$request);
        if($request->ajax()){
            return $brand;
        } else {
            return back();
        }
    }

    public function brand_edit_form(Request $request, $id){
        $this->authorize("edit",Brand::class);
        if(!in_array($request->post_type,Brand::$post_type)){
            return abort(404);
        }
        $brand=BrandRepository::find($id);
        $categories=BrandRepository::get_all_by_type_except_id($request->post_type,$id);
        return view("Brand::Admin.brand_edit",["brand"=>$brand,"categories"=>$categories]);
    }

    public function brand_edit(BrandRequest $request){
        $this->authorize("edit",Brand::class);
        $slug=make_slug_for_data($request->name,$request->slug);
        $request->request->add(["slug"=>$slug]);
        $brand=BrandRepository::find($request->id);
        PostMetaRepository::update_meta_tag($brand,$request);

        BrandRepository::update($brand,$request);
        return back();
    }

    public function brand_delete($id)
    {
        $this->authorize("delete",Brand::class);
        BrandRepository::destroy($id);
        return back();
    }
}

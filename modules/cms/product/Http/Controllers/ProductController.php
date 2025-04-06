<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/29/2020
 * Time: 8:38 PM
 */

namespace CMS\Product\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Brand\Repositories\BrandRepository;
use CMS\Category\Repositories\CategoryRepository;
use CMS\Comment\Repository\CommentRepository;
use CMS\Common\Services\CommonService;
use CMS\Page\Services\CreateService;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Http\Requests\AddProductRequest;
use CMS\Product\Http\Requests\EditProductRequest;
use CMS\Product\Models\Product;
use CMS\Product\Repository\ProductRepository;
use CMS\Product\Repository\ProductVariationRepository;
use CMS\ProductAttr\Models\Attribute;
use CMS\ProductAttr\Repository\ProductAttrRepository;

class ProductController extends Controller
{
    // theme functions
    public function index($category=null,$slug=null){

        if(!$slug) $slug2=$category;
        if($slug) $slug2=$slug;
        $product=ProductRepository::find_by_slug($slug2);
        $category=$product->category;
        if($category->isNotEmpty() && !$slug){
            return  abort(404);
        }
        $is_wished=false;
        if(auth()->user()){
            $wishlist=ProductRepository::get_product_and_user_wishlist($product->id);
           if($wishlist){
               $is_wished=true;
           }
        }
        $in_stock=ProductRepository::in_stock($product);
        $comments=CommentRepository::get_approve_comment($product);
        $questions=CommentRepository::get_approve_comment($product,"question");
        $gallery=ProductRepository::get_gallery_image($product);
        $table_variations=false;
        $in_stock_variations=[];
        if($product->type== $product->type_variable){
            $variations=ProductVariationRepository::get_product_variation($product);
            foreach ($variations as $variation) {
                if(ProductRepository::in_stock($product,1,$variation["id"])){
                    $in_stock_variations[]=$variation;
                }
            }

            $table_variations=[];
            foreach ($in_stock_variations as $variation){
                foreach ($variation["variations"] as $variation_id=>$variation_item) {
                    if(isset($table_variations[$variation_id])){

                        $duplicate_variation=true;

                        foreach ($table_variations[$variation_id]["item"] as $item) {
                            if(isset($item["id"]) && (is_array($variation_item[0]) || $variation_item[0]->isNotEmpty())){

                                if($item["id"] == $variation_item[0]["id"]){
                                    $duplicate_variation=false;
                                }
                            }

                        }
                        if($duplicate_variation) $table_variations[$variation_id]["item"][]=$variation_item[0];

                    } else{
                        $table_variations[$variation_id]["item"]=[$variation_item[0]];
                        $table_variations[$variation_id]["parentName"]=$variation_item["parentName"]["name"];
                    }
                }

            }


        }
        $related_products=ProductRepository::get_related_product_by_category($product);

        $attributes=ProductRepository::get_use_for_product_attribute($product);

        return view("Theme::hidi.product",compact("product","is_wished","in_stock","comments","gallery","related_products","in_stock_variations","table_variations","attributes","questions"));
    }
    public function add_wishlist(Request $request){
        if(auth()->user()){
            ProductRepository::add_to_wishlist($request->id);
        } else{
            return response()->json(["url"=>route("auth.index")]);
        }
    }
    //admin functions
    public function product_list(Request $request)
    {
        $this->authorize("index",Product::class);
        $products=ProductRepository::order_product($request->orderBy,$request->name,request()->product_type);
        $products_count=ProductRepository::get()->count();
        return view("Product::Admin.product_list",["products"=>$products,"products_count"=>$products_count]);
    }

    public function product_add_form ()
    {
        $this->authorize("create",Product::class);
        $categories=CategoryRepository::get_by_type("product",null,request()->product_type);
        $brands=BrandRepository::get_by_type("product");
        $attributes=ProductAttrRepository::get_all_parent_attr(request()->product_type);

        return view("Product::Admin.product_add",["brands"=>$brands,"categories"=>$categories,"attributes"=>$attributes]);
    }

    public function product_add(AddProductRequest $request)
    {
        $this->authorize("create",Product::class);
        $slug=make_slug_for_data($request->title,$request->slug);
        $request->request->add(["slug"=>$slug]);
        if(!$request->product_nick_name){
            $product=ProductRepository::create($request);
        } else{
            $product=ProductRepository::find($request->product_nick_name);
            $request->request->add(["status"=>"publish"]);
            ProductRepository::update($product,$request);
        }
        PostMetaRepository::update_meta_tag($product,$request);
        ProductRepository::detachAttr($product);
        ProductRepository::add_attr_to_product($product,$request);

        PostMetaRepository::update($product,"type",$request->type);
        PostMetaRepository::update($product,"affiliate_percent",$request->affiliate_percent);
        PostMetaRepository::update($product, "buyer_count", $request->buyer_count);
        PostMetaRepository::update($product, "guide_size", $request->guide_size);

        PostMetaRepository::update($product,"gallery",serialize($request->gallery_image));

        if($request->product_cat){
            ProductRepository::create_product_category($product,$request->product_cat);
        }
        if($request->product_brand){
            ProductRepository::create_product_brand($product,$request->product_brand);
        }


        if($request->type!="variable"){
            PostMetaRepository::update($product,"sku",$request->sku);
            ProductRepository::set_price($product,$request->price,$request->offer_price);
            ProductRepository::update_currency($product,$request->currency);
            PostMetaRepository::update($product,"manage_stock",$request->manage_stock == null ? "off" : "on" );
            if($request->manage_stock == "on"){
                PostMetaRepository::update($product,"stock_number",$request->stock_number);
                PostMetaRepository::update($product,"low_stock_amount",$request->low_stock_amount);
            }else{
                PostMetaRepository::update($product,"stock_number",null);
                PostMetaRepository::update($product,"low_stock_amount",null);
            }
        }

        if($request->type=="variable" && !empty($request->attribute_select)){
            ProductVariationRepository::create_product_variation($product,$request);
        }
        CreateService::create($product->url."/");
        CommonService::tel_bot("product_add",$product->title);
        return redirect()->route("admin_product_edit",["id"=>$product->id]);
    }

    public function product_edit_form($id)
    {
        $this->authorize("edit",Product::class);
        $brands=BrandRepository::get_by_type("product");
        $product=ProductRepository::find($id);
        $categories=CategoryRepository::get_by_type("product",$product->product_type);
        $gallery=ProductRepository::get_gallery_image($product);
        $productCat=ProductRepository::get_product_cats($product);
        $productBrands=ProductRepository::get_product_brands($product);
        $attributes=ProductAttrRepository::get_all_parent_attr($product->product_type);
        $productVariations=ProductVariationRepository::get_product_variation($product);
        $attributes_for_variation=ProductRepository::get_use_for_variable_attribute($product);
        return view("Product::Admin.product_edit",["productBrands"=>$productBrands,"brands"=>$brands,"categories"=>$categories,"product"=>$product,"productCatId"=>$productCat,"gallery"=>$gallery,"attributes"=>$attributes,"productVariations"=>$productVariations,"attributes_for_variation"=>$attributes_for_variation]);
    }

    public function product_edit(EditProductRequest $request)
    {
        $this->authorize("update",Product::class);
        $slug=make_slug_for_data($request->title,$request->slug);

        $request->request->add(["slug"=>$slug]);

        $product=ProductRepository::find($request->id);
        PostMetaRepository::update_meta_tag($product,$request);
        ProductRepository::update($product,$request);

        ProductRepository::add_attr_to_product($product,$request);

        PostMetaRepository::update($product,"type",$request->type);
        PostMetaRepository::update($product,"affiliate_percent",$request->affiliate_percent);
        PostMetaRepository::update($product,"gallery",serialize($request->gallery_image));
        PostMetaRepository::update($product, "buyer_count", $request->buyer_count);
        PostMetaRepository::update($product, "guide_size", $request->guide_size);

        if($request->type !="variable") {


            PostMetaRepository::update($product, "manage_stock", $request->manage_stock == null ? "off" : "on");
            ProductRepository::set_price($product,$request->price,$request->offer_price);
            ProductRepository::update_currency($product,$request->currency);
            PostMetaRepository::update($product, "sku", $request->sku);
            if ($request->manage_stock == "on") {
                PostMetaRepository::update($product, "stock_number", $request->stock_number);
                PostMetaRepository::update($product, "low_stock_amount", $request->low_stock_amount);
            } else {
                PostMetaRepository::update($product, "stock_number", null);
                PostMetaRepository::update($product, "low_stock_amount", null);
            }
        }


        if($product->category){
            ProductRepository::delete_product_cats($product);
        }
        if($product->brand){
            ProductRepository::delete_product_brands($product);
        }

        if($request->product_cat){
            ProductRepository::create_product_category($product,$request->product_cat);
        }
        if($request->product_brand){
            ProductRepository::create_product_brand($product,$request->product_brand);
        }

        if($request->type=="variable" && !empty($request->attribute_select)){
            ProductVariationRepository::create_product_variation($product,$request);
        }
        CreateService::create($product->url."/");
        CommonService::tel_bot("product_edit",$product->title);
        return back();
    }

    public function product_delete($id)
    {
        $this->authorize("delete",Product::class);
        $product=ProductRepository::find($id);

        if($product->category){
            ProductRepository::delete_product_cats($product);
        }
        if($product->brand){
            ProductRepository::delete_product_brands($product);
        }

        ProductRepository::destroy($id);
        CreateService::remove($product->url."/");
        CommonService::tel_bot("product_delete",$product->title);
        return back();
    }

    public function product_get_attr(Request $request)
    {
        $this->authorize("create",Product::class);
        $this->authorize("edit",Product::class);

        $attr=ProductAttrRepository::find($request->attribute_id);
        $attr_value=$attr->sub_attr()->pluck("id","name");
        return $attr_value;
    }

    public function get_product_attribute_use_for_variable(Request $request,$product=null)
    {
        $this->authorize("create",Product::class);
        $this->authorize("edit",Product::class);
        if($product){
            $product=$product;
        } else{
            $product=$request->product_id;
        }
        $attributes=ProductRepository::get_use_for_variable_attribute($product);

        return $attributes;
    }

    public function save_product_attribute(Request $request)
    {
        $this->authorize("create",Product::class);
        $this->authorize("edit",Product::class);
        $product=ProductRepository::find2($request->product_id);
        if($product){
            $result=ProductRepository::add_attr_to_product($product,$request);
        } else{
            $product=Product::create([
                "title"=>$request->product_name,
                "status"=>"draft",
                "slug"=>make_slug_for_data($request->product_name,$request->product_slug),
            ]);
            $result=ProductRepository::add_attr_to_product((object) ["id"=>$product->id],$request);
        }
        if($result) return $product->id;
        return $result;
    }

    public  function attribute_delete(Request $request,$id=null){
        if(!is_null($id)){
            ProductAttrRepository::delete_product_attr($request->attribute_id,$id);
        }
        return true;
    }

    public function variation_delete(Request $request)
    {
        ProductVariationRepository::delete_product_one_variation($request->variation_id);

    }

    public function group_action(Request $request){
        if($request->action == "delete"){
            ProductRepository::destroy($request->checkbox_item);
        }
        return back();
    }
}




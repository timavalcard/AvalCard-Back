<?php

namespace CMS\ProductAttr\Http\Controllers;


use App\Http\Controllers\Controller;
use CMS\ProductAttr\Http\Requests\AddProductAttrRequest;
use CMS\ProductAttr\Http\Requests\EditProductAttrRequest;
use CMS\ProductAttr\Models\Attribute;
use CMS\ProductAttr\Repository\ProductAttrRepository;
use CMS\ProductAttr\Services\ProductAttrService;

class ProductAttrController extends Controller
{
    public function attribute_add_form(){
        $this->authorize("create",Attribute::class);
        $attr=ProductAttrRepository::all(request()->product_type);
        return view("ProductAttr::Admin.add_attribute",["attributes"=>$attr]);
    }

    public function attribute_add(AddProductAttrRequest $request){
        $this->authorize("create",Attribute::class);
        $slug=make_slug_for_data($request->name,$request->slug);
        $request->request->add(["slug"=>$slug]);

        ProductAttrRepository::create($request);
        return back();
    }

    public function attribute_delete($id)
    {
        $this->authorize("delete",Attribute::class);
       ProductAttrRepository::destroy_children($id);
        ProductAttrRepository::destroy($id);
        return back();
    }

    public function attribute_edit_form($id){
        $this->authorize("edit",Attribute::class);
        $attr=ProductAttrRepository::find($id);
        $attrs=ProductAttrRepository::all($attr->product_type);
        return view("ProductAttr::Admin.edit_attribute",["attributes"=>$attrs,"edit_attr"=>$attr]);
    }
    public function attribute_value_edit_form($id){
    $this->authorize("edit",Attribute::class);
    $attr=ProductAttrRepository::find($id);
    $parentAttr=ProductAttrRepository::get_sibling_attr_value($attr);

    return view("ProductAttr::Admin.edit_attribute_value",["attributes"=>$parentAttr,"edit_attr"=>$attr]);
        }

    public function attribute_edit (EditProductAttrRequest $request,$id)
    {
        $this->authorize("update",Attribute::class);
        $attr=ProductAttrRepository::find($id);

        $slug=make_slug_for_data($request->name,$request->slug);
        $request->request->add(["slug"=>$slug]);
        $colorOrImage=ProductAttrService::colorOrImage($request->thumbnail,$request->color,$request->attr_color_or_image_select);
        ProductAttrRepository::update($attr,$request,$colorOrImage);
        if($attr->parent!=0){
            return redirect()->route('admin_add_attribute_value',$attr->parent);
        }
        return back();
    }

    public function attribute_value_add_form($id){
        $this->authorize("create",Attribute::class);
        $attr=ProductAttrRepository::find($id);
        $attr_value=ProductAttrRepository::get_children_attr($attr,request()->name);
        return view("ProductAttr::Admin.add_attribute_value",["attribute"=>$attr,"attr_values"=>$attr_value,"parent_id"=>$id]);
    }

    public function attribute_value_add(AddProductAttrRequest $request,$id){
        $this->authorize("create",Attribute::class);
        $slug=make_slug_for_data($request->name,$request->slug);
        $request->request->add(["slug"=>$slug]);

        $colorOrImage=ProductAttrService::colorOrImage($request->thumbnail,$request->color,$request->attr_color_or_image_select);

        ProductAttrRepository::create_value($request,$id,$colorOrImage);

        return back();
    }
}

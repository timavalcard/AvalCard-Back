<?php

namespace CMS\Cart\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Cart\Models\Cart;
use CMS\Cart\Repository\CartRepository;
use CMS\Course\Models\Course;
use CMS\Course\Models\Lesson;
use CMS\Course\Services\CourseService;
use CMS\Group_Product\Repository\GroupChildrenProductRepository;
use CMS\Marketing\Services\AffiliateService;
use CMS\Page\Http\Requests\AddPageRequest;
use CMS\Page\Http\Requests\EditPageRequest;
use CMS\Page\Models\Page;
use CMS\Page\Repository\PageRepository;
use CMS\Product\Models\Product;
use CMS\Product\Repository\ProductVariationRepository;
use CMS\Product\Service\ProductService;
use CMS\Wallet\Services\WalletService;

class CartController extends Controller
{
    public function index(){
        $cart=CartRepository::get_cart();
        $cart_products=ProductService::get_cart_products($cart);
        $cart=CartRepository::get_cart();
        $cart_products_total_price=ProductService::get_cart_products_total_price();
        $cart_products_total_number=ProductService::get_cart_products_total_number();
        $address= null;
        if(auth()->user()){
        $address=get_user_meta(auth()->user()->id,"address");
        }
        return view("Theme::hidi.cart",["cart"=>$cart,"address"=>$address, "cart_products"=>$cart_products, "cart_total_price"=>$cart_products_total_price, "cart_products_total_number"=>$cart_products_total_number]);
    }

    public function add_to_cart(Product $product,Request $request)
    {
        $variation=null;
        if(is_numeric($request->variation)){
            $variation=ProductVariationRepository::find_variation($request->variation);
            if(is_object($variation)){
                $variation=$variation->id;

            }
        }

        if($product->type == $product->type_variable && !is_numeric($request->variation) ){
            toastMessage("شما باید یک متغیر برای این محصول انتخاب کنید","","info");
            return  back();
        }

        CartRepository::add_cart_item_to_session($product,$variation);
        CartRepository::add_cart_item_to_database($product,$variation);

        return redirect()->route("cart.index");
    }

    public function course_add_to_cart(Course $course,Request $request)
    {

        CartRepository::course_add_cart_item_to_session($course,"course");
        CartRepository::course_add_cart_item_to_database($course,"course");

        return redirect()->route("cart.index");
    }

    public function lesson_add_to_cart(Lesson $lesson,Request $request)
    {

        CartRepository::course_add_cart_item_to_session($lesson,"lesson");
        CartRepository::course_add_cart_item_to_database($lesson,"lesson");

        return redirect()->route("cart.index");
    }

    public function group_add_to_cart(Request $request){
        foreach ($request->product as $productId=>$variationId) {
            $product=GroupChildrenProductRepository::find($productId);
            if($request->quantity[$productId] > 0){
                $variation=null;
                if(is_numeric($variationId)){
                    $variation=ProductVariationRepository::find_variation($variationId);
                    if(is_object($variation)){
                        $variation=$variation->id;
                    }
                }

                if($product->type == $product->type_variable && !is_numeric($variationId) ){
                    toastMessage("شما باید یک متغیر برای این محصول انتخاب کنید","","info");
                    return  back();
                }
                CartRepository::add_cart_item_to_session($product,$variation,$request->quantity[$productId],$request->group_product_id);
                CartRepository::add_cart_item_to_database($product,$variation,$request->quantity[$productId],$request->group_product_id);


            }
        }
        return redirect()->route("cart.index");
    }



    public function delete_cart($id,Request $request){
        CartRepository::delete_cart_item($id,$request->variation);
        toastMessage("محصول مورد نظر از سبد خرید شما حذف شذ");
        return back();
    }
    public function course_delete_cart($id){
        CartRepository::course_delete_cart_item($id);
        toastMessage("دوره مورد نظر از سبد خرید شما حذف شذ");
        return back();
    }

    public function increase($id,Request $request)
    {
        $result=CartRepository::increase_cart($id,$request->variation);
        if($result) toastMessage("سبد خرید شما به روز رسانی شد");

        return back();
    }

    public function decrease($id,Request $request)
    {
        CartRepository::decrease_cart($id,$request->variation);
        toastMessage("سبد خرید شما به روز رسانی شد");
        return back();
    }

}

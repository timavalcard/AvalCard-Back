<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/29/2020
 * Time: 8:38 PM
 */

namespace CMS\Product\Http\Controllers;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use CMS\Cart\Repository\CartRepository;
use CMS\Category\Repositories\CategoryRepository;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Http\Requests\AddCouponRequest;
use CMS\Product\Http\Requests\AddProductRequest;
use CMS\Product\Http\Requests\EditCouponRequest;
use CMS\Product\Http\Requests\EditProductRequest;
use CMS\Product\Models\Coupon;
use CMS\Product\Models\Product;
use CMS\Product\Repository\CouponRepository;
use CMS\Product\Repository\ProductRepository;
use CMS\Product\Repository\ProductVariationRepository;
use CMS\Product\Service\CouponService;
use CMS\Product\Service\ProductService;
use CMS\ProductAttr\Models\Attribute;
use CMS\ProductAttr\Repository\ProductAttrRepository;
use CMS\Shop\Service\ShopService;
use CMS\User\Repositories\UserRepository;
use CMS\OrderService\Repositories\OrderServiceRepo;
use CMS\Service\Repositories\ServiceRepo;

class CouponController extends Controller
{
    //theme functions
    public function apply(Request $request){
        if(empty(session()->get("coupon_amount"))){
            $coupon=CouponRepository::find_coupon_by_name($request->coupon,"product");

            if($message=CouponService::verify_coupon($coupon)){
                return  ["message"=>$message,"type"=>"error","heading"=>"حطایی رخ داده است"];
            }
            $cart=CartRepository::get_cart();
            $products=ProductService::get_cart_products($cart);
            $amount=ProductService::get_cart_products_total_price(false);

            $new_amount=CouponService::coupon_calculate_amount($coupon,$products,$amount,$cart);

            UserRepository::add_user_coupon(auth()->user(),$coupon);
            CouponService::add_coupon_amount_to_session($new_amount,$coupon->id,$coupon->name);
            CouponRepository::decrease_number($coupon);
            $new_amount_with_delivery=ShopService::add_delivery_price_to_amount($new_amount,$coupon);

            return  ["message"=>"کوپن تخفیف با موفقیت روی سفارش شما اعمال شد","amount"=>format_price_with_currencySymbol($new_amount_with_delivery),"type"=>"success","heading"=>"عملیات موفق بود","delivery"=>$coupon->send_free ? "رایگان !"  : null ];

        } else{
            return ["message"=>"در حال حاظر یک کوپن تخفیف بر روی سفارش شما اعمال شده است","heading"=>" ","type"=>"warning"];
        }

        }

    public function service_apply(Request $request,OrderServiceRepo $orderServiceRepo){
        $order=$orderServiceRepo->findByID($request->order_id);
        if($order->user_id  != auth()->id()){
            return  ["message"=>"این سفارش برای شما نیست و نمیتوانید به آن کوپن تخفیف اضافه کنید","type"=>"error","heading"=>"حطایی رخ داده است"];

        }
        if(is_array($order->meta) && array_key_exists('factor',$order->meta)){


            if(empty(session()->get("service_coupon_amount"))){
                $coupon=CouponRepository::find_coupon_by_name($request->coupon,"service");

                if($message=CouponService::service_verify_coupon($coupon)){
                    return  ["message"=>$message,"type"=>"error","heading"=>"حطایی رخ داده است"];
                }

                UserRepository::add_user_coupon(auth()->user(),$coupon);
                $new_amount=CouponService::coupon_calculate_amount($coupon,$order->price);
                $orderServiceRepo->update_price($order,$new_amount);
                $orderServiceRepo->add_coupon_to_meta($order,$coupon);
                CouponService::service_add_coupon_amount_to_session($new_amount,$coupon->id,$coupon->name);
                CouponRepository::decrease_number($coupon);

                return  ["message"=>"کوپن تخفیف با موفقیت روی سفارش شما اعمال شد","amount"=>format_price_with_currencySymbol($new_amount),"type"=>"success","heading"=>"عملیات موفق بود","delivery"=>$coupon->send_free ? "رایگان !"  : null ];

            } else{
                return ["message"=>"در حال حاظر یک کوپن تخفیف بر روی سفارش شما اعمال شده است","heading"=>" ","type"=>"warning"];
            }
        } else{
            return  ["message"=>"فاکتوری برای این سفارش موجود نیست","type"=>"error","heading"=>"حطایی رخ داده است"];

        }

    }


    // admin functions
    public function create_coupon_form($type,Request $request)
    {

        $coupons=CouponRepository::get_by_type($type);

        if($type=="service"){
            $categories = (new ServiceRepo())->all_Parent_active();
            return view("Product::Admin.coupon.coupon_service_add",compact("coupons","categories"));

        } elseif ($type=="product"){
            $categories=CategoryRepository::get_by_type("product");
        return view("Product::Admin.coupon.coupon_add",compact("coupons","categories"));

        }
        return abort(404);
    }

    public function create_coupon(AddCouponRequest $request)
    {
        CouponRepository::create($request);
        return back();
    }

    public function delete_coupon($couponId)
    {
        CouponRepository::destroy($couponId);
        return back();
    }

    public function edit_coupon_form(Coupon $coupon)
    {
        $categories=CategoryRepository::get_by_type("product");
        return view("Product::Admin.coupon.coupon_edit",compact("coupon","categories"));

    }

    public function edit_coupon(Coupon $coupon,EditCouponRequest $request)
    {
        CouponRepository::update($coupon,$request);
        return back();
    }
}

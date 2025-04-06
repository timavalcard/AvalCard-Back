<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/17/2020
 * Time: 1:09 PM
 */

namespace CMS\Product\Service;


use Carbon\Carbon;
use CMS\Product\Repository\ProductRepository;
use CMS\User\Repositories\UserRepository;
use CMS\Service\Repositories\ServiceRepo;

class CouponService
{
    public static function verify_coupon($coupon)
    {

        if(!$coupon){
            return "کوپن تخفیفی با این نام وجود ندارد";
        }
        if($coupon->use_for_first_user && count(auth()->user()->orders) > 0){
            return "این کوپن تخفیف فقط برای اولین سفارش است. شما قبلا در سایت سفارش ثبت کرده اید";
        }
        $date = new Carbon($coupon->get_expiration_date(false));
        if ($date->isPast()){
            return "زمان انقضای این کوپن گذشته است";
        }
        if($coupon->number <=0){
            return "تعداد مجاز استفاده از این کوپن تخفبف تمام شده است";
        }
        if(!UserRepository::user_use_coupon_before(auth()->user(),$coupon)){
            return "شما قبلا از این کوپن استفاده کرده اید";
        }
        return false;
    }

    public static function service_verify_coupon($coupon)
    {

        if(!$coupon){
            return "کوپن تخفیفی با این نام وجود ندارد";
        }
       /* if($coupon->use_for_first_user && count(auth()->user()->orders) > 0){
            return "این کوپن تخفیف فقط برای اولین سفارش است. شما قبلا در سایت سفارش ثبت کرده اید";
        }*/
        $date = new Carbon($coupon->get_expiration_date(false));
        if ($date->isPast()){
            return "زمان انقضای این کوپن گذشته است";
        }
        if($coupon->number <=0){
            return "تعداد مجاز استفاده از این کوپن تخفبف تمام شده است";
        }
        if(!UserRepository::user_use_coupon_before(auth()->user(),$coupon)){
            return "شما قبلا از این کوپن استفاده کرده اید";
        }
        return false;
    }

    public static function coupon_calculate_amount($coupon,$amount){
        if($coupon->price_type=="cash"){
            if($coupon->price_offering >= $amount){
                $return_decrease_amount=0;
            } else{
                $return_decrease_amount= $amount - $coupon->price_offering;
            }
        } else{
            $percentInDecimal = $coupon->price_offering / 100;
            $return_decrease_amount=(int) ($percentInDecimal * $amount) ;
        }

        return $return_decrease_amount;


    }

    public static function service_coupon_calculate_amount($coupon,$cart_products,$amount,$cart){
        if($coupon->use_for=="all"){
            $decrease_amount=$amount;

            if($coupon->price_type=="cash"){
                if($coupon->price_offering >= $decrease_amount){
                    $return_decrease_amount=0;
                } else{
                    $return_decrease_amount= $decrease_amount - $coupon->price_offering;
                }
            } else{
                $percentInDecimal = $coupon->price_offering / 100;
                $return_decrease_amount=(int) ($percentInDecimal * $decrease_amount) ;
            }

        } else{
            $category_id=$coupon->use_for;
            $products_has_category=[];
            $products_not_has_category=[];
            foreach ($cart_products as $product){
                if($product->category->where("id",$category_id)->isNotEmpty()){
                    $products_has_category[$product->id]=$product;
                } else{
                    $products_not_has_category[$product->id]=$product;
                }
            }

            if(!empty($products_has_category)){
                $products_id=array_keys($products_has_category);
                $products=ProductRepository::get_multiple_product_prices($products_id);
                $category_products_amount=ProductService::get_cart_products_total_price(false,$products);

            } else{
                // todo send toast message to user the coupon is for that special category and its not that product in your category
                return false;
            }
            $not_has_category_products_amount=0;
            if(!empty($products_not_has_category)){
                $products_id=array_keys($products_not_has_category);
                $products=ProductRepository::get_multiple_product_prices($products_id);
                $not_has_category_products_amount=ProductService::get_cart_products_total_price(false,$products);

            }
            if($category_products_amount>0){
                $decrease_amount=$category_products_amount;
                if($coupon->price_type=="cash"){
                    if($coupon->price_offering >= $decrease_amount){
                        $return_decrease_amount=0;
                    } else{
                        $return_decrease_amount= $decrease_amount - $coupon->price_offering;
                    }
                } else{
                    $percentInDecimal = $coupon->price_offering / 100;
                    $return_decrease_amount=(int) ($percentInDecimal * $decrease_amount) ;
                }
                $return_decrease_amount=$return_decrease_amount+$not_has_category_products_amount;
            } else{
                $return_decrease_amount=$not_has_category_products_amount;
            }

        }

        return $return_decrease_amount;


    }

    public static function add_coupon_amount_to_session($amount,$coupon_id,$coupon_name){
        session(["coupon_amount"=>$amount,"coupon_id"=>$coupon_id,"coupon_name"=>$coupon_name]);

    }

    public static function service_add_coupon_amount_to_session($amount,$coupon_id,$coupon_name){
        session(["service_coupon_amount"=>$amount,"service_coupon_id"=>$coupon_id,"service_coupon_name"=>$coupon_name]);

    }

    public static function remove_coupon_session(){
        session()->forget(["coupon_amount","coupon_id","coupon_name"]);

    }
}

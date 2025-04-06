<?php

namespace API\Product\Http\Controllers;

use API\Product\Http\Resources\CartResource;
use API\Product\Http\Resources\GroupProductResource;
use App\Http\Controllers\Controller;
use CMS\Brand\Models\Brand;
use CMS\Cart\Repository\CartRepository;
use CMS\Category\Repositories\CategoryRepository;
use CMS\Club\Services\ClubService;
use CMS\Marketing\Services\AffiliateService;
use CMS\Order\Models\Order;
use CMS\Order\Repository\OrderRepository;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Models\Product;
use CMS\Product\Repository\CouponRepository;
use Illuminate\Http\Request;
use API\Product\Http\Resources\ProductResource;
use CMS\Product\Repository\ProductRepository;
use API\Product\Repositories\APIProductRepository;
use CMS\Product\Service\CouponService;
use CMS\Product\Service\ProductService;
use CMS\Shop\Service\ShopService;
use CMS\Transaction\Events\TransactionSucceed;
use CMS\Transaction\Models\Transaction;
use CMS\Transaction\Repository\TransactionRepository;
use CMS\User\Repositories\UserRepository;
use CMS\Wallet\Services\WalletService;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Facade\Payment;


class ProductController extends Controller
{
    public function recent_products(){
        $products=Product::query()->where("product_type","product")->orderByDesc("created_at")->paginate((int) request()->limit,['*'],"page",\request()->page??1);
        return [
            "products"=>ProductResource::collection($products),
        ];
    }
    public function product_detail(){

        $product=ProductRepository::find_by_slug(request()->slug);
        $related=ProductRepository::get_related_product_by_category($product);
        return [
            "product"=>new ProductResource($product),
            "related_products"=> ProductResource::collection($related)
        ];
    }

    public function search(){
        if(!empty(request()->s)){
            $products=ProductRepository::like_not_paginate(request()->s);
        }

        if(!empty(\request()->filter) || !empty(\request()->type)|| !empty(\request()->brand)){
            $brandId=null;
            if(\request()->brand){
                $brand=Brand::query()->where("name",\request()->brand)->first();
                if($brand){
                    $brandId=$brand->id;
                }
            }
            $products=ProductRepository::get_products_by_categories(false,request()->filter,request()->type,$brandId);

        }


        if($products->isNotEmpty()){
            return ProductResource::collection($products);

        }
    }

    public function get_cart(Request $request){
        $user=request()->user();
        $cart=CartRepository::get_cart($user);

        //return $user->cart->cart_item;
        return  CartResource::collection($user->cart->cart_item);
    }

    public function add_to_cart(Request $request){
        $user=request()->user();
        CartRepository::add_cart_item_to_database($request->product_id,null,$request->quantity,$request->group_product_id,$user);
    }

    public function delete_from_cart(Request $request){
        $user=request()->user();
        CartRepository::delete_cart_item($request->product_id,$user);
    }
    public function increase_cart(Request $request){
        $user=request()->user();
        CartRepository::increase_cart($request->product_id,null,$user);
    }
    public function decrease_cart(Request $request){
        $user=request()->user();
        CartRepository::decrease_cart($request->product_id,$user);
    }


    public function add_order(Request $request){
        $data=[];
        foreach ($request->all() as $key=>$item) {


                $data[]=[
                    "name"=>$key,
                    "value"=>$item,
                ];

        }

        UserRepository::add_meta($data);


        $cart=CartRepository::get_cart($request->user());
        if($cart){


            $cart_products=ProductService::get_cart_products($cart);

            $amount=ShopService::get_order_total_price();
            $gateway_name="zarinpal";
            $data=["user_id"=>auth()->id(),"products_id"=>$cart,"price"=>$amount,"payment_type"=>$gateway_name];
            if($gateway_name=="home"){
                $status=Order::$PROCESSING;
            }
            else{
                $status=Order::$PENDING;
            }
            $order=OrderRepository::add_order($data,$status);


            if($amount > 0 && $gateway_name!="home"){
                CouponService::remove_coupon_session();
                return ShopService::send_to_gateway($gateway_name,$amount,$order);

            }

            else{
                CouponService::remove_coupon_session();
                event(new TransactionSucceed($order));
                ProductService::if_product_in_stock_decrease_stock_number($cart_products,$cart);
                //todo send success order email
                return ShopService::transaction_succeed_redirection($order);
            }

        }
    }


    public function verify_payment(Request $request){
            $transaction_id=$request->transaction;

        $transaction=TransactionRepository::find_by_transaction_id($transaction_id);
        if($transaction->status=="pending"){
            try {
                $receipt = Payment::amount((integer) $transaction->price)->transactionId($transaction_id)->verify();
                TransactionRepository::updateErrorText($transaction," ");
                if($transaction->transactionAble instanceof Order ){
                    TransactionRepository::updateStatus($transaction,Transaction::$PROCESSING);
                    TransactionRepository::update_transactionAble_Status($transaction->transactionable,Transaction::$PROCESSING);

                    $this->order_codes($transaction);
                } elseif($transaction instanceof Order){
                    $this->order_codes($transaction);
                }


                return "success";
            }
            catch (InvalidPaymentException $exception) {
                TransactionRepository::updateStatus($transaction,Transaction::$FAILED);
                TransactionRepository::updateErrorText($transaction,$exception->getMessage());

                TransactionRepository::update_transactionAble_Status($transaction->transactionable,Transaction::$FAILED);



                return "error";
            }
        } else{
            return "success";
        }

    }


    public function order_codes($transaction){
        $total_price=ShopService::get_order_total_price(false);
        $cart=CartRepository::get_cart(request()->user());
        if($cart) {
            $cart_products = ProductService::get_cart_products($cart);
            $affiliate_price=AffiliateService::calculate_affiliate_percent($cart_products);
            AffiliateService::affiliate_update_amount($affiliate_price);
            ProductService::if_product_in_stock_decrease_stock_number($cart_products, $cart);
        }
        UserRepository::add_empty_meta([["name"=>"current_coupon","value"=>0]],request()->user());

        session()->forget("cart");
        if($user_cart=request()->user()->cart()){
            $user_cart->delete();
        }

    }

    public function apply_coupon(Request $request){
        $coupon=CouponRepository::find_coupon_by_name($request->coupon,"product");

        if($message=CouponService::verify_coupon($coupon)){
            return  ["message"=>$message,"type"=>"error","heading"=>"حطایی رخ داده است"];
        }
        $cart=CartRepository::get_cart($request->user());
        $products=ProductService::get_cart_products($cart);
        $amount=ProductService::get_cart_products_total_price(false);

        $new_amount=CouponService::coupon_calculate_amount($coupon,$amount);
        UserRepository::add_meta([["name"=>"current_coupon","value"=>$coupon->id]],$request->user());

        UserRepository::add_user_coupon($request->user(),$coupon);
        CouponService::add_coupon_amount_to_session($new_amount,$coupon->id,$coupon->name);
        CouponRepository::decrease_number($coupon);

        $user=request()->user();
        $cart=CartRepository::get_cart($user);

        //return $user->cart->cart_item;
        return  CartResource::collection($user->cart->cart_item);
    }

}











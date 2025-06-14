<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/17/2020
 * Time: 1:09 PM
 */

namespace CMS\Shop\Service;


use CMS\Club\Services\ClubService;
use CMS\Common\Services\CommonService;
use CMS\Course\Models\Course;
use CMS\Order\Models\Order;
use CMS\Product\Repository\CouponRepository;
use CMS\Product\Service\ProductService;
use CMS\Shop\Repository\ShopRepository;
use CMS\Transaction\Repository\TransactionRepository;
use CMS\Wallet\Models\Wallet;
use CMS\Wallet\Services\WalletService;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class ShopService
{
   public static function send_to_gateway($gateway_name,$amount,$order){
       $invoice=(new Invoice)->amount($amount);

       //$invoice->via($gateway_name);
       return Payment::via($gateway_name)->purchase(
           $invoice,
           function($driver, $transactionId) use($order,$amount,$gateway_name) {

               $data=[];
               $data["price"]=$amount;
               $data["transaction_id"]=(string) $transactionId;
               $data["transaction_holder"]=(string) $transactionId;
               $data["user_id"]=request()->user()->id;
               $data["gateway"]=$gateway_name;
               TransactionRepository::create($data,$order);
           }
       )->pay()->render();
   }

   public static function add_delivery_price_to_amount($amount,$coupon=null){
        $new_amount=$amount;
       $delivery=["delivery_active"=>ShopRepository::getOption("delivery_active"), "delivery_price"=>ShopRepository::getOption("delivery_price"),"delivery_free_active"=>ShopRepository::getOption("delivery_free_active"),"delivery_free_price"=>ShopRepository::getOption("delivery_free_price")];
       $selected_delivery=false;
       if(auth()->user()){
           $selected_delivery=get_user_meta(auth()->user()->id,"selected_delivery");
       }

       if((is_object($selected_delivery) && $selected_delivery->meta_value=="free") || $delivery["delivery_active"] != "on" || $delivery["delivery_price"] <=0 || (!empty(session()->get("coupon_id")) && is_object($coupon2=CouponRepository::find(session()->get("coupon_id"))) && $coupon2->send_free ) || (is_object($coupon) && $coupon->send_free )){
            return $new_amount;
        }

       if($delivery["delivery_free_active"] == "on" && $new_amount>= $delivery["delivery_free_price"] ){
           return $new_amount;
       } elseif ($delivery["delivery_active"] == "on"){
           return $new_amount + (int) $delivery["delivery_price"];
       }

       return $new_amount;
   }


   public static function get_delivery_price($amount){
       $amount_with_delivery=self::add_delivery_price_to_amount($amount);
       $selected_delivery=false;
       if(auth()->user()){
           $selected_delivery=get_user_meta(auth()->user()->id,"selected_delivery");
       }
       if ($amount_with_delivery == $amount || (is_object($selected_delivery) && $selected_delivery->meta_value=="free")){
           return "رایگان!";
       } else {
           return format_price_with_currencySymbol($amount_with_delivery - $amount);
       }
   }


   public static function get_order_total_price($decrease_wallet=true,$products=null){
       $amount=ProductService::get_cart_products_total_price(false,$products);
       $amount=$amount["total_price"];
       $total_price=ShopService::add_delivery_price_to_amount($amount);
       if($decrease_wallet) $total_price=WalletService::decrease_wallet_from_amount($total_price);
        $total_price=ClubService::decrease_club_from_amount($total_price);

       return $total_price;
   }


   public static function transaction_succeed_redirection($transactionable){
       if(is_object($transactionable)){
           if ($transactionable instanceof Order && !$transactionable->is_course){
               CommonService::tel_bot("order_add",$transactionable->id);
               return redirect()->away(env("FRONT_URL")."/panel/orders/".$transactionable->id."/?success=true");

           } elseif($transactionable instanceof Order && $transactionable->is_course){
               toastMessage("پرداخت با موفقیت انجام شد و دوره برای شما اضافه شد");

               return redirect()->route("home");
           } elseif ($transactionable instanceof Wallet ){
               toastMessage("پرداخت با موفقیت انجام شد و موجودی کیف پول شما افزایش پیدا کرد.");
               return redirect()->away(env("FRONT_URL")."/panel/wallet?success=true");

           }
       }
       toastMessage("پرداخت با موفقیت انجام شد.");
       return redirect()->route("home");
    }

    public static function transaction_error_redirection($transactionable,$message){
        toastMessage($message,"خطایی رخ داد","error");
        if(is_object($transactionable)){
            if ($transactionable instanceof Order && !$transactionable->is_course){
                ShopService::clear_cart($transactionable->user);
                return redirect()->away(env("FRONT_URL")."/panel/orders/".$transactionable->id."/?fail=true");

            } elseif($transactionable instanceof Order && $transactionable->is_course){

                return redirect()->route("cart.index");
            } elseif ($transactionable instanceof Wallet ){
                return redirect()->away(env("FRONT_URL")."/panel/wallet?fail=true");

            }
        }

        return redirect()->route("home");
    }
    public static function clear_cart($user){

        if($user_cart=$user->cart){
            $user_cart->delete();
        }

    }

    public static function create_order_factor($amount,$cart,$cart_products){
        $factor=[];
        if(!empty(session()->get("coupon_amount"))){
            $factor["coupon_amount"]=session()->get("coupon_amount");
        }
        $factor["delivery"]=ShopService::get_delivery_price($amount);
        $factor["wallet"]=WalletService::decreasing_wallet_amount($amount,true);

        foreach($cart as $parent2_cart_product) {
            foreach ($parent2_cart_product as $parent_cart_product) {
                $product = $cart_products->where("id", $parent_cart_product["id"])->first();
                $variations="";
                if(isset($parent_cart_product["variation"])){
                    $variations=$product->get_variation_by_value($parent_cart_product["variation"]);
                }
                $factor["products"][$product->id]=[
                    "id"=>$product->id,
                    "title"=>$product->title,
                    "price"=>$product->product_price_with_quantity($parent_cart_product["quantity"],$parent_cart_product["variation"]),
                    "quantity"=>$parent_cart_product["quantity"],
                    "variation"=>$parent_cart_product["variation"],
                    "variations"=>$variations,
                ];
            }
        }
        return $factor;
    }
}

<?php

namespace API\Product\Http\Controllers;

use API\Category\Http\Resources\CategoryResource;
use API\Product\Http\Resources\BuyProductOrderResource;
use API\Product\Http\Resources\CartResource;
use API\Product\Http\Resources\CurrencyOrderResource;
use API\Product\Http\Resources\GroupProductResource;
use API\Product\Http\Resources\InterPaymentOrderResource;
use API\Product\Http\Resources\OrderResource;
use API\User\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use CMS\Brand\Models\Brand;
use CMS\Cart\Repository\CartRepository;
use CMS\Category\Repositories\CategoryRepository;
use CMS\Club\Services\ClubService;
use CMS\Marketing\Services\AffiliateService;
use CMS\Order\Models\Order;
use CMS\Order\Repository\OrderRepository;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Models\Coupon;
use CMS\Product\Models\Product;
use CMS\Product\Repository\CouponRepository;
use CMS\Setting\Repository\SettingRepository;
use CMS\Shop\Repository\ShopRepository;
use CMS\User\Models\User_address;
use CMS\User\Models\UserBankCart;
use CMS\Wallet\Repository\WalletRepository;
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
        $products=Product::query();
        if(request()->product_type){
            $products=$products->where("product_type",request()->product_type);
        }
        $products= $products->orderByDesc("created_at")->paginate((int) request()->limit,['*'],"page",\request()->page??1);
        return [
            "products"=>ProductResource::collection($products),
        ];
    }
    public function categories_with_products(){
        $categories=CategoryRepository::get_by_type("product",null,request()->product_type);
        return CategoryResource::collection($categories);
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
        $cart_products=ProductService::get_cart_products($cart);
        $cart_products_total_price=ProductService::get_cart_products_total_price(false);
        $fees=$cart_products_total_price["fees"];
        $cart_products_total_price=$cart_products_total_price["total_price"];

        $cart_products_total_price_without_fee=$cart_products_total_price -  $fees;

        $cart_products_total_number=ProductService::get_cart_products_total_number();

        $products=[];
        foreach ($cart as $cartItem){
            $firstItem = reset($cartItem);
            $product=Product::find($firstItem["id"]);
            $variations=null;
            if(isset($firstItem["variation"])){
                $variations=$product->get_variation_by_value($firstItem["variation"]);
            }
            $product["price"]=$product->product_price_with_quantity($firstItem["quantity"],$firstItem["variation"]);
            $product["variations"]=$variations;
            $product["variation_id"]=$firstItem["variation"];
            $product["quantity2"]=$firstItem["quantity"];
            $product["media_data"]= [
                "alt"=>$product->media->alt ?? null,
                "url"=>$product->media->url?? "https://avalcard.com/img/Placeholder_view_vector.svg.png",
            ];
            $products[]=$product;
        }
        $cart_products_offer_price=ProductService::get_cart_products_offer_price();
        $dollar=convertToRial(1,"137203");

        $coupon_amount=0;
        $cart_products_total_price_not_coupon=ProductService::get_cart_products_total_price(false,false,false);
        $cart_products_total_price_not_coupon=$cart_products_total_price_not_coupon["total_price"];
        $full_price=$cart_products_total_price_not_coupon + $cart_products_offer_price;
        if($coupon_id=$user->cart->coupon_id){
            $coupon=Coupon::find($coupon_id);
            if($coupon->price_type=="cash"){
                $coupon_amount= format_price_with_currencySymbol($coupon->price_offering);
            } else{
                $coupon_amount= "%".$coupon->price_offering;
            }
        }
        $ten_percent = $cart_products_total_price * 0.10;
        $cart_products_total_price = $cart_products_total_price + $ten_percent;

        return  ["cart"=>$cart,"ten_percent"=>format_price_with_currencySymbol($ten_percent),"fees"=>format_price_with_currencySymbol($fees),"cart_products_total_price_without_fee"=>format_price_with_currencySymbol($cart_products_total_price_without_fee),"coupon_amount"=>$coupon_amount,"dollar"=>$dollar,"cart_products_offer_price"=>format_price_with_currencySymbol($cart_products_offer_price), "products"=>$products,"cart_total_price"=>format_price_with_currencySymbol($cart_products_total_price), "cart_full_price"=>format_price_with_currencySymbol($full_price), "cart_products_total_number"=>$cart_products_total_number];
    }

    public function add_to_cart(Request $request){
        $user=request()->user();
        CartRepository::add_cart_item_to_database($request->product_id,$user,$request->variation_id,$request->quantity,$request->group_product_id);
    }

    public function delete_from_cart(Request $request){
        $user=request()->user();
        CartRepository::delete_cart_item($request->product_id,$user,$request->variation_id);
        return new UserResource($user);
    }
    public function increase_cart(Request $request){
        $user=request()->user();
        CartRepository::increase_cart($request->product_id,$user,$request->variation_id);
        return new UserResource($user);
    }
    public function decrease_cart(Request $request){
        $user=request()->user();
        CartRepository::decrease_cart($request->product_id,$user,$request->variation_id);
        return new UserResource($user);
    }


    public function add_order(Request $request){

        $cart=CartRepository::get_cart($request->user());
        if($cart){


            $cart_products=ProductService::get_cart_products($cart);

            $order_type=$cart_products[0]->product_type;

            $amount=ShopService::get_order_total_price();
            $ten_percent = $amount * 0.10;
            $amount = $amount + $ten_percent;

            $gateway_name=$request->gateway_name;
            $data=["user_id"=>$request->user()->id,"products_id"=>$cart,"price"=>$amount,"payment_type"=>$gateway_name];
            if($gateway_name=="wallet"){
                $wallet=WalletRepository::user_wallet($request->user());
                if($amount <= $wallet->price){
                    WalletRepository::decrease($amount,$request->user());
                    $status=Order::$PROCESSING;

                } else{
                    return ["wallet_fail"=>true];
                }
            }
            else{
                $status=Order::$PENDING;
            }

            $order=OrderRepository::add_order($data,$status,$order_type);
            $factor=ShopService::create_order_factor($amount,$order->products_id,$cart_products);
            $factor["ten_percent"]=request()->ten_percent;
            $factor["fee"]=request()->fee;

            $order->factor=$factor;

            if(request()->user()->cart->coupon_id){
                $coupon=Coupon::find(request()->user()->cart->coupon_id);
                if($coupon){
                    if($coupon->price_type=="cash"){
                        $coupon_amount= format_price_with_currencySymbol($coupon->price_offering);
                    } else{
                        $coupon_amount= "%".$coupon->price_offering;
                    }
                    $order->coupon_name=$coupon->name;
                    $order->coupon_discount=$coupon_amount;
                }

            }


            if($gateway_name=="wallet"){
                $order->payed_at=now();
            }

            $order->save();

            if($amount > 0 && $gateway_name!="wallet"){
                CouponService::remove_coupon_session();
                $amount = (int) $amount;
                return ShopService::send_to_gateway($gateway_name,$amount,$order);

            }

            else{
                CouponService::remove_coupon_session();
                ShopService::clear_cart($order->user);

                ProductService::if_product_in_stock_decrease_stock_number($cart_products,$cart);
                //todo send success order email
               return [
                   "url"=>env("FRONT_URL")."/panel/orders/".$order->id."/?success=true"
               ];
            }

        }
    }


    public function pay_order(Request $request){
        $user=request()->user();
        $order=$user->orders()->where("id",$request->id)->firstOrFail();

        if($order->status=="pending"){
            $gateway_name=$request->payment;
            $order->payment_type=$gateway_name;
            $order->save();

            if($gateway_name=="wallet"){
                $wallet=WalletRepository::user_wallet($request->user());
                if($order->price <= $wallet->price){
                    WalletRepository::decrease($order->price,$request->user());
                    $status=Order::$PROCESSING;
                    $order->status=$status;
                    $order->payed_at=now();
                    $order->save();
                    CouponService::remove_coupon_session();
                    ShopService::clear_cart($order->user);


                    //todo send success order email
                    return [
                        "url"=>env("FRONT_URL")."/panel/orders/".$order->id."/?success=true"
                    ];
                } else{
                    return ["wallet_fail"=>true];
                }
            }
            else{

                return ShopService::send_to_gateway($gateway_name,$order->price,$order);

            }



        }



    }

    public function orders(Request $request){
        $user=request()->user();
        $orders=OrderRepository::user_all_orders($user,null,"currency_income");

        return BuyProductOrderResource::collection($orders);
    }
    public function order_detail(Request $request){
        $user=request()->user();
        $order=$user->orders()->where("id",$request->id)->firstOrFail();
        if($order->order_type == "buy_product"){
            return new BuyProductOrderResource($order);
        }
        if($order->order_type == "inter_payment"){
            return new InterPaymentOrderResource($order);
        }
        return new OrderResource($order);
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
                    $transaction->transactionable->payed_at=now();
                    $transaction->transactionable->save();
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
        $cart=CartRepository::get_cart($transaction->transactionAble()->user()->cart());
        if($cart) {
            $cart_products = ProductService::get_cart_products($cart);
            $affiliate_price=AffiliateService::calculate_affiliate_percent($cart_products);
            AffiliateService::affiliate_update_amount($affiliate_price);
            ProductService::if_product_in_stock_decrease_stock_number($cart_products, $cart);
        }
        UserRepository::add_empty_meta([["name"=>"current_coupon","value"=>0]],$transaction->transactionAble()->user());

        session()->forget("cart");
        if($user_cart=$transaction->transactionAble()->user()->cart()){
            $user_cart->delete();
        }

    }

    public function apply_coupon(Request $request){
        $coupon=CouponRepository::find_coupon_by_name($request->coupon,"product");

        if($message=CouponService::verify_coupon($coupon)){
            return  ["message"=>$message,"type"=>"error","heading"=>"حطایی رخ داده است"];
        }
        UserRepository::add_meta([["name"=>"current_coupon","value"=>$coupon->id]],$request->user());

        UserRepository::add_user_coupon($request->user(),$coupon);
        $request->user()->cart->update([
            "coupon_id"=>$coupon->id
        ]);
        CouponRepository::decrease_number($coupon);


        return  ["message"=>"با موفقیت اضافه شد","type"=>"success","heading"=>"با موفقیت اضافه شد"];

    }


    public function apply_coupon_on_order(Request $request){
        $order=OrderRepository::find($request->id);
        $coupon=CouponRepository::find_coupon_by_name($request->coupon,"product");

        if($message=CouponService::verify_coupon($coupon)){
            return  ["message"=>$message,"type"=>"error","heading"=>"حطایی رخ داده است"];
        }
        if($order->coupon_name){
            return  ["message"=>"در حال حاظر یک کوپن بر روی سفارش شما غعال شده است","type"=>"error","heading"=>"حطایی رخ داده است"];

        }

        UserRepository::add_user_coupon($request->user(),$coupon);

        if ($coupon->price_type == "cash") {
            $discount = $coupon->price_offering;
            $coupon_amount = format_price_with_currencySymbol($discount);
        } else {
            $discount = ($order->price * $coupon->price_offering) / 100;
            $coupon_amount = "%" . $coupon->price_offering;
        }

// حالا قیمت نهایی بعد از اعمال تخفیف:
        $final_price = $order->price - $discount;
        $order->price=$final_price;
        $order->coupon_name=$coupon->name;
        $order->coupon_discount=$coupon_amount;
        $order->save();
        CouponRepository::decrease_number($coupon);

        if($order->order_type == "gift_cart"){
            return  new OrderResource($order);
        } elseIf($order->order_type == "inter_payment"){
            return  new InterPaymentOrderResource($order);
        } elseIf($order->order_type == "buy_product"){
            return  new BuyProductOrderResource($order);
        }


    }


    public function order_comment(Request $request){
        $order=OrderRepository::find($request->id);
        $order->comment=[
            "rate"=>$request->pain,
            "text"=>$request->reason,
        ];
        $order->save();
    }


    public function add_currency_income_order(Request $request){
            $amount=convertToRial($request->amount,$request->currency_code,false);
            $data=["user_id"=>$request->user()->id,"price"=>$request->final_rial_amount,"payment_type"=>"currency_income"];
            $status=Order::$ON_HOLD;
            $order=OrderRepository::add_order($data,$status,"currency_income");
            $bank_cart=UserBankCart::query()->where("user_id",$request->user()->id)->where("id",$request->bankId)->first();


        $order->factor=[
                "country"=>$request->country,
            "currency" => str_replace('_', ' ', $request->currency),
            "currency_code"=>$request->currency_code,
                "price"=>$request->amount,
                "unit_price"=>convertToRial(1,$request->currency_code,false),
                "name"=>$request->accountHolder,
                "for"=>$request->serviceDescription,
                "receive_type"=>$request->receiveMethod,
                "description"=>$request->additionalNotes,
                "fee_percent"=>$request->fee_percent,
                "fee_amount"=>$request->fee_amount,
                "final_rial_amount"=>$request->final_rial_amount,
                "before_fee_price"=>$amount,
                "whatsapp"=>$request->whatsapp??"",
                "bank_name"=>$bank_cart? $bank_cart->bank_name_fa :"",
                "cart_number"=>$bank_cart? $bank_cart->cart_number :"",
                "shaba_number"=>$bank_cart? $bank_cart->shaba_number :"",
            ];

            $order->save();
            return new CurrencyOrderResource($order);
    }

    public function currency_income_orders(Request $request){
        $user=request()->user();
        $orders=OrderRepository::user_all_orders($user,"currency_income");

        return CurrencyOrderResource::collection($orders);
    }
    public function currency_income_detail(Request $request){
        $user=request()->user();
        $order=$user->orders()->where("id",$request->id)->firstOrFail();

        return new CurrencyOrderResource($order);
    }


    protected function get_currencies_price(){
        return [
            "دلار"=>[
                "rate"=>convertToRial(1,"137203",false),
                "code"=>137203,
            ],
            "دلار_کانادا"=>[
                "rate"=>convertToRial(1,"137220",false),
                "code"=>137220,
            ],
            "دلار_هنگ_کنگ"=>[
                "rate"=>convertToRial(1,"137225",false),
                "code"=>137225,
            ],
            "درهم_امارات"=>[
                "rate"=>convertToRial(1,"137205",false),
                "code"=>137205,
            ],
            "دلار_استرالیا"=>[
                "rate"=>convertToRial(1,"137219",false),
                "code"=>137219,
            ],
            "رئال_برزیل"=>[
                "rate"=>convertToRial(1,"520837",false),
                "code"=>520837,
            ],
            "یورو"=>[
                "rate"=>convertToRial(1,"137204",false),
                "code"=>137204,
            ],
            "پزوی_آرژانتین"=>[
                "rate"=>convertToRial(1,"520841",false),
                "code"=>520841,
            ],
            "هریونیا_اوکراین"=>[
                "rate"=>convertToRial(1,"520846",false),
                "code"=>520846,
            ],
            "پزوی_مکزیک"=>[
                "rate"=>convertToRial(1,"520835",false),
                "code"=>520835,
            ],
            "پوند"=>[
                "rate"=>convertToRial(1,"137206",false),
                "code"=>137206,
            ],
            "لیر_ترکیه"=>[
                "rate"=>convertToRial(1,"137224",false),
                "code"=>137224,
            ],
            "دینار_کویت"=>[
                "rate"=>convertToRial(1,"137211",false),
                "code"=>137211,
            ],
            "ین_ژاپن"=>[
                "rate"=>convertToRial(1,"137209",false),
                "code"=>137209,
            ],
            "یوان_چین"=>[
                "rate"=>convertToRial(1,"137221",false),
                "code"=>137221,
            ],
            "روپیه_هند"=>[
                "rate"=>convertToRial(1,"137227",false),
                "code"=>137227,
            ],
        ];
    }


    public function add_buy_product_order(Request $request){
        $amount=$request->fullPrice;
        $data=["user_id"=>$request->user()->id,"price"=>$amount,"payment_type"=>"buy_product"];
        $status=Order::$ON_HOLD;
        $order=OrderRepository::add_order($data,$status,"buy_product");
        $address=User_address::query()->where("user_id",$request->user()->id)->where("id",$request->addressId)->first();
        $order->factor=[
            "product_id"=>$request->product_id,
            "currency_amount"=>$request->amount,
            "currency"=>$request->currency,
            "currency_code"=>$request->currency_code,
            "product_price"=>$request->rialAmount,
            "unit_price"=>convertToRial(1,$request->currency_code,false),
            "des"=>$request->des,
            "link"=>$request->link,
            "quantity"=>$request->quantity,
            "submitDate"=>$request->submitDate,
            "weight"=>$request->weight,
            "fee_percent"=>$request->fee_percent,
            "fee_amount"=>$request->fee_amount,
            "weightUnit"=>$request->weightUnit,
            "shipping"=>$request->shippingCostInToman,
            "ten_percent"=>format_price_with_currencySymbol($request->ten_percent),
            "postal_code"=>$address? $address->postal_code : "",
            "phone"=>$address? $address->phone : "",
            "address"=>$address? $address->address : "",
            "state"=>$address? $address->state : "",
            "city"=>$address? $address->city : "",
        ];

        $order->save();
        return new BuyProductOrderResource($order);
    }

    public function add_inter_payment_order(Request $request){
        $currency_price=$request->price;
        $product=Product::find($request->product_id);
        $amount=convertToRial($currency_price,$request->currency_code,false);
        $amount = ceil($amount);
        if (!is_null($product->fee_percent) && $product->fee_percent > 0) {
            $fee_amount = ($amount * $product->fee_percent) / 100;
            $amount += $fee_amount;
        }
        $ten_percent = $amount * 0.10;
        $amount = $amount + $ten_percent;

        $data=["user_id"=>$request->user()->id,"price"=>$amount,"payment_type"=>"inter_payment"];
        $status=Order::$PENDING;
        $order=OrderRepository::add_order($data,$status,"inter_payment");


        $factor_user_info=[];
        if($product){
            $user_info=$product->user_info;

            if(is_array($user_info)){
                foreach ($user_info as $key=>$value){
                    if(isset($value->label) && isset($request->{$value->label})){
                        $fieldValue = $request->input($value->label);
                        $factor_user_info[$key]=[
                            "value"=>$fieldValue,
                            "label"=>$value->label,
                        ];
                    }
                }
            }
        }


        $order->factor=[
            "product_id"=>$request->product_id,
            "product_name"=>$product->title,
            "currency_amount"=>$currency_price,
            "currency"=>$request->currency,
            "currency_code"=>$request->currency_code,
            "product_price"=>$amount,
            "unit_price"=>convertToRial(1,$request->currency_code,false),
            "des"=>$request->additionalNotes,
            "isAvailableAtNight"=>$request->isAvailableAtNight,
            "ten_percent"=>format_price_with_currencySymbol($ten_percent),
            "fee"=>format_price_with_currencySymbol($fee_amount),
            "factor_user_info"=>json_encode($factor_user_info),

        ];

        $order->save();
        return new InterPaymentOrderResource($order);
    }
    public function get_currency_income_fee(){
        $setting=SettingRepository::getOption("currency_income_setting");
        return $setting;
    }


}











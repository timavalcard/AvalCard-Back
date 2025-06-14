<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/23/2020
 * Time: 1:17 PM
 */

namespace CMS\Cart\Repository;


use CMS\Cart\Models\Cart;
use CMS\Cart\Models\CourseCart;
use CMS\Product\Models\Product;
use CMS\Product\Repository\ProductRepository;

class CartRepository
{
    public static function add_cart_item_to_session( $product,$variation=null,$quantity=1,$group_product=null)
    {

        if(ProductRepository::in_stock($product,1,$variation)){

            $cartItem=session()->get("cart");

            if(isset($cartItem[$product->id][$variation])){
                if($quantity!=1){
                    $cartItem[$product->id][$variation]["quantity"]+=$quantity;
                } else{
                    $cartItem[$product->id][$variation]["quantity"]++;

                }
            }
            elseif(!isset($cartItem[$product->id]) || !isset($cartItem[$product->id][$variation])){
                $cartItem[$product->id][$variation]=[
                    "id" => $product->id,
                    "quantity" => $quantity,
                    "variation"=>$variation,
                    "group_product"=>$group_product
                ];
            }

            session()->forget("cart");
            session()->put("cart",$cartItem);
        } else{
            toastMessage("محصول مورد نظر در انبار موجود نیست","در انبار موجود نیست","info");
        }
    }

    public static function add_cart_item_to_database( $product,$user,$variation=null,$quantity=1,$group_product=null)
    {
        if(is_numeric($product)){
            $product=ProductRepository::find($product);
        }
        if($user){
            if(ProductRepository::in_stock($product,1,$variation)) {
                    //if(!$variation) $variation=0;
                    $user_cart = [];
                    if ($user->cart) {
                        $user_cart = $user->cart->toArray();

                    }

                    if (!isset($user_cart["cart_item"][$product->id]) || !isset($user_cart["cart_item"][$product->id][$variation])) {
                        $user_cart["cart_item"][$product->id][$variation] = [
                            "id" => $product->id,
                            "quantity" => $quantity,
                            "variation"=>$variation,
                            "group_product"=>$group_product
                        ];
                    }
                    elseif (isset($user_cart["cart_item"][$product->id][$variation]) ) {

                        if($quantity!=1){
                            $user_cart["cart_item"][$product->id][$variation]["quantity"]+=$quantity;
                        } else{
                            $user_cart["cart_item"][$product->id][$variation]["quantity"]++;

                        }
                    }
                    Cart::updateOrCreate([
                        "user_id" => auth()->id()

                    ], ["cart_item" => $user_cart["cart_item"]]);
                } else{
                toastMessage("محصول مورد نظر در انبار موجود نیست","در انبار موجود نیست","info");

            }
        }
    }

    public static function add_cart_item_from_session_to_database()
    {
        if ($user) {
            $cartItem = session()->get("cart");

            $userCartItem = $user->cart ? $user->cart->toArray() : null;

            if (!empty($cartItem)) {

                foreach ($cartItem as $parent_id => $parent_value) {
                    foreach ($parent_value as $id => $value) {


                        if (isset($userCartItem["cart_item"][$value["id"]][$value["variation"]])) {
                            $userCartItem["cart_item"][$value["id"]][$value["variation"]]["quantity"] += $value["quantity"];
                        }
                        else {
                            $userCartItem["cart_item"][$value["id"]][$value["variation"]] = [
                                "id" => $value["id"],
                                "quantity" => $value["quantity"],
                                "variation" => $value["variation"],
                            ];
                        }
                    }
                }
                if ($user->cart) {
                    $user->cart->delete();
                }
                Cart::create([
                    "user_id" => auth()->id(),
                    "cart_item" => $userCartItem["cart_item"]
                ]);
                //session()->forget("cart");
            }
        }
    }

    public static function course_add_cart_item_to_session( $course,$type="course"){

        $cartItem=session()->get("course_cart");

        if(!isset($cartItem[$type][$course->id])){
            $cartItem[$type][$course->id]=[
                "id" => $course->id,
                "quantity" => 1,
                "type"=>$type
            ];
        }
        else{
            $cartItem=[
                $type=>[
                    $course->id=>[
                        "id" => $course->id,
                        "quantity" => 1,
                        "type"=>$type
                    ]
                ]
            ];
        }

        session()->forget("course_cart");
        session()->put("course_cart",$cartItem);

    }

    public static function course_add_cart_item_to_database( $course,$type="course")
    {

        if($user){

            $user_cart = [];
            if ($user->course_cart) {
                $user_cart = $user->course_cart->toArray();

            }

            if (!isset($user_cart["cart_item"][$type][$course->id])) {
                $user_cart["cart_item"][$type][$course->id] = [
                    "id" => $course->id,
                    "quantity" => 1,
                    "type"=>$type
                ];
            }

            CourseCart::updateOrCreate([
                "user_id" => auth()->id()

            ], ["cart_item" => $user_cart["cart_item"]]);
        }
    }


    public static function get_cart($user=null)
    {
        if($user){
            if($user->cart){
            return $user->cart->cart_item;
            }
        } else{
            return session()->get("cart");
        }
    }

    public static function course_get_cart()
    {
        if($user){
            if($user->course_cart){
                return $user->course_cart->cart_item;
            }
        } else{
            return session()->get("course_cart");
        }
    }


    public static function delete_cart_item($id,$user,$variation=null)
    {
        if($user){
            if($user->cart) {
                $cart = $user->cart->cart_item;
                if(!$variation){
                    unset($cart[$id]);
                }
                unset($cart[$id][$variation]);
                if(empty($cart[$id])){
                    unset($cart[$id]);
                }


                $user->cart->update([
                    "cart_item" => $cart,

                ]);
            }
        }  else{

            $cart=session()->get("cart");
            if($cart){
                if(!$variation){
                    unset($cart[$id]);
                }
                unset($cart[$id][$variation]);
                if(empty($cart[$id])){
                    unset($cart[$id]);
                }

                session()->forget("cart");
                session()->put("cart",$cart);

            }
        }

    }

    public static function course_delete_cart_item($id){
        $type="course";
        if($type=="Lesson") $type="lesson";
        if($user){
            if($user->course_cart) {
                $cart = $user->course_cart->cart_item;

                unset($cart[$type][$id]);
                $user->course_cart->update([
                    "cart_item" => $cart,

                ]);
            }
        }  else{

            $cart=session()->get("course_cart");
            if($cart){
                unset($cart[$type][$id]);

                session()->forget("course_cart");
                session()->put("course_cart",$cart);

            }
        }
    }


    public static function increase_cart($id,$user,$variation=null)
    {

        if(ProductRepository::in_stock($id,1,$variation)) {

            if ($user) {
                if ($user->cart) {
                    $cart = $user->cart->cart_item;
                    $cart[$id][$variation]["quantity"]++;
                    $user->cart->update([
                        "cart_item" => $cart,

                    ]);
                }
            } else {
                $cart = session()->get("cart");
                if ($cart) {
                    $cart[$id][$variation]["quantity"]++;

                    session()->forget("cart");
                    session()->put("cart", $cart);

                }
                return  true;
            }
        } else{
            toastMessage("محصول مورد نظر در انبار موجود نیست","در انبار موجود نیست","info");
            return false;
        }
    }

    public static function decrease_cart($id,$user,$variation=null)
    {

        if($user){
            if($user->cart) {
                $cart = $user->cart->cart_item;
                if ($cart[$id][$variation]["quantity"] == 1) {
                    unset($cart[$id][$variation]);
                } else {
                    $cart[$id][$variation]["quantity"]--;
                }
                $user->cart->update([
                    "cart_item" => $cart,

                ]);
            }
        } else{

        $cart=session()->get("cart");
            if($cart){
                if($cart[$id][$variation]["quantity"]==1){
                    unset($cart[$id][$variation]);
                    if(empty($cart[$id])){
                        unset($cart[$id]);
                    }
                } else{
                    $cart[$id][$variation]["quantity"]--;
                }

                session()->forget("cart");
                session()->put("cart",$cart);

            }
        }
    }

}

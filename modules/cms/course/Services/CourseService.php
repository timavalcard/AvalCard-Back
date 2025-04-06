<?php


namespace CMS\Course\Services;


use CMS\Course\Repositories\CourseRepo;

class CourseService
{
    public static $courses=[];
    public static $course_quantity=[];
    public static $course_type=[];

    public static function get_cart_courses($cart)
    {
        if($cart){

            $course_quantity=[];
            $course_type=[];
            $courses=collect();
            foreach ($cart as $type=>$cart_items) {
                foreach ($cart_items as $cart_item_course_id=>$cart_item) {
                    $course_id[]=$cart_item_course_id;
                    $courses->push(CourseRepo::get_multiple_course_prices($cart_item_course_id,$type));
                    $course_quantity[$cart_item_course_id]=$cart_item["quantity"];
                    $course_type[$cart_item_course_id]=$cart_item["type"];
                }
            }
            self::$courses=$courses;




            self::$course_quantity=$course_quantity;
            self::$course_type=$course_type;
            return $courses;
        }

    }

    public static function get_cart_courses_total_price($format=true,$course=null,$with_coupon=true,$variation=null)
    {
        if(!empty(session()->get("coupon_amount")) && $with_coupon){
            $amount=session()->get("coupon_amount");
            if($format){
                return format_price_with_currencySymbol($amount);

            }
            return $amount;
        } else{
            $courses=self::$courses;
            if($course){
                $courses=$course;
            }
            if($courses){
                $total_price=0;
                foreach ($courses as $course) {
                        $course_price=$course->price;
                        $total_price+=$course_price * 1;
                }
                if($format){

                    return format_price_with_currencySymbol($total_price);

                } else{
                    return  $total_price;
                }
            }

        }
        return null;
    }


    public static function get_cart_courses_offer_price($variation=null){
        $courses=self::$courses;
        $course_quantity=self::$course_quantity;
        $course_type=self::$course_type;
        if($courses){
            $total_offer_price=0;
            foreach ($courses as $course) {
                $course_price=$course->price;
                        $price = $course_price;
                        $new_price = ($price) * 1;
                        $total_offer_price += $new_price;
            }
            return format_price_with_currencySymbol($total_offer_price);
        }

    }

    public static function get_cart_courses_total_number()
    {
        $course_quantity=self::$course_quantity;

        if(!empty($course_quantity)){
            return array_sum($course_quantity);

        } return 0;

    }
}

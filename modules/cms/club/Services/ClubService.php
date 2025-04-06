<?php


namespace CMS\Club\Services;



use CMS\Club\Repository\ClubRepository;
use CMS\Setting\Repository\SettingRepository;
use CMS\User\Repositories\UserRepository;

class ClubService
{
    public static function get_setting(){
        $setting=[];
        $setting["product_point_price"]=SettingRepository::getOption("product_point_price");
        $setting["product_point"]=SettingRepository::getOption("product_point");
        $setting["service_point_price"]=SettingRepository::getOption("service_point_price");
        $setting["service_point"]=SettingRepository::getOption("service_point");
        $setting["min_need_point"]=SettingRepository::getOption("min_need_point");
        $setting["club_offer_price"]=SettingRepository::getOption("club_offer_price");
        $setting["club_offer_point"]=SettingRepository::getOption("club_offer_point");
        return $setting;
    }
    public static function get_point_number($amount,$type="product"){
        $setting=self::get_setting();
        $user=auth()->user();
        $point=0;
        $user_club_point=$user->club_point;
        if($type=="product"){
            if( $amount >= $setting["product_point_price"] ){

                $repeat=(int) floor($amount/$setting["product_point_price"]);
                if($repeat >= 1){
                    $point=$setting["product_point"] * $repeat;
                }

            }
        } elseif ($type="service"){
            if( $amount >= $setting["service_point_price"] ){
                $repeat=(int) floor($amount/$setting["service_point_price"]);
                if($repeat >= 1){
                    $point=$setting["service_point"] * $repeat;


                }

            }
        }

        if($point){
            $point=$point+$user_club_point;
            return $point;
        }

    }
    public static function increase($amount,$type="product"){
        $setting=self::get_setting();
        $user=auth()->user();
        if($user){
            $point=0;
            $user_club_point=$user->club_point;
            if($type=="product"){
                if( $amount >= $setting["product_point_price"] ){
                    $repeat=(int) floor($amount/$setting["product_point_price"]);
                    if($repeat >= 1){
                        $point=$setting["product_point"] * $repeat;
                    }

                }
            } elseif ($type="service"){
                if( $amount >= $setting["service_point_price"] ){
                    if($setting["service_point_price"]){
                        $repeat=(int) floor($amount/$setting["service_point_price"]);
                        if($repeat >= 1){
                            $point=$setting["service_point"] * $repeat;


                        }
                    }


                }
            }

            if($point){
                $point=$point+$user_club_point;
                toastMessage("مقدار $point عدد به امتیازات باشگاه مشتریان شما اضافه شد");
                UserRepository::add_meta([["name"=>"club_point","value"=>$point]]);
            }

        }

    }

    public static function user_can_use_club($user=null,$format=true,$use=true){
        if(!$user) $user=auth()->user();
        if($user){


        $setting=self::get_setting();
        $user_club_point=$user->club_point;

        if($user_club_point < $setting["min_need_point"]){
            if($use){
            toastMessage("شما باید حداقل".$setting["min_need_point"]."امتیاز داشته باشید","","info");

            } else{
                return false;
            }
        }
        else{
            if($setting["club_offer_point"]){


            $repeat=(int) floor($user_club_point/$setting["club_offer_point"]);
            if($repeat > 0){
                if($format){
                    $price= format_price_with_currencySymbol($setting["club_offer_price"] * $repeat);

                }
                else{
                $price= $setting["club_offer_price"] * $repeat;

                }
            }

            return [
              "setting"=>$setting,
              "user_club_point"=>$user_club_point,
              "price"=>$price,
            ];
            }

        }
        }


        return false;
    }

    public static function cancel_using_club(){
        if(session()->get("club")){
            session()->forget("club");
            return true;
        }
        return false;
    }

    public static function decreasing_club_amount($amount,$format=true){
        if(session()->get("club")){
            $club_price=(integer) session()->get("club")["price"];
            $total_price=$amount - $club_price;
            if($total_price<=0) {
                $total_price=$amount;
            } else{
                $total_price=$club_price;
            }
            if($format)  return format_price_with_currencySymbol($total_price);
            return $total_price;
        }
        return  false;
    }

    public static function decrease_club_from_amount($amount){
        if(session()->get("club")){
            $club_price=(integer) session()->get("club")["price"];
            $total_price=$amount - $club_price;
            if($total_price<0) return 0;
            return $total_price;
        }
        return  $amount;
    }

    public static function clear_using_club($decrease_club_amount){
        if(session()->get("club")){
            $club_price=(integer) $decrease_club_amount;
            $user_club=ClubService::user_can_use_club();
            $setting=ClubService::get_setting();
            $new_club_point=(int) ceil($club_price / $setting["club_offer_price"]) * 10;
            ClubRepository::decrease($new_club_point);
            session()->forget("club");
        }
        return  false;
    }

}

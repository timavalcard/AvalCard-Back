<?php


namespace CMS\Shop\Repository;


use CMS\Order\Models\Order;
use CMS\Shop\Models\ShopSetting;
use CMS\User\Models\User;

class ShopRepository
{
    public static function create_setting($values)
    {

        foreach ($values as $settingKey=>$value) {
            if($settingKey=="country_in_delivery"){
                $value=self::create_deliver_country($settingKey,$value);
            }

               ShopSetting::updateOrCreate(
                   ["setting_key" => $settingKey],
                   ["setting_value" => $value]);

        }
    }

    public static function create_deliver_country($settingKey,$value)
    {
            if(!empty(array_filter($value))){
            $value=[$value[0]=>array_slice($value,1)];
            $country_in_delivery_object=ShopSetting::where("setting_key",$settingKey)->first();
            $country_in_delivery=[];
            if($country_in_delivery_object) $country_in_delivery=$country_in_delivery_object->setting_value;

                $country_in_delivery[]=$value;
                $value=array_filter($country_in_delivery);

                return $value;
            } else{
                return null;
            }
    }


    public static function delete_delivery_country($countries)
    {
        ShopSetting::updateOrCreate(
            ["setting_key"=>"country_in_delivery"],
            ["setting_value"=>$countries])
        ;
    }


    public static function getOption($key)
    {
        if($option=ShopSetting::where("setting_key",$key)->first()){

            return $option->setting_value;
        }
    }


    public static function get_first_gateway(){
        $gateways=[];
        $active_gateways=ShopRepository::getOption("active_gateways");
        foreach ($active_gateways as $active_gateway_key=>$active_gateway){
            if(isset($active_gateway["active"]) && $active_gateway["active"]==true && $active_gateway_key!="home"){
                $gateways[$active_gateway_key]=$active_gateway;
            }
        }


        $gateway_name=array_key_first($gateways);
        return $gateway_name;
    }

    public static function customers(){
        return User::query()->has("orders")->with(["orders"=>function($query){
            $query->whereIn("status",Order::$succeed_statuses)
                ->orderByDesc("created_at");
        }])->paginate(15);
    }
}

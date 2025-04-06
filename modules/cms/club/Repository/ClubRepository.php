<?php

namespace CMS\Club\Repository;



use CMS\Club\Services\ClubService;
use CMS\Setting\Repository\SettingRepository;
use CMS\User\Repositories\UserRepository;

class ClubRepository
{
    public static function store_setting($values){
        $setting=[];
        $setting["product_point_price"]=$values->product_point_price;
        $setting["product_point"]=$values->product_point;
        $setting["service_point_price"]=$values->service_point_price;
        $setting["service_point"]=$values->service_point;
        $setting["min_need_point"]=$values->min_need_point;
        $setting["club_offer_price"]=$values->club_offer_price;
        $setting["club_offer_point"]=$values->club_offer_point;
        SettingRepository::create_setting($setting);
    }

    public static function decrease($point,$user=null){
        if(!$user) $user=auth()->user();
        $club=UserRepository::get_meta("club_point",$user);
        $point=$club - $point;

        if($point<0) $point=0;
        UserRepository::add_meta([["name"=>"club_point","value"=>$point]],$user);

        return true;
    }



}

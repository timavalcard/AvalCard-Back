<?php
namespace CMS\Marketing\Repository;


use CMS\Brand\Models\Brand;
use CMS\Marketing\Models\Entrance;
use CMS\Setting\Repository\SettingRepository;
use CMS\User\Repositories\UserRepository;
use CMS\Payment\Models\Settlement;

class AffiliateRepository
{
    public static function store_link($link){
        $links=UserRepository::get_meta("affiliate_links");
        if(!is_array($links)) $links=[];
        $link=$link."?affiliate_id=".auth()->id();
        if(!in_array($link,$links)){
            $links[]=$link;

            UserRepository::add_meta([["name"=>"affiliate_links","value"=>$links]]);
        }

    }
    public static function get_affiliate_all_entrance($affiliate_id=null){
        if(!$affiliate_id){
            $affiliate_id=auth()->id();
        }

        return Entrance::query()->where("affiliate_id",$affiliate_id)->get();

    }
    public static function get_affiliate_entrance_by_status($status){
        $affiliate_id=auth()->id();
        return Entrance::query()->where("affiliate_id",$affiliate_id)->where("status",$status)->get();

    }




    public static function add_entrance($data){
        return Entrance::create([
            "affiliate_id"=>$data["affiliate_id"],
             "link"=>$data["link"],
             "user_ip"=>$data["ip"],
        ]);
    }

    public static function find_entrance($id){
        return Entrance::query()->find($id);
    }
    public static function update_entrance_status($entrance,$status="success"){
        $entrance->update([
            "status"=>$status
        ]);
    }

    public static function get_by_ip($ip){
       return Entrance::query()->where("user_ip",$ip)->first();
    }

    public static function store_setting($values){
        $setting=[];
        $setting["affiliate_min_inventory"]=$values->affiliate_min_inventory;

        SettingRepository::create_setting($setting);
    }

    public static function store_settlement($request,$bank_information){

            return Settlement::query()->create([
                'user_id' => auth()->id(),
                'to' => [
                    'cart' => $bank_information["bank_cart_number"],
                    'name' => $bank_information["bank_owner_name"],
                    'shaba' =>$bank_information["bank_shaba_number"]
                ],
                'amount' => $request->amount,
                'status' => Settlement::STATUS_PENDING,
            ]);

    }

}

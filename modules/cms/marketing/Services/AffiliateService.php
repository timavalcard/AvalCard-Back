<?php


namespace CMS\Marketing\Services;


use Illuminate\Support\Facades\Cookie;
use CMS\Marketing\Models\Entrance;
use CMS\Marketing\Repository\AffiliateRepository;
use CMS\Setting\Repository\SettingRepository;
use CMS\User\Repositories\UserRepository;
use CMS\Settlement\Repositories\SettlementRepo;

class AffiliateService
{
    public static function check_affiliate_link(){
        if(Cookie::get("affiliate_id")){
            return true;
        }
        return false;
    }
    public static function get_by_ip($ip){
        $key="osa8hak419s089tvhqf7";
        $data["key"]=$key;
        $data["ip"]=$ip;
        $endpoint = "https://affiliate.hidilady.com/affiliate/get_by_ip/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $output = curl_exec($ch);
        curl_close($ch);

        if($output == 1){
            return true;
        } else{
            return false;
        }
    }

    public static function store_entrance($data){

        if (!self::check_affiliate_link()){
            $entrance=self::add_entrance($data);
            Cookie::queue("affiliate_id",$data["affiliate_id"]);
            Cookie::queue("affiliate_entrance_id",$entrance);
        }

    }
    public static function add_entrance($data){

        $key="osa8hak419s089tvhqf7";
        $data["key"]=$key;
        $endpoint = "https://affiliate.hidilady.com/affiliate/add_entrance/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;

    }

    public static function get_affiliate_bank_information(){
        $bank_name=UserRepository::get_meta("bank_name");
        $bank_cart_number=UserRepository::get_meta("bank_cart_number");
        $bank_account_number=UserRepository::get_meta("bank_account_number");
        $bank_shaba_number=UserRepository::get_meta("bank_shaba_number");
        $bank_owner_name=UserRepository::get_meta("bank_owner_name");

        return [
            "bank_name"=>$bank_name,
            "bank_cart_number"=>$bank_cart_number,
            "bank_account_number"=>$bank_account_number,
            "bank_shaba_number"=>$bank_shaba_number,
            "bank_owner_name"=>$bank_owner_name,
        ];
    }


    public static function get_setting(){
        $setting=[];
        $setting["affiliate_min_inventory"]=SettingRepository::getOption("affiliate_min_inventory");

        return $setting;
    }

    public static function store_settlement($request)
    {
        $bank_information=self::get_affiliate_bank_information();
        AffiliateRepository::store_settlement($request,$bank_information);
        auth()->user()->amount = 0;
        auth()->user()->save();
    }


    public static function calculate_affiliate_percent($products){
        if(!Cookie::get("affiliate_id")){
            return false;
        }
        $affiliate_price=0;
        foreach ($products as $product) {
            $product_affiliate_percent=$product->affiliate_percent;
            if($product_affiliate_percent>0){
                $product_price=$product->offer_price;
                if(!$product_price){
                    $product_price=$product->regular_price;
                }

                $affiliate_price+=(int) ceil($product_affiliate_percent / 100 * $product_price);
            }
        }

        return $affiliate_price;


    }

    public static function calculate_service_affiliate_percent($service,$amount){
        if(!Cookie::get("affiliate_id")){
            return false;
        }
        $affiliate_price=0;

            $service_affiliate_percent=$service->affiliate_percent;
            if($service_affiliate_percent>0){
                $service_price=$amount;
                $affiliate_price+=(int) ceil($service_affiliate_percent / 100 * $service_price);
            }


        return $affiliate_price;


    }

    public static function affiliate_update_amount($amount){

        if(!Cookie::get("affiliate_id")){
            return false;
        }
        $affiliate_id=Cookie::get("affiliate_id");
        $affiliate_entrance_id=Cookie::get("affiliate_entrance_id");
        $affiliate_entrance=self::find_entrance($affiliate_entrance_id);
        $affiliate_entrance=json_decode($affiliate_entrance);
        if(is_object($affiliate_entrance)){
            if($affiliate_entrance->affiliate_id !=auth()->id() ){

                self::update_entrance_status($affiliate_entrance->id,$amount);
            }
        }
        Cookie::queue("affiliate_id",null);
        Cookie::queue("affiliate_entrance_id",null);


    }
    public static function find_entrance($id){
        $key="osa8hak419s089tvhqf7";
        $data["key"]=$key;
        $data["id"]=$id;
        $endpoint = "https://affiliate.hidilady.com/affiliate/find_entrance/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    public static function update_entrance_status($entrance,$amount,$status="success"){
        $key="osa8hak419s089tvhqf7";
        $data["key"]=$key;
        $data["status"]=$status;
        $data["amount"]=$amount;
        $data["id"]=$entrance;
        $endpoint = "https://affiliate.hidilady.com/affiliate/update_entrance_status/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }


}

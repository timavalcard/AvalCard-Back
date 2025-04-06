<?php


namespace CMS\Wallet\Services;


use CMS\Wallet\Repository\WalletRepository;

class WalletService
{
    public static function user_has_amount_in_wallet($user=null,$format=true){
        if(!$user) $user=auth()->user();
        $wallet=WalletRepository::user_wallet($user);
        if(is_object($wallet) && $wallet->price >0) {
            if($format)  return format_price_with_currencySymbol($wallet->price);

            return $wallet->price;

        }
        return false;
    }


    public static function decrease_wallet_from_amount($amount){
       if(session()->get("wallet")){
           $wallet_price=(integer) session()->get("wallet");
           $total_price=$amount - $wallet_price;
           if($total_price<0) return 0;
           return $total_price;
       }
       return  $amount;
    }


    public static function decreasing_wallet_amount($amount,$format=true){
        if(session()->get("wallet")){
            $wallet_price=(integer) session()->get("wallet");
            $wallet=WalletService::user_has_amount_in_wallet(auth()->user(),false);

            if($wallet_price > $wallet){
                if($wallet==0){
                    session()->forget("wallet");
                    return  false;
                } else{
                    session()->put("wallet",$wallet);
                    return $wallet;
                }


            }
            $total_price=$amount - $wallet_price;

            if($total_price<=0) {
                $total_price=$amount;
            } else{
                $total_price=$wallet_price;
            }
            if($format)  return format_price_with_currencySymbol($total_price);
            return $total_price;
        }
        return  false;
    }

    public static function clear_using_wallet($decrease_wallet_amount){
        if(session()->get("wallet")){
            $wallet_price=(integer) $decrease_wallet_amount;

            WalletRepository::decrease($wallet_price);
            session()->forget("wallet");
        }
        return  false;
    }

    public static function cancel_using_wallet(){
        if(session()->get("wallet")){
            session()->forget("wallet");
            return true;
        }
        return false;
    }


}

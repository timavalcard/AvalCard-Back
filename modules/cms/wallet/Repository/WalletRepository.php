<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/27/2020
 * Time: 8:31 PM
 */

namespace CMS\Wallet\Repository;


use CMS\User\Models\User;
use CMS\Wallet\Models\Wallet;

class WalletRepository
{
    public static function user_wallet($user=null){
        if(!$user) $user=auth()->user();
        if($user){
            return $user->wallet;

        }
    }

    public static function increase($price,$user=null){
        if(!$user) $user=auth()->user();
        if($user){
            $wallet=self::user_wallet($user);
            if(!$wallet) $wallet=self::create_wallet(0,$user);
            $wallet->increment("price",$price);
            return true;
        }
        return false;
    }


    public static function decrease($price,$user=null){
        if(!$user) $user=auth()->user();
        $wallet=self::user_wallet($user);
        $wallet->decrement("price",$price);
        return true;
    }

    public static function update_price($price,$wallet){
        $wallet->update([
          "price"=>$price
       ]);
    }

    public static function create_wallet($price=0,$user=null){
        if(!$user) $user=auth()->user();
        $wallet=self::user_wallet($user);
        if(!$wallet) {
            return $user->wallet()->create([
                "status"=>Wallet::$PENDING,
                "price"=>$price
            ]);

        }
        return $wallet;

    }


    public static function get_users_has_wallet(){
        return User::query()->has("wallet")->paginate(15);
    }

    public static function find($id){
        return Wallet::findOrFail($id);
    }

    public static function find_with_user($id){
        return Wallet::query()->where("id",$id)->with("user")->firstOrFail();
    }

    public static function remove($wallet){
        $wallet->delete();
    }
}

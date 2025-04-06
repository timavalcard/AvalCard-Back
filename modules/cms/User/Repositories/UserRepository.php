<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/27/2020
 * Time: 8:31 PM
 */

namespace CMS\User\Repositories;


use Illuminate\Support\Facades\DB;
use CMS\RolePermissions\Models\Permission;
use CMS\User\Models\User;
use CMS\User\Models\User_meta;

class UserRepository
{
    public static function get_user_with_paginate($paginateNumber=10,$name=null)
    {
        return User::query()->where("email_verified_at","!=",null)->orWhere("mobile_verified_at","!=",null)->where("name","LIKE","%".$name."%")->orWhere("mobile","LIKE","%".$name."%")->orWhere("email","LIKE","%".$name."%")->orderByDesc("created_at")->paginate($paginateNumber);
    }
    public static function get(){
        return User::get();
    }
    public static function getTeachers()
    {
        return User::permission(Permission::PERMISSION_TEACH)->get();
    }
    public static function get_user_with_role_paginate($role,$paginateNumber=10)
    {
        return User::query()->role($role)->paginate($paginateNumber);
    }
    public static function get_user_by_email_or_mobile($email_or_mobile){
        return User::query()
            ->VerifiedMobile($email_or_mobile)
            ->first();
    }


    public static function create($data,$verified=false)
    {
        $data=[
            "name" => $data->name,
            "email" => $data->email,
            "password" => bcrypt($data->password),
            "status"   =>$data->status,
            "role"=>$data["role"]
        ];
        if($verified){
            $data["mobile_verified_at"]=now();
            $data["email_verified_at"]=now();
        }
        $user=User::create($data);
        $user->syncRoles($data["role"]);
        return $user;
    }

    public static function update($user,$data)
    {
        $user->syncRoles($data["role"])->update([
            "name" => $data->name,
            "email" => $data->email,
            "password" => $data->password,
            "status"   =>$data->status
        ]);
    }

    public static function find($id)
    {
        return User::findOrFail($id);
    }

    public static function destroy($id)
    {
        return User::destroy($id);
    }


    public static function add_meta($data,$user=null){
        if(!$user){
            $user=auth()->user();
        }
        foreach ($data as $meta_item) {
            if(!empty($meta_item["value"])) {
                $user->user_meta()->updateOrCreate(["meta_key"=>$meta_item["name"]],["meta_value"=>$meta_item["value"]]);
            }
        }
    }

    public static function get_billing_meta($user=null){
        if(!$user){
            $user=auth()->user();
        }
        return $user->user_meta()->where("meta_key","LIKE","%billing_%")->pluck("meta_value","meta_key");
    }

    public static function get_all_meta($user=null){
        if(!$user){
            $user=auth()->user();
        }

        return $user->user_meta()->pluck("meta_value","meta_key");
    }

    public static function get_meta($key,$user=null){
        if(!$user){
            $user=auth()->user();
        }
        return $user->user_meta()->where("meta_key",$key)->pluck("meta_value")->first();
    }

    public static function edit_account($user,$data){
        $user_data=[
            "mobile" => $data["mobile"],
            "email" => $data["email"],
            "name" => $data["name"],
        ];

        if(!empty($data["password"])){
            $user_data["password"]=$data["password"];
        }

        $user->update($user_data);
    }
    public static function user_use_coupon_before($user,$coupon){
        $use_coupon_before=$user->coupon->where("id",$coupon->id);
        if($use_coupon_before->isNotEmpty()){
            return false;

        }
        return true;
    }


    public static function add_user_coupon($user,$coupon){
        $user->coupon()->attach($coupon);
    }
    public static function get_users_has_meta($meta){
        return User_meta::query()->where("meta_key",$meta)->with("user")->get();
    }
    public static function get_user_by_meta_id($metaId){
        return User_meta::query()->where("id",$metaId)->with("user")->firstOrFail();
    }
    public static function get_users_by_role($role){
        return User::role($role)->get();
    }

    public static function find_by_mobile($email){
        return User::query()->where("mobile",$email)->first();
    }
}

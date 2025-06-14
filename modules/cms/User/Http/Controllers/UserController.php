<?php

namespace CMS\User\Http\Controllers;

use App\Http\Controllers\Controller;
use CMS\Sms\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use CMS\Media\Http\Requests\UserAddMediaRequest;
use CMS\Media\Services\MediaFileService;
use CMS\Order\Models\Order;
use CMS\Order\Repository\OrderRepository;
use CMS\Product\Repository\ProductRepository;
use CMS\Product\Repository\ProductVariationRepository;
use CMS\Product\Service\ProductService;
use CMS\Product\Service\ProductVariation;
use CMS\RolePermissions\Models\Role;
use CMS\RolePermissions\Repositories\RoleRepo;
use CMS\Shop\Service\ShopService;
use CMS\User\Http\Requests\AddUserRequest;
use CMS\User\Http\Requests\EditAccountRequest;
use CMS\User\Http\Requests\EditUserRequest;
use CMS\User\Models\User;
use CMS\User\Repositories\UserRepository;

class UserController extends Controller
{
    //theme functions

    public function edit_avatar(UserAddMediaRequest $request){
        $image=MediaFileService::publicUpload($request->user_image);
        UserRepository::add_meta([["name"=>"profile_avatar","value"=>$image->id]]);
        toastMessage("image profile شما با موفقیت upload شد");
        return back();
    }

    public function courses(){
        $courses=auth()->user()->courses;

        return view(config("theme.theme_path")."account.courses",["courses"=>$courses]);

    }
    public function wishlist(){
        $wishlists=auth()->user()->wishlist;

        return view(config("theme.theme_path")."account.wishlist",["wishlists"=>$wishlists]);

    }
    public function account(){
        $user=auth()->user();
        $orders=OrderRepository::user_all_orders();
        $user_data=UserRepository::get_all_meta($user);
        $wishlists=auth()->user()->wishlist;
        $comments=$user->comments;
        return view(config("theme.theme_path")."account.index",["user"=>$user,"orders"=>$orders,"wishlists"=>$wishlists,"comments"=>$comments,"user_data"=>$user_data]);
    }
    public function comments(){
        $user=auth()->user();
        $comments=$user->comments;
        return view(config("theme.theme_path")."account.comments",["comments"=>$comments]);

    }
    public function address(){
        $user=auth()->user();
        $address=get_user_meta($user->id,"address");
        if($address){
            $address=$address->meta_value;
        }
        $billing=UserRepository::get_billing_meta();
        return view(config("theme.theme_path")."account.address",["address"=>$address,"billing"=>$billing]);

    }
    public function delete_address($index){
        $user=auth()->user();
        $address=get_user_meta($user->id,"address");
        if($address){
            $address=$address->meta_value;
            unset($address[$index]);
            update_user_meta($user->id,"address",$address);
        }
        return back();
    }


    public function add_address(Request $request){
        $user=auth()->user();
        $address=get_user_meta($user->id,"address");
        if(!$address){
            $data=[];
            foreach ($request->all() as $key=>$item) {

                if(str_contains($key,"billing_")){
                    $data[$key]=$item;
                }
            }
            $address[0]=$data;
            update_user_meta($user->id,"address",$address);
        } else{

            $address=$address->meta_value;

            $data=[];
            foreach ($request->all() as $key=>$item) {

                if(str_contains($key,"billing_")){
                    $data[$key]=$item;
                }
            }
            $address[]=$data;

            update_user_meta($user->id,"address",$address);
        }
        return back();
    }

    public function edit_account_form(){
        $user=auth()->user();
        $user_data=UserRepository::get_all_meta($user);

        return view(config("theme.theme_path")."account.edit",["user"=>$user,"user_data"=>$user_data]);

    }

    public function edit_account(EditAccountRequest $request){
        $user=auth()->user();
        $data=$request->all();
        if (!empty($request->new_password)) {
            $data["password"]=bcrypt($request->new_password);
        }
        UserRepository::edit_account($user,$data);


        UserRepository::add_meta([
            ["name"=>"bio","value"=>$request->bio],
            ["name"=>"lastname","value"=>$request->lastname],
            ["name"=>"national_code","value"=>$request->national_code],
            ["name"=>"cart_number","value"=>$request->cart_number],
            ["name"=>"shaba_number","value"=>$request->shaba_number],

        ]);



        return back();
    }

    public function orders(){
        $orders=OrderRepository::user_all_orders();
        return view(config("theme.theme_path")."account.orders",["orders"=>$orders]);
    }
    public function transactions(){
        $transactions=auth()->user()->transactions;
        return view(config("theme.theme_path")."account.transactions",["transactions"=>$transactions]);

    }

    public function order($id){
        $order=OrderRepository::user_find_order($id);
        $products=ProductService::get_cart_products($order->products_id);
        $user_billing=UserRepository::get_billing_meta();
        $delivery_statuses=Order::$delivery_statuses;
        $pay_statuses=Order::$pay_statuses;
        if(in_array($order->status,$pay_statuses)){
            $products=ProductService::get_cart_products($order->products_id);
            $amount=ShopService::get_order_total_price(true,$products);

            //$order->price=$amount;
            // $order->save();
        }

        return view(config("theme.theme_path")."account.order",["order"=>$order,"products"=>$products,"user_billing"=>$user_billing,"pay_statuses"=>$pay_statuses,"delivery_statuses"=>$delivery_statuses]);

    }
    public function vip(){
        return view(config("theme.theme_path")."account.vip");

    }


    //admin functions

    public function list_authorize(){
        $users = UserRepository::get_users_meta_equal_to("authorize_status","pending");
        $users_count=$users->count();
        return view("User::Admin.authorize", ["users" => $users,"users_count"=>$users_count]);

    }
    public function list_authorized(){
        $users = UserRepository::get_users_meta_equal_to("authorize_status","accept");
        $users_count=$users->count();
        return view("User::Admin.authorized", ["users" => $users,"users_count"=>$users_count]);

    }
    public function check_authorized($id)
    {
        $user = UserRepository::find($id);
        return view("User::Admin.authorized_check", ["user" => $user]);
    }
    public function list_not_authorized(){
        $users = UserRepository::get_users_meta_equal_to("authorize_status","decline");
        $users_count=$users->count();
        return view("User::Admin.not_authorized", ["users" => $users,"users_count"=>$users_count]);

    }
    public function check_not_authorized($id)
    {
        $user = UserRepository::find($id);
        return view("User::Admin.not_authorized_check", ["user" => $user]);
    }

    public function check_authorize($id)
    {
        $user = UserRepository::find($id);
        return view("User::Admin.authorize_check", ["user" => $user]);
    }
    public function decline_authorize($id,Request $request)
    {
        $user = UserRepository::find($id);
        UserRepository::add_meta([["name" => "authorize_decline_reason", "value" => $request->reason]], $user);
        UserRepository::add_meta([["name" => "authorize_status", "value" => "decline"]], $user);
        if($user){
            $result = SmsService::ultra('authorizeFalse', [$user->name. " ".$user->last_name], $user->mobile);
        }
        return redirect()->route("admin_list_authorize")->with(["success"=>"با موفقیت رد شد"]);
    }
    public function accept_authorize($id,Request $request)
    {
        $user = UserRepository::find($id);
        UserRepository::add_meta([["name" => "authorize_status", "value" => "accept"]], $user);
        if($user){
            $result = SmsService::ultra('authorizeTrue', [$user->name. " ".$user->last_name], $user->mobile);
        }
        return redirect()->route("admin_list_authorize")->with(["success"=>"با موفقیت پذیرفته شد"]);
    }

    public function list_user(Request $request)
    {
        $users = UserRepository::get_user_with_paginate(20,$request->name);
        $users_count=UserRepository::get()->count();
        return view("User::Admin.user_list", ["users" => $users,"users_count"=>$users_count]);
    }
    public function group_action(Request $request){
        if($request->action == "delete"){
            UserRepository::destroy($request->checkbox_item);
        }
        return back();
    }


    public function add_user_form(RoleRepo $roleRepo)
    {
        $statuses=User::ACCOUNT_STATUSES;
        $roles= $roleRepo->all();
        return view("User::Admin.user_add", ["statuses" => $statuses,"roles"=>$roles]);
    }

    public function add_user(AddUserRequest $request)
    {

        UserRepository::create($request,true);

        return redirect()->route("admin_list_user");
    }

    public function edit_user_form($id,RoleRepo $roleRepo)
    {
        $user = UserRepository::find($id);
        $roles= $roleRepo->all();
        $statuses=User::ACCOUNT_STATUSES;
        $profile_avatar_id=UserRepository::get_meta("profile_avatar",$user);

        return view("User::Admin.user_edit", ["profile_avatar_id"=>$profile_avatar_id,"user" => $user, "roles" => $roles,"statuses"=>$statuses]);
    }

    public function edit_user(EditUserRequest $request)
    {
        $user = UserRepository::find($request->id);
        if (!empty($request->password)) {
            $pass = bcrypt($request->password);
        } else {
            $pass = $user->password;
        }
        $request->password=$pass;
        UserRepository::update($user,$request);
        if (!empty($request->national_code)) {
            UserRepository::add_meta([["name" => "national_code", "value" => $request->national_code]], $user);
        }
        if (!empty($request->thumbnail)) {
            UserRepository::add_meta([["name" => "profile_avatar", "value" => $request->thumbnail]], $user);
        }

        return back();
    }

    public function delete_user($id)
    {
        UserRepository::destroy($id);
        return back();
    }

    public function update_profile_info(){
        return view('User::Admin.update_profile_info');
    }

    public function update_profile(update_admins_profile_request $request){
//        $this->authorize('panel_index',User::class);
        $update = $this->userRepo->updateProfileAdmins($request);
        if ($update){
            return redirect()->back()->with('status','updated');
        }else{
            return redirect()->back()->with('status','updated');
        }
    }

    public function update_password(update_password_admins_request $request){
//        $this->authorize('panel_index',User::class);
        $update = $this->userRepo->updateUserPassword($request);
        if ($update){
            return redirect()->back()->with('status','updated');
        }else{
            return redirect()->back()->with('status','error');
        }
    }
}

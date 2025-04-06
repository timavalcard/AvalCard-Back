<?php

namespace CMS\Club\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use CMS\Club\Http\Requests\ClubSettingRequest;
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
use CMS\Setting\Repository\SettingRepository;
use CMS\Shop\Repository\ShopRepository;
use CMS\Shop\Service\ShopService;
use CMS\Transaction\Repository\TransactionRepository;
use CMS\User\Http\Requests\AddUserRequest;
use CMS\User\Http\Requests\EditAccountRequest;
use CMS\User\Http\Requests\EditUserRequest;
use CMS\OrderService\Repositories\OrderServiceRepo;
use CMS\User\Models\User;
use CMS\User\Repositories\UserRepository;
use CMS\Club\Http\Requests\IncreaseClubRequest;
use CMS\Club\Http\Requests\UpdateClubRequest;
use CMS\Club\Repository\ClubRepository;
use CMS\Club\Services\ClubService;

class ClubController extends Controller
{

    //theme functions
    public function use_club(){
        $club=ClubService::user_can_use_club(null,false);
        if($club["user_club_point"] < $club["setting"]["min_need_point"]){
            toastMessage("شما نمیتوانید از امتیازتان استفاده کنید","","info");
            return back();
        }

        session()->put("club",$club);
        toastMessage("عملیات موفقیت امیز بود");
        return back();
    }

    public function service_use(Request $request,OrderServiceRepo $orderServiceRepo){
        $club=ClubService::user_can_use_club(null,false);
        if($club["user_club_point"] < $club["setting"]["min_need_point"]){
            return  ["message"=>"شما نمیتوانید از امتیازتان استفاده کنید","type"=>"info","heading"=>""];
        }

        $order=$orderServiceRepo->findByID($request->order_id);
        $amount=$order->price;
        $total_price=$amount - $club["price"];
        if($total_price<=0) {
            $total_price=0;
        } else{
            $total_price=$total_price;
        }

        $orderServiceRepo->update_price($order,$total_price);
        session()->put("club",$club);
        $club_decreased=(integer) ClubService::decreasing_club_amount($amount,false);

        if($club_decreased){
            ClubService::clear_using_club($club_decreased);
        }

        return  ["message"=>"عملیات موفقیت امیز بود","type"=>"success","heading"=>""];

    }
    public function cancel_use(){
        if(ClubService::cancel_using_club()){
            toastMessage();
            return back();
        }
        else{
            toastMessage("شما از امتیاز باشگاه مشتریتان استفاده نمی کنید!","","info");
            return back();
        }
    }


    //admin functions
    public function admin_index(){
        $club_metas=UserRepository::get_users_has_meta("club_point");

        return view("Club::Admin.list",compact("club_metas"));
    }


    public function remove($id){
        $club=UserRepository::get_user_by_meta_id($id);
        UserRepository::delete_meta($club);
        return redirect()->route("admin_club_index");
    }

    public function edit_form($id){
        $club=UserRepository::get_user_by_meta_id($id);
        return view("Club::Admin.edit",compact("club"));
    }

    public function edit(Request $request,$id){
        $club=UserRepository::get_user_by_meta_id($id);

        UserRepository::add_meta([["name"=>"club_point","value"=>$request->club_point]],$club->user->id);
        return back();
    }

    public function settings(){

        $setting=ClubService::get_setting();
        return view("Club::Admin.setting",compact("setting"));
    }
    public function settings_save(ClubSettingRequest $request){
        ClubRepository::store_setting($request);
        return back();
    }



}

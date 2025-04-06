<?php

namespace CMS\Marketing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Marketing\Http\Requests\AffiliateAddLinkRequest;
use CMS\Marketing\Http\Requests\AffiliateAddSettlementRequest;
use CMS\Marketing\Http\Requests\AffiliateEditBankRequest;
use CMS\Marketing\Http\Requests\AffiliateSettingRequest;
use CMS\Marketing\Repository\AffiliateRepository;
use CMS\Marketing\Services\AffiliateService;
use CMS\RolePermissions\Models\Permission;
use CMS\RolePermissions\Models\Role;
use CMS\User\Repositories\UserRepository;
use CMS\Settlement\Repositories\SettlementRepo;
use CMS\Settlement\Services\SettlementService;


class AffiliateController extends Controller
{
    private $settlementRepo;

    public function __construct(SettlementRepo $settlementRepo)
    {
        $this->settlementRepo = $settlementRepo;
    }

    //theme functions
    public function submit(){
        if(!auth()->user()->hasRole(Role::ROLE_AFFILIATE)){
            auth()->user()->syncRoles(Role::ROLE_AFFILIATE);
        }
        return redirect()->route("affiliate.index");
    }

    public function index(){
        if(auth()->user()->hasRole(Role::ROLE_AFFILIATE)){
            $entrances=AffiliateRepository::get_affiliate_all_entrance();
            $success_entrances=AffiliateRepository::get_affiliate_entrance_by_status("success");
            $failed_entrances=AffiliateRepository::get_affiliate_entrance_by_status("failed");

            return  view("Theme::hidi.affiliate.index",compact("entrances","failed_entrances","success_entrances"));
        }
        toastMessage("شما به عنوان بازاریاب ثبت نام نکرده اید","","info");
        return redirect()->route("user.account");
    }




    public function links(){
        if(auth()->user()->hasRole(Role::ROLE_AFFILIATE)){
        $links=UserRepository::get_meta("affiliate_links");
        return view("Theme::hidi.affiliate.links",compact("links"));
        }
        toastMessage("شما به عنوان بازاریاب ثبت نام نکرده اید","","info");
        return redirect()->route("user.account");
    }

    public function store_link(AffiliateAddLinkRequest $request){
        AffiliateRepository::store_link($request->link);
        return back();
    }

    public function bank(){
        if(auth()->user()->hasRole(Role::ROLE_AFFILIATE)){
        $bank_information=AffiliateService::get_affiliate_bank_information();
        return view("Theme::hidi.affiliate.bank",compact("bank_information"));
        }
        toastMessage("شما به عنوان بازاریاب ثبت نام نکرده اید","","info");
        return redirect()->route("user.account");

    }


    public function bank_store(AffiliateEditBankRequest $request){
        UserRepository::add_meta([
            [
                "name"=>"bank_owner_name",
                "value"=>$request->bank_owner_name
            ],
            [
                "name"=>"bank_name",
                "value"=>$request->bank_name
            ],
            [
                "name"=>"bank_account_number",
                "value"=>$request->bank_account_number
            ],
            [
                "name"=>"bank_cart_number",
                "value"=>$request->bank_cart_number
            ],
            [
                "name"=>"bank_shaba_number",
                "value"=>$request->bank_shaba_number
            ],
        ]);
        return back();
    }

    public function settled_form(){
        if(auth()->user()->hasRole(Role::ROLE_AFFILIATE)){
            return view("Theme::hidi.affiliate.settled");
        }
        toastMessage("شما به عنوان بازاریاب ثبت نام نکرده اید","","info");
        return redirect()->route("user.account");
    }
    public function settled(AffiliateAddSettlementRequest $request){
        if(auth()->user()->hasRole(Role::ROLE_AFFILIATE)){
            $bank_information=AffiliateService::get_affiliate_bank_information();
            if(!$bank_information["bank_owner_name"]){
                toastMessage("ابتدا اطلاعات حساب بانکی خود را کامل کنید","","info");
                return redirect()->route("affiliate.bank");
            }

            if ($this->settlementRepo->getLatestPendingSettlement()) {
                toastMessage("شما از قبل یک درخواست تسویه دارید لطفا تا زمان واریز صبر کنید","","info");
                return redirect()->route("affiliate.index");
            }
            AffiliateService::store_settlement($request);
            toastMessage("درخواست تسویه شما با موفقیت ایجاد شد. تسویه ممکن است تا سه روز کاری زمان ببرد");
            return redirect()->route("affiliate.index");
        }
        toastMessage("شما به عنوان بازاریاب ثبت نام نکرده اید","","info");
        return redirect()->route("user.account");
    }

    public function settlements(){
        if(auth()->user()->hasRole(Role::ROLE_AFFILIATE)){
            return view("Theme::hidi.affiliate.transactions");
        }
        toastMessage("شما به عنوان بازاریاب ثبت نام نکرده اید","","info");
        return redirect()->route("user.account");
    }



        //admin functions
    public function admin_index(){
        $users=UserRepository::get_users_by_role(Role::ROLE_AFFILIATE);
        return view("Marketing::Admin.index",compact("users"));
    }
    public function admin_index_wait(){
        $users=UserRepository::get_users_by_role(Role::ROLE_AFFILIATE_NEED_AUTHORIZE);
        return view("Marketing::Admin.index_wait",compact("users"));
    }
    public function admin_index_wait_accept($id){
        $user=UserRepository::find($id);

        if(!$user->hasRole(Role::ROLE_AFFILIATE)){
            $user->syncRoles(Role::ROLE_AFFILIATE);
        }
        return back();
    }
    public function setting(){

        $setting=AffiliateService::get_setting();
        return view("Marketing::Admin.setting",compact("setting"));
    }
    public function setting_store(AffiliateSettingRequest $request){
        AffiliateRepository::store_setting($request);
        return back();
    }




}

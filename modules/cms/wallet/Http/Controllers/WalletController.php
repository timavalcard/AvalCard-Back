<?php

namespace CMS\Wallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use CMS\Product\Service\ProductVariation;
use CMS\Shop\Repository\ShopRepository;
use CMS\Shop\Service\ShopService;
use CMS\Transaction\Repository\TransactionRepository;
use CMS\User\Http\Requests\AddUserRequest;
use CMS\User\Http\Requests\EditAccountRequest;
use CMS\User\Http\Requests\EditUserRequest;
use CMS\Wallet\excel\ViewExcel;
use CMS\Wallet\Http\Requests\IncreaseWalletRequest;
use CMS\Wallet\Http\Requests\UpdateWalletRequest;
use CMS\Wallet\Repository\WalletRepository;
use CMS\Wallet\Services\WalletService;

class WalletController extends Controller
{
    //theme functions
    public function index(){
        $wallet=WalletRepository::user_wallet();
        $transactions=auth()->user()->transactions;
        return view("Theme::hidi.account.wallet",["wallet"=>$wallet,"transactions"=>$transactions]);
    }


    public function increase(IncreaseWalletRequest $request){
        $wallet=WalletRepository::create_wallet();
        $amount=(integer) $request->price;
        $gateway_name=ShopRepository::get_first_gateway();

        return ShopService::send_to_gateway($gateway_name,$amount,$wallet);
    }

    public function use(){
        $wallet=WalletService::user_has_amount_in_wallet(null,false);
        if(!$wallet){
            toastMessage("شما هیچ مبلغی در کیف پولتان ندارید","","info");
            return back();
        }

        session()->put("wallet",$wallet);
        toastMessage("عملیات موفقیت امیز بود");
        return back();
    }

    public function cancel_use(){
        if(WalletService::cancel_using_wallet()){
            toastMessage();
            return back();
        }
        else{
            toastMessage("شما از کیف پولتان استفاده نمی کنید!","","info");
            return back();
        }
    }


    //admin functions
    public function admin_index(){
        $users=WalletRepository::get_users_has_wallet();
        return view("Wallet::Admin.list",compact("users"));
    }


    public function remove($id){
        $wallet=WalletRepository::find($id);
        WalletRepository::remove($wallet);
        return redirect()->route("admin_wallet_index");
    }

    public function edit_form($id){
        $wallet=WalletRepository::find_with_user($id);
        return view("Wallet::Admin.edit",compact("wallet"));
    }

    public function edit(UpdateWalletRequest $request,$id){
        $wallet=WalletRepository::find($id);

        WalletRepository::update_price($request->price,$wallet);
        return back();
    }

    public function transactions(){
        $transactions=TransactionRepository::get_transactions_by_type("wallet");
        return view("Wallet::Admin.transactions",compact("transactions"));
    }
    public function excel(Request $request){
        return Excel::download(new ViewExcel(), 'wallet.xlsx');

    }

}

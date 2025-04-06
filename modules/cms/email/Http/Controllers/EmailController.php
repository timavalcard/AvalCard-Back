<?php

namespace CMS\Email\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use CMS\Email\Http\Requests\EmailSettingRequest;
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
use CMS\Shop\Repository\ShopRepository;
use CMS\Shop\Service\ShopService;
use CMS\Transaction\Repository\TransactionRepository;
use CMS\User\Http\Requests\AddUserRequest;
use CMS\User\Http\Requests\EditAccountRequest;
use CMS\User\Http\Requests\EditUserRequest;
use CMS\User\Models\User;
use CMS\User\Repositories\UserRepository;
use CMS\Wallet\Http\Requests\IncreaseWalletRequest;
use CMS\Wallet\Http\Requests\UpdateWalletRequest;
use CMS\Wallet\Repository\WalletRepository;
use CMS\Wallet\Services\WalletService;

class EmailController extends Controller
{
    //admin functions
    public function index(){


        $data=["server_name"=>ShopRepository::getOption("server_name"),
            "server_port"=>ShopRepository::getOption("server_port"),
            "email_username"=>ShopRepository::getOption("email_username"),
            "email_password"=>ShopRepository::getOption("email_password"),
            "sender_email"=>ShopRepository::getOption("sender_email"),
            "sender_name"=>ShopRepository::getOption("sender_name"),
            "email_encryption"=>ShopRepository::getOption("email_encryption"),
            ];
        return view("Email::Admin.index",compact("data"));
    }

    public function save(EmailSettingRequest $request){
        ShopRepository::create_setting([
            "server_name"=>$request->server_name,
            "server_port"=>$request->server_port,
            "email_username"=>$request->email_username,
            "email_password"=>$request->email_password,
            "sender_email"=>$request->sender_email,
            "sender_name"=>$request->sender_name,
            "email_encryption"=>$request->email_encryption,
        ]);
        try{
            $transport = new \Swift_SmtpTransport($request->server_name, $request->server_port, $request->email_encryption);
            $transport->setUsername($request->email_username);
            $transport->setPassword($request->email_password);
            $mailer = new \Swift_Mailer($transport);
            $mailer->getTransport()->start();
            session()->flash("success","ارتباط با سرور ارسال ایمیل به درستی بر قرار شد");
        } catch (\Swift_TransportException $e) {
            session()->flash("custom-error",[$e->getMessage()]);
        } catch (\Exception $e) {
            session()->flash("custom-error",[$e->getMessage()]);
        }

        return back();
    }



}

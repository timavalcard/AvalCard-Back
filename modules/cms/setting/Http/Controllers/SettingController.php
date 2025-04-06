<?php

namespace CMS\Setting\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Email\Http\Requests\EmailSettingRequest;
use CMS\Page\Http\Requests\AddPageRequest;
use CMS\Page\Http\Requests\EditPageRequest;
use CMS\Page\Models\Page;
use CMS\Page\Repository\PageRepository;
use CMS\Shop\Repository\ShopRepository;

class SettingController extends Controller
{
    public function index()
    {
        return "setting page";
    }
    public function tel_bot(){
        $data=[
            "tel_admin_token"=>ShopRepository::getOption("tel_admin_token"),
            "tel_form_send"=>ShopRepository::getOption("tel_form_send"),
            "tel_article_add"=>ShopRepository::getOption("tel_article_add"),
            "tel_article_edit"=>ShopRepository::getOption("tel_article_edit"),
            "tel_article_delete"=>ShopRepository::getOption("tel_article_delete"),
            "tel_product_add"=>ShopRepository::getOption("tel_product_add"),
            "tel_product_edit"=>ShopRepository::getOption("tel_product_edit"),
            "tel_product_delete"=>ShopRepository::getOption("tel_product_delete"),
            "tel_comment_add"=>ShopRepository::getOption("tel_comment_add"),
            "tel_order_add"=>ShopRepository::getOption("tel_order_add"),
            "tel_user_add"=>ShopRepository::getOption("tel_user_add"),
           ];

        return view("Setting::Admin.tel_bot",compact("data"));
    }
    public function tel_bot_save(Request $request){
        ShopRepository::create_setting([
            "tel_admin_token"=>$request->token,
            "tel_form_send"=>$request->tel_form_send,
            "tel_article_add"=>$request->tel_article_add,
            "tel_article_edit"=>$request->tel_article_edit,
            "tel_article_delete"=>$request->tel_article_delete,
            "tel_product_add"=>$request->tel_product_add,
            "tel_product_edit"=>$request->tel_product_edit,
            "tel_product_delete"=>$request->tel_product_delete,
            "tel_comment_add"=>$request->tel_comment_add,
            "tel_order_add"=>$request->tel_order_add,
            "tel_user_add"=>$request->tel_user_add,

        ]);


        return back();
    }
}

<?php


namespace CMS\Common\Services;



use CMS\Shop\Repository\ShopRepository;

class CommonService
{
    public static function tel_bot($type,$name,$comment_type="comment"){
        $token=ShopRepository::getOption("tel_admin_token");

        $tel_form_send = ShopRepository::getOption("tel_form_send");
        $tel_article_add = ShopRepository::getOption("tel_article_add");
        $tel_article_edit = ShopRepository::getOption("tel_article_edit");
        $tel_article_delete = ShopRepository::getOption("tel_article_delete");
        $tel_product_add = ShopRepository::getOption("tel_product_add");
        $tel_product_edit = ShopRepository::getOption("tel_product_edit");
        $tel_product_delete = ShopRepository::getOption("tel_product_delete");
        $tel_comment_add = ShopRepository::getOption("tel_comment_add");
        $tel_order_add = ShopRepository::getOption("tel_order_add");
        $tel_user_add = ShopRepository::getOption("tel_user_add");
        $tel_ticket_add = ShopRepository::getOption("tel_ticket_add");
        $tel_authorize_add = ShopRepository::getOption("tel_authorize_add");
        $send=false;
        $msg=get_site_title()."\n";
        switch ($type) {
            case $type == "form" && $tel_form_send == "yes":
                $send=true;
                $msg .= '#ورودی_فرم' . "\n";
                $msg .= $name . "\n";
                $msg .= "یک فرم توسط کاربران پر شد.";
                break;
            case $type == "article_add" && $tel_article_add == "yes":
                $send=true;
                $msg .= '#مقاله_جدید' . "\n";
                $msg .= $name . "\n";
                $msg .= "یک مقاله جدید در سایت شما  ساخته شد.";
                break;
            case $type == "article_edit"  && $tel_article_edit == "yes":
                $send=true;
                $msg .= '#ویرایش_مقاله' . "\n";
                $msg .= $name . "\n";
                $msg .= "یک مقاله در سایت شما ویرایش شد.";
                break;
            case $type == "article_delete"  && $tel_article_delete == "yes":
                $send=true;
                $msg .= '#حذف_مقاله' . "\n";
                $msg .= $name . "\n";
                $msg .= "این مقاله توسط یکی از ادمین ها از سایت پاک شد";
                break;
            case $type == "product_add"  && $tel_product_add == "yes":
                $send=true;
                $msg .= '#محصول_جدید' . "\n";
                $msg .= $name . "\n";
                $msg .= "یک محصول جدید در سایت شما  ساخته شد.";
                break;
            case $type == "product_edit"  && $tel_product_edit == "yes":
                $send=true;
                $msg .= '#ویرایش_محصول' . "\n";
                $msg .= $name . "\n";
                $msg .= "یک محصول در سایت شما ویرایش شد.";
                break;
            case $type == "product_delete"  && $tel_product_delete == "yes":
                $send=true;
                $msg .= '#حذف_محصول' . "\n";
                $msg .= $name . "\n";
                $msg .= "این محصول توسط یکی از ادمین ها از سایت پاک شد";
                break;
            case $type == "order_add"  && $tel_order_add == "yes":
                $send=true;
                $msg .= '#سفارش_جدید' . "\n";
                $msg .= "آیدی سفارش : $name" . "\n";
                $msg .= "یک سفارش جدید ثبت شد";
                break;
            case $type == "user_add"  && $tel_user_add == "yes":
                $send=true;
                $msg .= '#کاربر_جدید' . "\n";
                $msg .= "آیدی کاربر : $name" . "\n";
                $msg .= "یک کاربر جدید ثبت نام کرد";
                break;
            case $type == "comment_add" && $comment_type=="comment"  && $tel_comment_add == "yes":
                $send=true;
                $msg .= '#نظر_جدید' . "\n";
                $msg .= $name . "\n";
                $msg .= "یک کامنت جدید برای این صفحه اضافه شد.";
                break;
            case $type == "comment_add" && $comment_type=="question"  && $tel_comment_add == "yes":
                $send=true;
                $msg .= '#پرسش_پاسخ' . "\n";
                $msg .= $name . "\n";
                $msg .= "یک سوال جدید برای این محصول اضافه شد.";
                break;

            case $type == "ticket" && $tel_ticket_add == "yes":
                $send=true;
                $msg .= '#تیکت_جدید' . "\n";
                $msg .= $name . "\n";
                $msg .= "یک تیکت جدید ارسال شد";
                break;
            case $type == "authorize" && $tel_authorize_add == "yes":
                $send=true;
                $msg .= '#درخواست_احراز_هویت' . "\n";

                $msg .= "یک درخواست احراز هویت جدید ارسال شد";
                break;
        }

        if($send){
            $url = 'http://telebotpost.ir/file.php?msg='.urlencode($msg).'&token='.urlencode($token);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $output = curl_exec($ch);
        }


    }
}

<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/29/2020
 * Time: 1:19 AM
 */

namespace CMS\NewsletterEmail\Repository;

use CMS\NewsletterEmail\Models\Newsletter_mail;

class NewsletterEmailRepository
{
    public static function order_newsletter($order="asc"){
        $order=$order==null ? "asc" : $order;
        switch ($order){
            case "asc":
                $emails = Newsletter_mail::query()->orderBy("created_at")->paginate(10);
                break;
            case "desc":
                $emails = Newsletter_mail::query()->orderByDesc("created_at")->paginate(10);
                break;
            case "email":

                $emails=Newsletter_mail::query()->orderBy("email")->paginate(10);
                break;
        }

        return $emails;
    }

    public static function destroy($id)
    {
        Newsletter_mail::destroy($id);
    }

    public static function create($data)
    {
        return Newsletter_mail::create([
            "email"=>$data["email"],
            "user_id"=>$data["user_id"]
        ]);
    }
}

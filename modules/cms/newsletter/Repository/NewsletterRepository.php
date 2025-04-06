<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/29/2020
 * Time: 1:19 AM
 */

namespace CMS\Newsletter\Repository;



use CMS\Newsletter\Models\Newsletter;
use CMS\NewsletterEmail\Models\Newsletter_mail;

class NewsletterRepository
{
    public static function find($id){
            return Newsletter::findOrFail($id);
    }

    public static function order_newsletter($order="asc")
    {
        $order=$order==null ? "asc" : $order;
        switch ($order){
            case "asc":
                $emails = Newsletter::query()->orderBy("created_at")->paginate(10);
                break;
            case "desc":
                $emails = Newsletter::query()->orderByDesc("created_at")->paginate(10);
                break;

        }

        return $emails;
    }

    public static function get_mail()
    {
        return Newsletter_mail::get();
        }

    public static function create($data)
    {
        Newsletter::create([
            "title"=>$data->title,
            "message"=>$data->contents,
            "sendsTo"=>serialize($data->sendTo)
        ]);
    }

    public static function update(Newsletter $newsletter , $data)
    {
        $newsletter->update([
            "title"=>$data->title,
            "message"=>$data->contents,
            "sendsTo"=>serialize($data->sendTo)
        ]);
    }

    public static function destroy($id)
    {
        Newsletter::destroy($id);
    }

    public static function mail_search($search)
    {
       return  Newsletter_mail::query()->where('email','LIKE','%'.$search."%")->get()->pluck("email");

    }
}

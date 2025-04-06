<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/29/2020
 * Time: 2:01 AM
 */

namespace CMS\Newsletter\Services;


class NewsletterServices
{
    public static function search_outpout($emails)
    {
        $output="";
        $output.='<li class="mb-3">';
        $output.='<input name="send_to[]" type="checkbox" checked value="all">';
        $output.='<label class="ml-2">همه</label>';
        $output.='</li>';

        foreach ($emails as $email){
            $output.='<li class="mb-3">';
            $output.='<input name="send_to[]" type="checkbox" value="'.$email.'">';
            $output.='<label class="ml-2">'.$email.'</label>';
            $output.='</li>';
        }
        return $output;
    }

    public static function send_email_to($sendToWho)
    {
        if($sendToWho=="all"){
            $sendTo="all";
        }else{
            $sendTo=$sendToWho;
        }
        return $sendTo;
    }
}

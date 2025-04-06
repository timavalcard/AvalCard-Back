<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/29/2020
 * Time: 10:07 PM
 */

namespace CMS\ProductAttr\Services;


class ProductAttrService
{
    public static function colorOrImage($image,$color,$type)
    {
        $arr=[];

        if($image && $type=="image"){
            $image=store_image_link($image);
            $arr=["image"=>$image,"color"=>''];
        }
        elseif($color  && $type=="color"){
            $arr=["color"=>$color,"image"=>''];
        }
        return $arr;
    }
}

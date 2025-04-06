<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/17/2020
 * Time: 1:09 PM
 */

namespace CMS\Product\Service;


use CMS\Product\Repository\ProductRepository;
use CMS\Product\Repository\ProductVariationRepository;
use CMS\ProductAttr\Repository\ProductAttrRepository;

class ProductVariationService
{
    public static function get_variations_name_html($variations){
        $html=[];
        foreach ($variations as $variation) {
            $parent_name=$variation->name;
            $value_name=$variation->sub_attr[0]->name;
            $html[]="<p style='line-height: 30px;'>".$parent_name." : ".$value_name."</p>";
        }
        return implode("",$html);
    }
}

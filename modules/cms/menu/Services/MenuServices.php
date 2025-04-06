<?php


namespace CMS\Menu\Services;

use CMS\Article\Models\Article;
use CMS\Category\Models\Category;
use CMS\Page\Models\Page;
use CMS\Product\Models\Product;

class MenuServices
{
    public static function get_item_for_menu()
    {
       /* return [
            "برگه ها"
            => ["items"=>Page::get(),"type"=>"page"],
            "محصولات"=>[
                "items"=>Product::get(),"type"=>"product"
            ],
            "نوشته ها"
            =>["items"=>Article::get(),"type"=>"article"],
            "دسته ها"
            =>["items"=>Category::get(),"type"=>"category"],
        ];*/

        return config()->get("MenuItem.items");
    }
}

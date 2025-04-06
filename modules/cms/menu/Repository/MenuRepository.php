<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/29/2020
 * Time: 1:19 AM
 */

namespace CMS\Menu\Repository;



use CMS\Menu\Models\Menu;

class MenuRepository
{
    public static function truncate()
    {
        Menu::truncate();
    }

    public static function create($name,$key,$parent=0)
    {
        Menu::create([
            "name"=>$name,
            "link"=>$key,
            "parent"=>$parent
        ]);
    }

    public static function get()
    {
        return Menu::get();
    }

    public static function get_menu_with_children()
    {
        return Menu::query()->where("parent",0)->with("children")->get();
    }
}

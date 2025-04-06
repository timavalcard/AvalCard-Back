<?php

namespace CMS\Menu\Http\Controllers;


use App\Http\Controllers\Controller;
use CMS\Menu\Http\Requests\MenuRequest;
use CMS\Menu\Models\Menu;
use CMS\Menu\Repository\MenuRepository;
use CMS\Menu\Services\MenuServices;



class MenuController extends Controller
{
    public function add_menu_form(){
        $this->authorize("index",Menu::class);
        $menuSelectItems=MenuServices::get_item_for_menu();
        $menus=MenuRepository::get();
        return view("Menu::Admin.add_menu",["menuSelectItems"=>$menuSelectItems,"menus"=>$menus]);
    }
    public function add_menu(MenuRequest $request)
    {
        $this->authorize("create",Menu::class);
        MenuRepository::truncate();
        foreach ($request->menu_name as $key=>$value){
            MenuRepository::create($value,$request->menu_link[$key],0);

        }
        return back();
    }
}

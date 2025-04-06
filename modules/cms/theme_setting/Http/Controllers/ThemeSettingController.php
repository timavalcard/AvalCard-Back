<?php

namespace CMS\ThemeSetting\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Page\Http\Requests\AddPageRequest;
use CMS\Page\Http\Requests\EditPageRequest;
use CMS\Page\Models\Page;
use CMS\Page\Repository\PageRepository;
use CMS\ThemeSetting\Models\Theme_setting;
use CMS\ThemeSetting\Repository\ThemeSettingRepository;
use CMS\ThemeSetting\Services\ThemeFieldsService;

class ThemeSettingController extends Controller
{
    public function index()
    {

        $fields=ThemeFieldsService::fields();
        $values=Theme_setting::get();
        return view("ThemeSetting::Admin.index",["fields"=>$fields,"values"=>$values]);
    }

    public function create(Request $request)
    {
        $fieldsValue=[];
        foreach($request->all() as $parentKey=>$item){
            if(is_array($item)){
                foreach ($item as $childKey=>$childItem) {

                    if(is_array($childItem)) {
                        foreach ($childItem as $valueIndex => $value) {
                            $fieldsValue[$parentKey][$valueIndex][$childKey] = $value;
                        }
                    } else{
                        $fieldsValue[$parentKey][$childKey] = $childItem;
                    }
                }
            }
        }

        foreach($fieldsValue as $itemKey=>$item){

                foreach($item as $childItemKey=>$childItem){

                    if(is_array($childItem) && count(array_filter($childItem)) == 0){
                        unset($fieldsValue[$itemKey][$childItemKey]);
                    }
            }
        }

        ThemeSettingRepository::create($fieldsValue);

        return back();
    }
}

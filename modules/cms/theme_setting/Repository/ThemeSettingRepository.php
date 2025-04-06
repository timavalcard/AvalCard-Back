<?php


namespace CMS\ThemeSetting\Repository;


use CMS\ThemeSetting\Models\Theme_setting;

class ThemeSettingRepository
{
    public static  function create($values)
    {
        Theme_setting::truncate();

        if(count(array_filter($values)) > 0){

            foreach ($values as $key => $value) {

                Theme_setting::create([
                    "setting_key" => $key,
                    "setting_value" => $value
                ]);
            }
        }
    }

    public static function getOption($key)
    {
        if($option=Theme_setting::query()->where("setting_key",$key)->first()){
        return $option->setting_value;

        }
    }


}

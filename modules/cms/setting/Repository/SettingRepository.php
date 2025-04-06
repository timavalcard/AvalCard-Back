<?php


namespace CMS\Setting\Repository;


use CMS\Setting\Models\Setting;

class SettingRepository
{
    public static function create_setting($values)
    {

        foreach ($values as $settingKey=>$value) {

            Setting::updateOrCreate(
                ["setting_key" => $settingKey],
                ["setting_value" => $value]);

        }
    }
    public static function getOption($key)
    {
        if($option=Setting::where("setting_key",$key)->first()){
            return $option->setting_value;
        }
    }
}

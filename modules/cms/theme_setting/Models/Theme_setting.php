<?php

namespace CMS\ThemeSetting\Models;

use Illuminate\Database\Eloquent\Model;

class Theme_setting extends Model
{
    protected $fillable=["setting_key","setting_value"];
    protected $casts=["setting_value"=>"json"];

}

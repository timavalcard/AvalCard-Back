<?php

namespace CMS\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use CMS\Article\Models\Article;

class ShopSetting extends Model
{
    protected $table="shop_setting";
    protected $fillable=["setting_key","setting_value"];

    protected $casts=["setting_value"=>"json"];
}

<?php

namespace CMS\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use CMS\User\Models\User;

class Cart extends Model
{
    protected $table = "cart";
    protected $fillable = ["user_id","cart_item","coupon_id"];
    protected $casts = ["cart_item"=>"json"];
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }


}

<?php

namespace CMS\Product\Models;

use Illuminate\Database\Eloquent\Model;
use CMS\User\Models\User;


class Coupon extends Model
{
    protected $table = "coupon";
    protected $fillable=["name","price_offering","price_type","time","hour","number","use_for","use_for_first_user","add_auto","send_free","type"];

    public function get_offering_price()
    {
        $type=$this->price_type == "cash" ? " تومان  " : " درصد ";
        $price=$this->price_offering;
        return $price . $type;
    }

    public function get_can_use_number()
    {
        return $this->number ?:"بینهایت";
    }

    public function get_expiration_date($formated=true)
    {
        if($formated){
        return $this->hour." ".$this->time  ;

        } else{
            return $this->hour.$this->time;
        }
    }

    public function user(){
        return $this->belongsToMany(User::class,"user_coupon");
    }
}

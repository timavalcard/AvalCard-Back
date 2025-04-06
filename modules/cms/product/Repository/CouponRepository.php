<?php
namespace CMS\Product\Repository;

use Illuminate\Support\Str;
use CMS\Category\Models\Category;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Models\Coupon;
use CMS\Product\Models\Product;
use CMS\Product\Models\ProductAttribute;
use CMS\Product\Service\ProductService;
use CMS\ProductAttr\Repository\ProductAttrRepository;

class CouponRepository
{
    public static function find($id)
    {
        return Coupon::find($id);
    }

    public static function all()
    {
        return Coupon::all();
    }
    public static function get_by_type($type="product"){
        return Coupon::query()->get();
    }

    public static function create($values)
    {
        $hour=$values->hour?: "00:00";
        return Coupon::create([
            "name"=>$values->name,
            "price_offering"=>$values->price_offering,
            "price_type"=>$values->price_type,
            "time"=>$values->time,
            "hour"=>$hour,
            "number"=>$values->number,
            "use_for"=>$values->use_for,
            "use_for_first_user"=>$values->use_for_first_user ? true : false,
            "add_auto"=>$values->add_auto ? true : false,
            "send_free"=>$values->send_free ? true : false,

        ]);
    }

    public static function update(Coupon $coupon,$values)
    {
        $hour=$values->hour?: "00:00";
        return $coupon->update([
            "name"=>$values->name,
            "price_offering"=>$values->price_offering,
            "price_type"=>$values->price_type,
            "time"=>$values->time,
            "hour"=>$hour,
            "number"=>$values->number,
            "use_for"=>$values->use_for,
            "use_for_first_user"=>$values->use_for_first_user ? true : false,
            "add_auto"=>$values->add_auto ? true : false,
            "send_free"=>$values->send_free ? true : false,

        ]);
    }

    public static function destroy($couponId)
    {
        Coupon::destroy($couponId);
    }

    public static function find_coupon_by_name($coupon_name,$type="product")
    {
        return Coupon::query()->where("name",$coupon_name)->first();
    }


    public static function decrease_number($coupon){
        $number=$coupon->number;
        $coupon->update([
            "number"=>$number--
        ]);
    }
}

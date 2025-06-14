<?php

namespace CMS\Order\Models;

use Illuminate\Database\Eloquent\Model;
use CMS\Product\Repository\ProductRepository;
use CMS\Transaction\Models\Transaction;
use CMS\User\Models\User;

class Order extends Model
{
    protected $fillable=[ "user_id","coupon_name","coupon_discount","payed_at","comment","order_type","is_course", "products_id","factor","post_tracking_code", "status","delivery_status", "price","payment_type","address"];
    protected $casts=[
        "products_id"=>"json",
        "comment"=>"json",
        "address"=>"json","factor"=>"json"];
    public static $COMPLETED="completed";
    public static $PROCESSING="processing";
    public static $PENDING="pending";
    public static $ON_HOLD="on-hold";
    public static $CANCELLED="cancelled";
    public static $REFUNDED="refunded";
    public static $FAILED="failed";


    const DELIVERY_INVOICE_TO_STOCK="send_invoice_to_stock";
    const PACKING="packing";
    const SEND_TO_POST="send_to_post";
    const DELIVERED_TO_CUSTOMER="delivered_to_customer";

    const COMPLETED='completed';
    const PROCESSING="processing";
    const PENDING="pending";
    const ON_HOLD="on-hold";
    const CANCELLED="cancelled";
    const REFUNDED="refunded";
    const FAILED="failed";

    public static $delivery_statuses=[self::DELIVERY_INVOICE_TO_STOCK,self::PACKING, self::SEND_TO_POST, self::DELIVERED_TO_CUSTOMER];

    public static $statuses=[self::COMPLETED,self::PENDING, self::ON_HOLD, self::CANCELLED, self::PROCESSING,];

    public static $pay_statuses=[self::PENDING,self::FAILED,self::ON_HOLD];
    public static $succeed_statuses=[self::PROCESSING,self::COMPLETED];

    public function transaction()
    {
        return $this->morphMany(Transaction::class,"transactionable");
    }

    public function getStatusHtmlAttribute()
    {
        return "<div class='$this->status'>".__($this->status)."</div>";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function log()
    {
        return $this->hasMany(OrderLog::class);
    }
    public function getProductsNameAttribute()
    {
        $products_id=$this->products_id;

        foreach ($products_id as $product_id=>$product_item) {
            $products_name[]=ProductRepository::find($product_id)->title;

        }
        $products_name=join(",",$products_name);
        return $products_name;
    }

    public function getFormatedPriceAttribute()
    {
        return format_price_with_currencySymbol($this->price);
    }


}

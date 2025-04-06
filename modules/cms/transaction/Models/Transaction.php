<?php

namespace CMS\Transaction\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

use CMS\Order\Models\Order;
use CMS\User\Models\User;
use CMS\Wallet\Models\Wallet;

class Transaction extends Model
{
     protected $fillable=["transaction_id","error_text","status","price","user_id","gateway"];

    public static $COMPLETED="completed";
    public static $PROCESSING="processing";
    public static $PENDING="pending";
    public static $ON_HOLD="on-hold";
    public static $CANCELLED="cancelled";
    public static $REFUNDED="refunded";
    public static $FAILED="failed";

    const COMPLETED='completed';
    const PROCESSING="processing";
    const PENDING="pending";
    const ON_HOLD="on-hold";
    const CANCELLED="cancelled";
    const REFUNDED="refunded";
    const FAILED="failed";

    public static $statuses=[self::COMPLETED,self::PENDING, self::ON_HOLD, self::CANCELLED, self::REFUNDED, self::FAILED, self::PROCESSING,];


    public function user(){

        return $this->belongsTo(User::class);
    }
     public function transactionable()
    {
        return $this->morphTo("transactionable","transactionable_type","transactionable_id");
    }

    public function getStatusHtmlAttribute()
    {
        return "<div class='$this->status'>".__($this->status)."</div>";
    }
    public function getFormatedPriceAttribute()
    {
        return format_price_with_currencySymbol($this->price);
    }

    public function GetTransactionForAttribute(){
        if($this->transactionable instanceof Order){
            return $this->transactionable->products_name;
        } elseif ($this->transactionable instanceof Wallet){

            return "کیف پول";
        }
        return "-";
    }

}

<?php

namespace CMS\Wallet\Models;

use Illuminate\Database\Eloquent\Model;
use CMS\Product\Repository\ProductRepository;
use CMS\Transaction\Models\Transaction;
use CMS\User\Models\User;

class Wallet extends Model
{
    protected $fillable=[ "user_id","status", "price"];
    public static $COMPLETED="completed";
    public static $PENDING="pending";
    public static $FAILED="failed";

    const COMPLETED='completed';
    const PENDING="pending";
    const FAILED="failed";

    public static $statuses=[self::COMPLETED,self::PENDING, self::FAILED];

    public static $pay_statuses=[self::PENDING,self::FAILED];

    public function transaction()
    {
        return $this->morphMany(Transaction::class,"transactionable");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}

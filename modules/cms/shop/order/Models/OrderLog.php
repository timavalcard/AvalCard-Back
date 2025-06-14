<?php

namespace CMS\Order\Models;

use Illuminate\Database\Eloquent\Model;
use CMS\Product\Repository\ProductRepository;
use CMS\Transaction\Models\Transaction;
use CMS\User\Models\User;

class OrderLog extends Model
{
    protected $fillable=[ "user_id","order_id","text"];
    protected $table="order_logs";


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }



}

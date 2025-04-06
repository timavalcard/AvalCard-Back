<?php

namespace CMS\Settlement\Models;

use Illuminate\Database\Eloquent\Model;
use CMS\User\Models\User;

class Settlement extends Model
{



    const STATUS_PENDING = 'pending';
    const STATUS_SETTLED = 'settled';
    const STATUS_REJECTED = 'rejected';
    const STATUS_CANCELED = 'canceled';
    public static $status = [
        self::STATUS_PENDING,
        self::STATUS_CANCELED,
        self::STATUS_SETTLED,
        self::STATUS_REJECTED,
    ];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }



}

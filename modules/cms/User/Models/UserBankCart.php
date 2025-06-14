<?php

namespace CMS\User\Models;

use Illuminate\Database\Eloquent\Model;

class UserBankCart extends Model
{
    protected $table='user_bank_cart';
     protected $fillable = [
        'user_id',
         'bank_name',
         'bank_name_fa',
         'cart_number',
         'shaba_number',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}

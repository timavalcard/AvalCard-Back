<?php

namespace CMS\User\Models;

use Illuminate\Database\Eloquent\Model;

class User_address extends Model
{
    protected $table="user_address";
     protected $fillable = [
        'user_id',
         'title',
         'phone',
         'postal_code',
         'address',
         'state',
         'city',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
